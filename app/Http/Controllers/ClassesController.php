<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Support\Facades\Route;

class ClassesController extends Controller
{

    public function index()
    {
        if (Route::currentRouteName() === 'home') {
            $classes = Classes::all();
            return view('home', compact('classes'));
        } else {
            $classes = Classes::all();
            return view('admin.schedule', compact('classes'));
        }
    }
    
}
