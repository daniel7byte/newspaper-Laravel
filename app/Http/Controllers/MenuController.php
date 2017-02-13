<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Grade;

class MenuController extends Controller
{
    public function grades() {
        $grades = Grade::all();
        return $grades;
    }
    public function categories() {
        $categories = Category::all();
        return $categories;
    }
}
