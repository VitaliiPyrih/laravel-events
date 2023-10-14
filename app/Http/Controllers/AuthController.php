<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function getLoginForm(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            Session::put('previous_url', url()->current());
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function login(): View
    {
        return view('auth.login');
    }

    public function register(): View
    {
        return view('auth.register');
    }

    public function createUser(Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => ['required', \Illuminate\Validation\Rules\Password::defaults()],
        ]);


        $user = new User($validate);


        $user->save();

        Auth::login($user);
        event(new Registered($user));
        return to_route('verification.notice');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return to_route('welcome');
    }

    public function reset(): View
    {
        return view('auth.forgot-password');
    }

    public function forgotPassword(Request $request): RedirectResponse
    {
        $request->validate(['email' => 'required|email']);

        try {
            $status = Password::sendResetLink(
                $request->only('email')
            );

            return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
        } catch (\Exception $exception) {
            return back()->withErrors(['error' => __($exception->getCode())]);
        }
    }

    public function passwordReset($token): View
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function newPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|min:8|email',
            'password' => 'required|confirmed',
        ]);


        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function verifyEmail(): View|RedirectResponse
    {
        if (auth()->user() && auth()->user()->hasVerifiedEmail()) {
            return to_route('profile');
        }
        return view('auth.verify-email');
    }
}
