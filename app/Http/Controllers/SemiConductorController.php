<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SemiConductorController extends Controller
{
    public function index () {
        return view('semi-conductors');
    }
}
