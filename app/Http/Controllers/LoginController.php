<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function index() {
        return view("Auth.login");
    }

    public function store(PostRequest $request) {
//        $validated = $request->validated();
        $credentials = $request->safe()->only('name', 'password');

        if (!$this->recaptcha($request->input('g-recaptcha-response'))) {
            return back()->withErrors(['message' => 'Please Complete the Recaptcha to proceed']);
        }

        if (Auth::attempt($credentials)) {
            //Login
            $request->session()->regenerate();

            return redirect()->route('users');
        }

        //Failed Login
        return back()->withErrors(['message' => "Login Gagal"]);
    }

    public function destroy(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function recaptcha($recaptcha_response): bool
    {
        if (is_null($recaptcha_response)) {
            return false;
        }

        $url = "https://www.google.com/recaptcha/api/siteverify";

        $body = [
            'secret' => config('services.recaptcha.secret'),
            'response' => $recaptcha_response,
        ];

        $response = Http::asForm()->post($url, $body);
        $result = json_decode($response);

        if (!$response->successful() && !$result->success) {
            return false;
        }
        return true;
    }
}
