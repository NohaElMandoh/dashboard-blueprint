<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Repository;
use App\Models\Type;
use Illuminate\Http\Request;

class RepositoryController extends Controller
{
    public function index()
    {
        $repositories = Repository::where('verified',true)->paginate(10);
        return view('admin.repositories.index', compact('repositories'));
    }
    public function not_verified()
    {
        $repositories = Repository::where('verified',false)->paginate(10);
        return view('admin.repositories.not_verified', compact('repositories'));
    }
    
    public function all_repositories()
    {
        $repositories = Repository::where('verified',true)->paginate(10);
        return view('front.repositories', compact('repositories'));
    }
    public function show_repository($id)
    {
        $repository = Repository::find($id);
        return view('front.repository', compact('repository'));
    }

    public function create()
    {
        $cities = City::all();
        $types = Type::all();
        return view('admin.repositories.create', compact('cities', 'types'));
    }

    public function store(Request $request)
    {
        $request->validate([
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
            'verified' => $request->has('verified') ? 1 : 0,
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
                \DB::table('repository_attachments')->insert([
                    'repository_id' => $repository->id,
                    'path' => 'Repository/attachments/' . $attachment->getClientOriginalName(),
                ]);
            }
        }
        return redirect()->route('repositories.index')->with('success', 'Repository created successfully.');
    }

    public function edit(Repository $repository)
    {
        
        $cities = City::all();
        $types = Type::all();
        return view('admin.repositories.edit', compact('repository','cities', 'types'));

    }

    public function update(Request $request, Repository $repository)
    {
       
        $request->validate([
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

        $repository->update([
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
            'verified' => $request->boolean('verified'),
            'status' => $request->status,
            'map' => $request->map,
            'area' => $request->area,
        ]);

        if ($request->hasFile('main_photo')) {
            $photoPath = $request->file('main_photo')->move(public_path('Repository/main_photo'), $request->file('main_photo')->getClientOriginalName());
            $repository->update([
            'main_photo' => 'Repository/main_photo/' . $request->file('main_photo')->getClientOriginalName(),
            ]);
        }

        if ($request->hasFile('additional_photos')) {
            // Remove previous photos
            \DB::table('repository_photos')->where('repository_id', $repository->id)->delete();

            foreach ($request->file('additional_photos') as $photo) {
            $photoPath = $photo->move(public_path('Repository/additional_photos'), $photo->getClientOriginalName());
            \DB::table('repository_photos')->insert([
                'repository_id' => $repository->id,
                'path' => 'Repository/additional_photos/' . $photo->getClientOriginalName(),
            ]);
            }
        }

        if ($request->hasFile('attachments')) {
            // Remove previous attachments
            \DB::table('repository_attachements')->where('repository_id', $repository->id)->delete();

            foreach ($request->file('attachments') as $attachment) {
            $attachmentPath = $attachment->move(public_path('Repository/attachments'), $attachment->getClientOriginalName());
            \DB::table('repository_attachements')->insert([
                'repository_id' => $repository->id,
                'path' => 'Repository/attachments/' . $attachment->getClientOriginalName(),
            ]);
            }
        }
        
        return redirect()->route('repositories.index')->with('success', 'Repository updated successfully.');
    }

    public function destroy(Repository $repository)
    {
        $repository->delete();
        return response()->json(['success' => 'Repository deleted successfully.']);
    }
}
