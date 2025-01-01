<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = ContactUs::paginate(10);
        return view('admin.contact_us.index', compact('contacts'));
    }
    public function show_contact_us()
    {
        
        return view('front.contact_us');
    }
    public function show_contact($id)
    {
        $contact = ContactUs::find($id);
        return view('admin.contact_us.contact_us_show',compact('contact'));
    }
    
    public function contact_us(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Save the data to the database (optional)
        ContactUs::create($request->only('name', 'email', 'subject', 'message'));

        // Return a success message
        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}
