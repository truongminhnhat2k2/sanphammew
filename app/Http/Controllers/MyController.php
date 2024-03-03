<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyController extends Controller
{
    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('user/register');
    }
    public function store(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $user = new User();
        $user->name=$request->fullname;
        $user->email=$request->email;
        $user->password=$request->password;
        $user->save();
        return view('user/login');
    }

    public function showLoginForm(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('user/login');
    }

    public function login(Request $request): \Illuminate\Http\RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password'=>['required'],
        ]);
        if (Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->route('index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function created(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('user/add-products');
    }

    public function stored(Request $request): \Illuminate\Http\RedirectResponse
    {
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->save();

        return redirect()->route('indexed');
    }
}
//        $validatedData = $request->validate([
//            'name' => 'required',
//            'description' => 'nullable',
//            'price' => 'required|numeric',
//            'quantity' => 'required|integer',
//        ]);
