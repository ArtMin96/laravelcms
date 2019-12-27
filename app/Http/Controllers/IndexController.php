<?php

namespace App\Http\Controllers;

use App\Category;
use App\Products;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() {

        // In Ascending order (by default)
        $productsAll = Products::get();

        // In Descending order
        $productsAll = Products::orderBy('id', 'DESC')->get();

        // In Random order
        $productsAll = Products::inRandomOrder()->where('status', 1)->get();

        // Get all Categories and Sub Categories
        $categories = Category::with('categories')->where(['parent_id' => 0])->get();

        return view('index')->with(compact('productsAll', 'categories'));
    }
}
