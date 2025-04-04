<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

class AccountController extends Controller
{  
    public function index(Request $request)
    {
        return view('account.index');
    }

    public function touroku(Request $request)
    {
        return view('account.touroku');
    }

    public function tourokujikkou(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'unique:users,email'],
            'name' =>['required'],
            'password' =>['required', 'min:6', 'confirmed'],
        ],
        [
            'email.required' => 'メールアドレスは必須です。',
            'email.unique' => '入力されたメールアドレスは登録済みです。',
            'email.email' => '入力されたメールアドレスは不正です。',
            'name.required' => '名前は必須です。',
            'password.required' => 'パスワードは必須です。',
            'password.min' => 'パスワードは6文字以上にしてください。',
            'password.confirmed' => '確認用パスワードが一致しません。'
        ]);
        User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => $request->password,
            'role' => 0,
        ]);
        return redirect('/')->with('message', '登録できました。');
    }

    public function auth(Request $request)
    {
        $value = $request->validate([
            'email' => ['required', 'email'],
            'password' =>['required'],
        ],
        [
            'email.required' => 'メールアドレスは必須です。',
            'email.email' => '入力されたメールアドレスは不正です。',
            'password.required' => 'パスワードは必須です。',
        ]);
        if(Auth::attempt($value)){
            $request->session()->regenerate();
            return redirect('/home');
        }
        return back()->withErrors([
            'password' => '不正なログインです'
        ]);
    }

public function logout(Request $request): RedirectResponse
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
}
}
