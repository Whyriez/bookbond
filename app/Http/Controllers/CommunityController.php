<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\CategoryBook;
use App\Models\Community;
use App\Models\CommunityPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    public function index()
    {
        $categories = CategoryBook::all();
        $user = Auth::user();

        // Ambil komunitas yang sudah diikuti oleh pengguna
        $joinedCommunities = $user->communities()->with(['categories', 'users'])->get();
        $createdCommunities = $user->createdCommunities()->with('categories')->get();
        $allCommunities = $joinedCommunities->merge($createdCommunities)->unique('id');

        $colors = ['#8b5cf6', '#f87171', '#34d399', '#fbbf24', '#3b82f6'];
        $shapes = [
            "M0,32L48,80L96,48L144,64L192,32L240,64L288,16L336,48L384,0L432,64L480,48L528,80L576,32L624,80L672,64L720,48L768,80L816,16L864,80L912,48L960,64L1008,32L1056,16L1104,48L1152,32L1200,48L1248,64L1296,32L1344,0L1392,32L1440,16L1440,0L0,0Z",
            "M0,0L40,60L80,20L120,50L160,10L200,60L240,0L280,50L320,10L360,60L400,0L440,50L480,10L520,60L560,0L600,50L640,10L680,60L720,0L760,50L800,10L840,60L880,0L920,50L960,10L1000,60L1040,0L1080,50L1120,10L1160,60L1200,0L1240,50L1280,10L1320,60L1360,0L1400,50L1440,10L1440,0L0,0Z",
            "M0,20L60,60L120,20L180,60L240,20L300,60L360,20L420,60L480,20L540,60L600,20L660,60L720,20L780,60L840,20L900,60L960,20L1020,60L1080,20L1140,60L1200,20L1260,60L1320,20L1380,60L1440,20L1440,0L0,0Z"
        ];

        $exploreCommunities = Community::whereDoesntHave('users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->latest()
            ->take(8)
            ->with('categories')
            ->get();

        $exploreCommunities = $exploreCommunities->map(function ($community) use ($colors, $shapes) {
            $randomColor = $colors[array_rand($colors)];
            $randomShape = $shapes[array_rand($shapes)];
            $community->random_color = $randomColor;
            $community->random_shape = $randomShape;
            $community->random_text_color = $this->adjustColorBrightness($randomColor, -80);
            $community->light_background_color = $this->adjustColorBrightness($randomColor, 100);

            $categoryColors = [];
            foreach ($community->categories as $i => $category) {
                $categoryColors[$category->id] = $this->adjustColorBrightness($randomColor, ($i + 1) * 20);
            }
            $community->category_colors = $categoryColors;

            return $community;
        });


        // Tambahkan atribut random ke setiap komunitas
        $allCommunities = $allCommunities->map(function ($community) use ($colors, $shapes) {
            $randomColor = $colors[array_rand($colors)];
            $randomShape = $shapes[array_rand($shapes)];

            $community->random_color = $randomColor;
            $community->random_shape = $randomShape;
            $community->random_text_color = $this->adjustColorBrightness($randomColor, -80);
            $community->light_background_color = $this->adjustColorBrightness($randomColor, 100);

            $categoryColors = [];
            foreach ($community->categories as $i => $category) {
                $categoryColors[$category->id] = $this->adjustColorBrightness($randomColor, ($i + 1) * 20);
            }
            $community->category_colors = $categoryColors;

            return $community;
        });

        return view('pages.landing.communities.index', compact(
            'categories',
            'allCommunities',
            'exploreCommunities',
            'user'
        ));
    }

    private function adjustColorBrightness($hex, $steps)
    {
        $hex = str_replace('#', '', $hex);

        if (strlen($hex) == 3) {
            $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
        }

        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));

        $r = max(0, min(255, $r + $steps));
        $g = max(0, min(255, $g + $steps));
        $b = max(0, min(255, $b + $steps));

        return sprintf("#%02x%02x%02x", $r, $g, $b);
    }



    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'categories' => 'required|array',
            'categories.*' => 'exists:category_book,id',

        ]);

        try {
            $community = Community::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'description' => $request->description,
            ]);

            $community->categories()->attach($request->categories);

            $community->users()->attach(Auth::user()->id);

            return redirect()->route('home.community.index')->with('success', 'Community created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create community. Please try again. Error: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $community = Community::findOrFail($id);
        $community->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Update categories if selected
        if ($request->has('categories')) {
            $community->categories()->sync($request->categories);
        }

        return redirect()->back()->with('success', 'Community updated successfully!');
    }

    public function show($id)
    {
        $user = Auth::user();
        $sort = request('sort', 'recent');

        $community = Community::with(['categories', 'users', 'owner'])->findOrFail($id);
        $books = Books::all();

        $isMember = $community->users->contains($user->id);
        $isOwner = $community->user_id === $user->id;

        $communityPosts = CommunityPost::with(['book', 'user'])
            ->where('community_id', $id)
            ->when($sort === 'popular', function ($query) {
                $query->withCount('usersWhoLiked')->orderByDesc('users_who_liked_count');
            }, function ($query) {
                $query->latest();
            })
            ->paginate(5);

        $relatedCommunities = Community::with(['categories'])
            ->whereHas('categories', function ($query) use ($community) {
                $query->whereIn('category_community.category_id', $community->categories->pluck('id'));
            })
            ->whereDoesntHave('users', function ($query) use ($user) {
                $query->where('community_user.user_id', $user->id);
            })
            ->limit(8)  // Batasi hanya 8 komunitas
            ->latest()
            ->get();


        return view('pages.landing.communities.detail.index', [
            'community' => $community,
            'isMember' => $isMember,
            'isOwner' => $isOwner,
            'books' => $books,
            'communityId' => $id,
            'communityPosts' => $communityPosts,
            'relatedCommunities' => $relatedCommunities,
        ]);
    }


    public function join(Community $community)
    {
        $user = Auth::user();

        if (!$community->users->contains($user->id)) {
            $community->users()->attach($user->id);
        }

        return redirect()->back()->with('success', 'You have joined the community!');
    }

    public function leave(Community $community)
    {
        $user = Auth::user();
        if ($community->users()->where('user_id', $user->id)->exists()) {
            $community->users()->detach($user->id);
        }

        return redirect()->back()->with('success', 'You have left the community.');
    }


    public function destroy($id)
    {
        $community = Community::findOrFail($id);
        $community->delete();

        return redirect()->back()->with('success', 'Community deleted successfully!');
    }
}
