<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Thesis;
use App\Models\Examiner;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(auth()->id());

        // Check if a thesis already exists for the user
        $existingThesis = DB::table('thesis')->where('user_id', $user->id)->first();

        // Build validation rules
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'supervisor' => 'required|string|max:255',
            'thesis_title' => 'required|string|max:255',
            'year' => 'required|string|max:4',
        ];

        // Only require file if thesis doesn't already exist
        if (!$existingThesis) {
            $rules['file'] = 'required|file|mimes:pdf';
        } else {
            $rules['file'] = 'nullable|file|mimes:pdf';
        }

        $request->validate($rules);

        // Update user info
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->save();

        // If no existing thesis, insert a new one
        if (!$existingThesis) {
            $thesis_id = (string) Str::uuid();

            $filePath = null;
            $fileName = null;
            if ($request->hasFile('file')) {
                $filePath = $request->file('file')->storeAs('thesis_files', time() . '_' . $request->file('file')->getClientOriginalName(), 'public');
                $fileName = $request->file('file')->getClientOriginalName();
            }

            DB::table('thesis')->insert([
                'id' => $thesis_id,
                'user_id' => $user->id,
                'title' => $request->input('thesis_title'),
                'supervisor' => $request->input('supervisor'),
                'year' => $request->input('year'),
                'file_path' => $filePath,
                'file_name' => $fileName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Insert examiners if provided
            $examiners = $request->input('examiners', []);
            foreach ($examiners as $examinerData) {
                $examiner = new Examiner();
                $examiner->thesis_id = $thesis_id;
                $examiner->name = $examinerData;
                $examiner->save();

            }
        } else {
            // Update existing thesis
            $filePath = $existingThesis->file_path;
            $fileName = $existingThesis->file_name;

            if ($request->hasFile('file')) {
                // Delete old file if it exists
                if ($filePath) {
                    Storage::disk('public')->delete($filePath);
                }
                $filePath = $request->file('file')->storeAs('thesis_files', time() . '_' . $request->file('file')->getClientOriginalName(), 'public');
                $fileName = $request->file('file')->getClientOriginalName();
            }

            DB::table('thesis')
                ->where('id', $existingThesis->id)
                ->update([
                    'title' => $request->input('thesis_title'),
                    'supervisor' => $request->input('supervisor'),
                    'year' => $request->input('year'),
                    'file_path' => $filePath,
                    'file_name' => $fileName,
                    'updated_at' => now(),
                ]);

            // Update examiners
            DB::table('examiners')->where('thesis_id', $existingThesis->id)->delete();
            foreach ($request->input('examiners', []) as $examinerData) {
                try {
                    $examiner = new Examiner();
                    $examiner->thesis_id = $existingThesis->id;
                    $examiner->name = $examinerData;
                    $examiner->save();
                } catch (QueryException  $th) {
                    if ($th->getCode() === '23000' && str_contains($th->getMessage(), 'Column \'name\' cannot be null')) {
                        Log::warning('Skipped inserting examiner due to null name.');
                    } else {
                        throw $th;
                    }
                }
            }
        }

        return redirect()->route('profile')->with('success', 'Profil Berhasil Diperbarui');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $file = $request->file('profile_picture');
        $path = $file->store('profile_pictures', 'public'); // Store in storage/app/public/profile_pictures

        $user->profile_picture = $path;
        $user->save();

        return back()->with('success', 'Profile picture updated!');
    }


}
