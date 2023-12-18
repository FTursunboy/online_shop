<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Good;
use Illuminate\Http\Request;

class GoodController extends Controller
{
    public function index() {
        $goods = Good::get();
        $categories = Category::get();

        return view('welcome', compact('goods', 'categories'));
    }
}
