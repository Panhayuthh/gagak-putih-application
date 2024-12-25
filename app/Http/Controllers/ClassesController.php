<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Support\Facades\Route;

class ClassesController extends Controller
{

    public function index()
    {
        $classes = Classes::paginate(8);
        $currentRoute = Route::currentRouteName();
    
        if ($currentRoute === 'class.index') {
            return view('class', compact('classes'));
        } elseif ($currentRoute === 'home') {
            return view('home', compact('classes'));
        } else {
            return $classes;
        }
    }
    
}
