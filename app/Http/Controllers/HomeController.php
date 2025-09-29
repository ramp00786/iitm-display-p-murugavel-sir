<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the landing page
     */
    public function index()
    {
        // Return the view without data - JavaScript will fetch data via API
        return view('home');
    }
}
