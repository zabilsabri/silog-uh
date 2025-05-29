<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index() {
        // add filter
        $query = User::query();

        // Search filters (optional)
        if (request()->has('search')) {
            $search = request()->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhere('username', 'like', '%' . $search . '%');
            });
        }

        if (request()->has('name')) {
            $name = request()->input('name');
            $query->where(function ($q) use ($name) {
                $q->where('first_name', 'like', '%' . $name . '%')
                    ->orWhere('last_name', 'like', '%' . $name . '%');
            });
        }

        if (request()->has('username')) {
            $username = request()->input('username');
            $query->where('username', 'like', '%' . $username . '%');
        }

        // ⛳ Key fix for "Belum Upload"
        $status = request()->input('status');
        if ($status == 'Belum Upload') {
            $query = DB::table('users')
                ->leftJoin('thesis', 'thesis.user_id', '=', 'users.id')
                ->whereNull('thesis.id')
                ->where('users.role', 'user')
                ->select('users.*')
                ->orderBy('users.created_at', 'desc');
        } else {
            // normal Eloquent if not using raw join
            $query = User::query()->where('role', 'user');

            if ($status == 'Sudah Upload') {
                $query->whereHas('thesis');
            }
        }

        // Paginate
        $users = $query->paginate(10);

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

    public function add(Request $request) {
        $request->validate([
            'nim' => 'required'
        ]);

        $user = new User();
        $user->username = $request->input('nim');
        $user->password = Hash::make($request->input('username'));
        $user->save();

        return redirect()->route('students.admin')->with('success', 'Mahasiswa berhasil ditambahkan');

    }
}
