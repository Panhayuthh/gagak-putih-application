<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Support\Facades\Route;

class ClassesController extends Controller
{

    public function index()
    {
        $currentRoute = Route::currentRouteName();
        
        if ($currentRoute === 'class.index') {
            $classes = Classes::paginate(8);
            return view('class', compact('classes'));
        } elseif ($currentRoute === 'home') {
            $classes = Classes::all();
            return view('home', compact('classes'));
        } 
    }
    
}
