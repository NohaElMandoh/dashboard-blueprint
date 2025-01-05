<?php

namespace App\Http\Controllers;

use App\Models\Repository;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function index()
    {
        $employees = User::paginate(10);
        return view('admin.clients.index', compact('employees'));
    }


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
    public function payment_process(Request $request)
    {
        return view('client.thankyou');
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

    public function logout()
    {
        Auth::guard('client')->logout();
        return redirect()->route('home');
    }

    
    public function edit(User $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, User $client)
    {
      
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $client->id,
         
            'password' => 'nullable|min:6',
        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->move(public_path('photos'), $request->file('photo')->getClientOriginalName());
            $photoPath = 'photos/' . $request->file('photo')->getClientOriginalName();
        } else {
            $photoPath = $client->photo;
        }

        $client->update([
            'name' => $request->name,
            'email' => $request->email,
          
            'photo' => $photoPath,
            'password' => $request->password ? Hash::make($request->password) : $client->password,
        ]);

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy(User $client)
    {
        $client->delete();
        return response()->json(['success' => 'Client deleted successfully.']);
    }
}
