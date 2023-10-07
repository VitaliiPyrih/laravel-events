<?php

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;


Route::get('/', \App\Http\Controllers\MainController::class)->name('welcome');
Route::get('/e', \App\Http\Controllers\EventIndexController::class)->name('eventIndex');
Route::get('/gallery', \App\Http\Controllers\GalleryIndexController::class)->name('galleryIndex');
Route::get('/e/{event}', \App\Http\Controllers\EventShowController::class)->name('eventShow');
Route::get('/countries/{country}', function (Country $country) {
    return response()->json($country->cities);
})->name('getCountry');

Route::middleware('guest')->group(function () {
    Route::get('/forgot-password',[\App\Http\Controllers\AuthController::class,'reset'])->name('password.request');
    Route::post('/forgot-password',[\App\Http\Controllers\AuthController::class,'forgotPassword'])->name('password.email');
    Route::get('/reset-password/{token}',[\App\Http\Controllers\AuthController::class,'passwordReset'])->name('password.reset');
    Route::post('/reset-password',[\App\Http\Controllers\AuthController::class,'newPassword'])->name('password.update');

    Route::get('/auth/{provider}/redirect', [\App\Http\Controllers\SocialProviderController::class,'redirect']);
    Route::get('/auth/{provider}/callback',[\App\Http\Controllers\SocialProviderController::class,'callback']);


    Route::post('/login', \App\Http\Controllers\AuthController::class)->name('login');
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::get('/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
    Route::post('/register', [\App\Http\Controllers\AuthController::class, 'createUser'])->name('createUser');
});


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('profile');
})->middleware(['auth', 'signed'])->name('verification.verify');


//Route::get('/email/verify', function () {
//    if (auth()->user() && auth()->user()->hasVerifiedEmail()) {
//        return to_route('profile');
//    }
//    return view('auth.verify-email');
//})->name('verification.notice');

Route::get('/profile', \App\Http\Controllers\Profile\IndexController::class)->name('profile')->middleware('auth');
Route::get('/email/verify',[\App\Http\Controllers\AuthController::class,'verifyEmail'])->name('verification.notice')->middleware('auth');

Route::middleware(['auth','verified'])->group(function () {
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
