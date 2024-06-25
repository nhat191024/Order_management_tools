<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function __construct() {
    }

    public function index() {
        $categories = Category::get();
        return view('admin.category');
    }
}
