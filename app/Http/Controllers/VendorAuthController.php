<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Repository;
use App\Models\Type;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorAuthController extends Controller
{

    public function showLoginForm()
    {
        return view('vendor.login');
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('vendor')->attempt($request->only('email', 'password'))) {
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function showRegistrationForm()
    {
   
        return view('vendor.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:vendors',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $vendor = Vendor::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::guard('vendor')->login($vendor);

        return redirect()->route('home');
    }
    public function showUploadForm()
    {
        $cities = City::all();
        $types = Type::all();
        return view('vendor.upload_repository', compact('cities', 'types'));
    }
    public function storeRepositoryData(Request $request)
    {
      
        $validator = \Validator::make($request->all(), [
            'name_en' => 'required',
            'name_ar' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
            'city_id' => 'required|exists:cities,id',
            'type_id' => 'required|exists:types,id',
            'location_en' => 'required',
            'location_ar' => 'required',
            'map' => 'required|string',
            'area' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $photoPath = $request->file('main_photo')->move(public_path('Repository/main_photo'), $request->file('main_photo')->getClientOriginalName());
       
        $repository= Repository::create([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
            'description' => json_encode([
                'en' => $request->description_en,
                'ar' => $request->description_ar,
            ]),
            'location' => json_encode([
                'en' => $request->location_en,
                'ar' => $request->location_ar,
            ]),
            'city_id' => $request->city_id,
            'type_id' => $request->type_id,
            'verified' =>  0,
            'status' => $request->status,
            'map' => $request->map,
            'main_photo' => 'Repository/main_photo/' . $request->file('main_photo')->getClientOriginalName(),
            'user_id' => auth()->id(),
            'area' => $request->area,
        ]);
        if ($request->hasFile('additional_photos')) {
            foreach ($request->file('additional_photos') as $photo) {
            $photoPath = $photo->move(public_path('Repository/additional_photos'), $photo->getClientOriginalName());
            \DB::table('repository_photos')->insert([
                'repository_id' => $repository->id,
                'path' => 'Repository/additional_photos/' . $photo->getClientOriginalName(),
            ]);
            }
        }

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $attachment) {
                $attachmentPath = $attachment->move(public_path('Repository/attachments'), $attachment->getClientOriginalName());
                \DB::table('repository_attachements')->insert([
                    'repository_id' => $repository->id,
                    'path' => 'Repository/attachments/' . $attachment->getClientOriginalName(),
                ]);
            }
        }
        if( $repository){
      
        return back()->with('success', 'Repository created successfully.');
        }else{
         
        return back()->with('error', 'Failed to create repository.');
        }
    
    }

    public function dashboard()
    {
        return view('vendor.dashboard');
    }
    public function logout()
    {
        Auth::guard('vendor')->logout();
        return redirect()->route('home');
    }
}
