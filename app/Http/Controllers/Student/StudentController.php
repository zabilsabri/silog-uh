<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class StudentController extends Controller
{
    public function index() {
        // add filter
        $query = User::query();
        if(request()->has('search')) {
            $search = request()->input('search');
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', '%' . $search . '%')
                  ->orWhere('last_name', 'like', '%' . $search . '%')
                  ->orWhere('username', 'like', '%' . $search . '%');
            });
        }
        if(request()->has('name')) {
            $name = request()->input('name');
            $query->where(function($q) use ($name) {
                $q->where('first_name', 'like', '%' . $name . '%')
                  ->orWhere('last_name', 'like', '%' . $name . '%');
            });
        }
        if(request()->has('username')) {
            $username = request()->input('username');
            $query->where('username', 'like', '%' . $username . '%');
        }
        if(request()->has('status')) {
            $status = request()->input('status');
            if ($status == 'Sudah Upload') {
                $query->whereHas('thesis');
            } elseif ($status == 'Belum Upload') {
                $query->whereDoesntHave('thesis');
            }
        }
        $users = $query->where('role', 'user')->paginate(10);
        return view('student.index', compact('users'));
    }

    public function detail($id) {
        $user = User::findOrFail($id);
        return view('student.detail', compact('user'));
    }

    public function delete($id) {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('students.admin')->with('success', 'Mahasiswa berhasil dihapus');
    }
}
