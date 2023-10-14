<?php

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;


Route::get('/', \App\Http\Controllers\MainController::class)->name('welcome');
Route::get('/gallery', \App\Http\Controllers\GalleryIndexController::class)->name('galleryIndex');
Route::controller(\App\Http\Controllers\CountryController::class)->group(function () {
    Route::get('/e','indexCountry')->name('eventIndex');
    Route::get('/e/{event}', 'showController')->name('eventShow');
    Route::get('/countries/{country}','getCountry')->name('getCountry');
});

Route::middleware('guest')->group(function () {
    Route::controller(\App\Http\Controllers\AuthController::class)->group(function () {
        Route::get('/forgot-password','reset')->name('password.request');
        Route::get('/reset-password/{token}','passwordReset')->name('password.reset');
        Route::get('/login', 'login')->name('login');
        Route::get('/register', 'register')->name('register');
        Route::post('/forgot-password','forgotPassword')->name('password.email');
        Route::post('/login', 'getLoginForm')->name('login');
        Route::post('/reset-password','newPassword')->name('password.update');
        Route::post('/register', 'createUser')->name('createUser');
    });
    Route::get('/auth/{provider}/redirect', [\App\Http\Controllers\SocialProviderController::class,'redirect']);
    Route::get('/auth/{provider}/callback',[\App\Http\Controllers\SocialProviderController::class,'callback']);



});

Route::middleware(['auth'])->group(function () {
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware(['throttle:6,1'])->name('verification.send');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()->route('profile');
    })->middleware(['signed'])->name('verification.verify');

    Route::get('/profile', \App\Http\Controllers\Profile\IndexController::class)->name('profile');
    Route::get('/email/verify',[\App\Http\Controllers\AuthController::class,'verifyEmail'])->name('verification.notice');

    Route::middleware(['verified'])->group(function () {
        Route::prefix('/dashboard')->group(function () {
            Route::resource('/events', \App\Http\Controllers\EventController::class);
            Route::resource('/galleries', \App\Http\Controllers\GalleryController::class);
            Route::get('/liked-events', \App\Http\Controllers\LikeEventController::class)->name('likedEvents');
            Route::get('/saved-events', \App\Http\Controllers\SavedEventController::class)->name('savedEvents');
            Route::get('/attending-events', \App\Http\Controllers\AttendingEventController::class)->name('attendingEvents');
        });
        Route::post('/events-like/{id}', \App\Http\Controllers\LikeSystemController::class)->name('events.like');
        Route::post('/events-save/{id}', \App\Http\Controllers\SaveSystymController::class)->name('events.save');
        Route::post('/events-attending/{id}', \App\Http\Controllers\AttendingSystemController::class)->name(
            'events.attending'
        );
        Route::post('/events/{event}/comments', \App\Http\Controllers\StoreCommentController::class)->name(
            'events.comments'
        );
        Route::delete('/events/{event}/comments{comment}', \App\Http\Controllers\DeleteCommentController::class)->name(
            'events.comments.destroy'
        );
        Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    });

});
