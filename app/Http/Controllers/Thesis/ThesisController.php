<?php

namespace App\Http\Controllers\Thesis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ThesisController extends Controller
{
    public function index()
    {
        return view('thesis.index');
    }
}
