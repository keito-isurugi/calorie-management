<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Food;
use Symfony\Component\HttpFoundation\StreamedResponse;


class FoodController extends Controller
{
    public function index()
    {
        $food =  Food::paginate(15);
        return $food;
    }

    public function store(Request $request)
    {
        return Food::create($request->all());
    }

    public function getMajorCategory()
    {
        $food = DB::table('foods')->groupBy('major_category')->get(['major_category']);
        return $food;
    }

    public function getMiddleCategory()
    {
        $food = DB::table('foods')->groupBy('middle_category')->get(['middle_category']);
        return $food;
    }

    public function show(Food $food)
    {
        return $food;
    }

    public function update(Request $request, Food $food)
    {
        $food->update($request->all());
        return $food;
    }

    public function destroy(Food $food)
    {
        $food->delete();
        return $food;
    }

    public function search(Request $request)
    {   
        $foodsQuery = Food::query();
        if(isset($request->middle_category)){
            $foodsQuery = $foodsQuery->whereMiddle_category($request->middle_category);
        }
        if(isset($request->name)){
            $foodsQuery = $foodsQuery->where('name', 'like', "%$request->name%");
        }
        $foodsQuery = $foodsQuery->paginate(15);
        $food =  $foodsQuery;
        return $food;
    }

    public function sort(Request $request)
    {
        $foodsQuery = Food::query();
        if(isset($request->middle_category)){
            $foodsQuery = $foodsQuery->whereMiddle_category($request->middle_category);
        }
        if(isset($request->name)){
            $foodsQuery = $foodsQuery->where('name', 'like', "%$request->name%");
        }
        if($request->orderby == "true") {
            $foodsQuery = $foodsQuery->orderBy($request->sort_column, 'asc')->paginate(15);
        }
        if($request->orderby == "false") {
            $foodsQuery = $foodsQuery->orderBy($request->sort_column, 'desc')->paginate(15);
        }
        
        $food =  $foodsQuery;
        return $food;
    }

    public function csvDownload()
    {
        $food =  Food::all();
        return $food;
    }
}
