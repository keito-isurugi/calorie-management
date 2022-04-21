<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Food;

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
        $food =  Food::where('middle_category', '=', $request->item_name)->paginate(15);
        return $food;
    }

}
