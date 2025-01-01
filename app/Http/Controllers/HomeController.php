<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\ContactUs;
use App\Models\Repository;
use App\Models\Type;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $cities = City::all();
        $types = Type::all();
        $query = Repository::query();
        $repositories = $query->where('verified', true)->get();
        return view('front.home', compact('cities', 'types', 'repositories'));
    }
    public function search(Request $request)
    {

        $query = Repository::query();

        if ($request->has('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('name->en', 'like', '%' . $keyword . '%')
                    ->orWhere('name->ar', 'like', '%' . $keyword . '%');
            });
        }
        if ($request->has('type_id') && intval($request->input('type_id')) != 0) {
            $query->where('type_id', intval($request->input('type_id')));
        }

        if ($request->has('city_id') && $request->input('city_id') != 0) {
            $query->where('city_id', $request->input('city_id'));
        }

        $repositories = $query->where('verified', true)->paginate(10);

        return view('front.search_results', compact('repositories'));
    }
    public function about()
    {
     
        return view('front.about');
        
    }
    
}
