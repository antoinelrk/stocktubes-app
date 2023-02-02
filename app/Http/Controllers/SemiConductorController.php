<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SemiConductorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index () {
        return view('semi-conductors');
    }
}
