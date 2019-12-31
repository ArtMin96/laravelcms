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

        foreach ($productsAll as $key => $product) {
            $categoryName = Category::where(['id' => $product->category_id])->first();

            if(!empty($categoryName)) {
                $productsAll[$key]->category_name = $categoryName->name;
            }
        }

        return view('index')->with(compact('productsAll', 'categories'));
    }
}
