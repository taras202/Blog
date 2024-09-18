<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function authenticate(Request $request)
    {
        // Валідація даних для логіну
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Перевірка облікових даних
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Перенаправлення на список постів
            return redirect()->route('posts.index');
        }

        // Помилка при аутентифікації
        return back()->withErrors([
            'email' => 'Неправильний email або пароль.',
        ])->onlyInput('email');
    }

        public function showRegistrationForm()
    {
        return view('auth.register');
    }
    public function register(RegisterUserRequest $request)
    {
        $user = $this->create($request->validated());

        Auth::login($user);

        return redirect()->route('posts.index');
    }
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function show()
    {
        return view('auth.choose');
    }
}
