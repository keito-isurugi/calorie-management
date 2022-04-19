<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        echo "hoge";
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

    public function destroy(Food $food)
    {
        $food->delete();
        return $food;
    }
}
