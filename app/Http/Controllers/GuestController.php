<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Community;
use App\Models\DetailPartner;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function allBooks()
    {
        $books = Books::with('categories')->get();
        return view('pages.landing.guest.allbooks', compact('books'));
    }

    public function allPopularCommunity()
    {
        $colors = ['#8b5cf6', '#f87171', '#34d399', '#fbbf24', '#3b82f6'];
        $shapes = [
            "M0,32L48,80L96,48L144,64L192,32L240,64L288,16L336,48L384,0L432,64L480,48L528,80L576,32L624,80L672,64L720,48L768,80L816,16L864,80L912,48L960,64L1008,32L1056,16L1104,48L1152,32L1200,48L1248,64L1296,32L1344,0L1392,32L1440,16L1440,0L0,0Z",
            "M0,0L40,60L80,20L120,50L160,10L200,60L240,0L280,50L320,10L360,60L400,0L440,50L480,10L520,60L560,0L600,50L640,10L680,60L720,0L760,50L800,10L840,60L880,0L920,50L960,10L1000,60L1040,0L1080,50L1120,10L1160,60L1200,0L1240,50L1280,10L1320,60L1360,0L1400,50L1440,10L1440,0L0,0Z",
            "M0,20L60,60L120,20L180,60L240,20L300,60L360,20L420,60L480,20L540,60L600,20L660,60L720,20L780,60L840,20L900,60L960,20L1020,60L1080,20L1140,60L1200,20L1260,60L1320,20L1380,60L1440,20L1440,0L0,0Z"
        ];

        $allCommunities = Community::with(['categories', 'users'])
            ->withCount('users')
            ->orderByDesc('users_count')
            ->get();

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

        return view('pages.landing.guest.allpopular_community', compact('allCommunities'));
    }

    public function allBookStore()
    {
        $bookStore = DetailPartner::with('bookCategories', 'serviceOffers')->get();

        return view('pages.landing.guest.allbookstore', compact('bookStore'));
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
}
