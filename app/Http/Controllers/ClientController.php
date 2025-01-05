<?php

namespace App\Http\Controllers;

use App\Models\Repository;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    
    public function showLoginForm()
    {
        return view('client.login');
    }
    public function buy_now()
    {
        return view('client.payment_form');
    }
    public function order_details($id)
{
    $repository = Repository::with('type', 'vendor')->findOrFail($id);
    return view('client.order_details', compact('repository'));
}
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('client')->attempt($request->only('email', 'password'))) {
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function showRegistrationForm()
    {
   
        return view('client.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:vendors',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $client = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::guard('client')->login($client);

        return redirect()->route('home');
    }
}
