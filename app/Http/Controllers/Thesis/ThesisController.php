<?php

namespace App\Http\Controllers\Thesis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Thesis;

class ThesisController extends Controller
{
    public function index(Request $request)
    {

        $query = Thesis::query();
        if($request->has('search')){
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($query) use ($search) {
                    $query->where('first_name', 'like', '%' . $search . '%')
                          ->orWhere('last_name', 'like', '%' . $search . '%');
                })->orWhere('title', 'like', '%' . $search . '%');
            });
        } if ($request->has('title')) {
            $title = $request->input('title');
            $query->where('title', 'like', '%' . $title . '%');
        } if ($request->has('author')){
            $author = $request->input('author');
            $query->whereHas('user', function($q) use ($author) {
                $q->where('first_name', 'like', '%' . $author . '%')
                  ->orWhere('last_name', 'like', '%' . $author . '%');
            });
        } if ($request->has('year')) {
            $year = $request->input('year');
            $query->where('year', $year);
        }

        $thesis = $query->paginate(7);
        
        return view('thesis.index', compact('thesis'));
    }

    public function detail($id)
    {
        $thesis = Thesis::findOrFail($id);
        return view('thesis.detail', compact('thesis'));
    }
}
