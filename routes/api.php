<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FollowerController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\ReactionController;
use App\Http\Controllers\Api\TweetController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->middleware('guest');
    Route::post('register', 'register')->middleware('guest');
    Route::post('logout', 'logout')->middleware(['auth:api']);
    Route::post('refresh', 'refresh')->middleware(['auth:api']);
    Route::get('profile', 'profile')->middleware(['auth:api']);
    Route::get('user-profile/{user:username}', 'userProfile')->middleware(['auth:api'])->name('userProfile');
    Route::post('profile-update/{user:username}', 'profileUpdate')->middleware(['auth:api']);
    Route::post('password-update/{user:username}', 'passwordUpdate')->middleware(['auth:api']);
    Route::post('avatar-upload', 'userAvatarUpdate')->middleware(['auth:api']);
    Route::post('password-recover', 'passwordRecover')->name('password.recover')->middleware('guest');
    Route::post('password-reset', 'passwordReset')->name('password.reset')->middleware('guest');
});

Route::controller(HomeController::class)->middleware(['auth:api'])->group(function () {
    Route::get('tweets', 'tweets')->name('tweets');
    Route::get('following-tweets', 'followingTweets')->name('followingTweets');
    Route::get('tweets/{user:username}', 'tweetsByUsername')->name('tweetsByUsername');
});

Route::controller(TweetController::class)->middleware(['auth:api'])->group(function () {
    Route::get('tweet', 'index');
    Route::get('tweet/{tweet:slug}', 'show');
    Route::post('tweet', 'store');
    Route::put('tweet/{tweet:slug}', 'update');
    Route::delete('tweet/{tweet:slug}', 'destroy');
});

Route::controller(FollowerController::class)->middleware(['auth:api'])->group(function () {
    Route::post('follow', 'follow');
    Route::post('unfollow', 'unFollow');
});

Route::controller(ReactionController::class)->middleware(['auth:api'])->group(function () {
    Route::post('react/{tweet}', 'reactToTweet');
    Route::post('remove-react/{tweet}', 'removeReactFromTweet');
});
