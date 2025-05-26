<?php

namespace App\Http\Controllers\Thesis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Thesis;

class ThesisController extends Controller
{
    public function index()
    {
        $thesis = Thesis::paginate(7);
        return view('thesis.index', compact('thesis'));
    }
}
