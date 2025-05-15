<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\CategoryBookController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\CommunityPostController;
use App\Http\Controllers\DiscoverController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ServiceOfferController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/login', function () {
//     return view('pages.auth.index');
// });

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'post'])->name('login.post');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'create'])->name('register.create');
Route::get('/register-partner', [AuthController::class, 'registerPartner'])->name('register.partner');
Route::post('/register-partner', [AuthController::class, 'createPartner'])->name('register.partner.create');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/guest/all/books', [GuestController::class, 'allBooks'])->name('guest.all.books');
Route::get('/guest/all/popular/community', [GuestController::class, 'allPopularCommunity'])->name('guest.all.popular.community');
Route::get('/guest/all/book/store', [GuestController::class, 'allBookStore'])->name('guest.all.book.store');

// Route::get('/register', function () {
//     return view('pages.auth.register');
// });

Route::get('/visit/{partner}', [PartnerController::class, 'track'])->name('partner.visit');


Route::group(['middleware' => ['auth']], function () {

    // Home Admin
    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin');
        // Route::get('/books', [BooksController::class, 'index'])->name('admin.books');
        Route::resource('books', BooksController::class)->names('admin.books');
        Route::resource('category', CategoryBookController::class)->names('admin.book.category');
        Route::resource('services-offer', ServiceOfferController::class)->names('admin.service.offer');
    });

    // Home User
    Route::group(['middleware' => ['role:user']], function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');

        // routes/web.php
        Route::post('/books/{book}/want-to-read', [BooksController::class, 'toggleWantToRead'])->name('books.wantToRead');

        Route::get('/want-to-read', [HomeController::class, 'wantToRead'])->name('want.read');

        Route::resource('communities', CommunityController::class)->names('home.community');
        Route::resource('communities-post', CommunityPostController::class)->names('home.community.post');
        Route::post('/community-post/{post}/like', [CommunityPostController::class, 'likePost'])->name('home.community.post.like');
        Route::post('/communities/{community}/join', [CommunityController::class, 'join'])->name('home.community.join');
        Route::post('/communities/{community}/leave', [CommunityController::class, 'leave'])->name('home.community.leave');


        Route::resource('book', BooksController::class)->names('home.books');
        Route::get('/book/detail/{id}', [BooksController::class, 'showDetail'])->name('home.book.detail');

        // Route::resource('discover', DiscoverController::class)->names('home.discover');
        Route::get('/discover', [DiscoverController::class, 'index'])->name('home.discover');
        Route::get('/discover/search', [DiscoverController::class, 'search'])->name('home.discover.search');
    });

    Route::group(['middleware' => ['role:partner']], function () {
        Route::get('/partner', [PartnerController::class, 'index'])->name('partner.dashboard');
        Route::get('/partner/bookshop', [PartnerController::class, 'bookShop'])->name('partner.bookshop');
        Route::put('/partner/bookshop', [PartnerController::class, 'updateBookshop'])->name('partner.bookshop.update');
        
        Route::get('/partner/shop-details', [PartnerController::class, 'shopDetails'])->name('partner.shop.details');
        Route::put('/partner/shop-details', [PartnerController::class, 'updateShopDetails'])->name('partner.shop.details.update');
    });
});



// Route::get('/register-partner', function () {
//     return view('pages.auth.register-partner');
// });

// Home User
// Route::get('/home', function () {
//     return view('pages.landing.home.index');
// });


// Communities
// Route::get('/communities', function () {
//     return view('pages.landing.communities.index');
// });

// Route::get('/communities/detail', function () {
//     return view('pages.landing.communities.detail.index');
// });
// End Communities

// discover
// Route::get('/discover', function () {
//     return view('pages.landing.discover.index');
// });
// End discover

// book
// Route::get('/book/detail', function () {
//     return view('pages.landing.book.detail.index');
// });
// End book

// End Home User
