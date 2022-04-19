<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class FoodController extends Controller
{
    public function index()
    {
        return Food::all();
    }

    public function store(Request $request)
    {
        return Food::create($request->all());
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

    public function destory(Food $food)
    {
        $food->delete();
        return $food;
    }
}
