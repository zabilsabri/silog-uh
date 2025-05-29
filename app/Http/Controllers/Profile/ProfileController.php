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
        $existingThesis = DB::table('thesis')->where('user_id', $user->id)->first();

        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'supervisor' => 'required|string|max:255',
            'thesis_title' => 'required|string|max:255',
            'year' => 'required|string|max:4',
            'thesis_abstract' => 'required|string',
            'file_source_code' => 'nullable|file|mimes:zip',
            'file_data_source' => 'nullable|file|mimes:csv,xlsx,xls',
            'file_thesis' => $existingThesis
                ? 'nullable|file|mimes:pdf,doc,docx'
                : 'required|file|mimes:pdf,doc,docx',
        ];

        $validated = $request->validate($rules);

        $user->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
        ]);

        $folderName = Auth::user()->username . '_' . $validated['first_name'] . ' ' . $validated['last_name'];

        if (!$existingThesis) {
            $thesis_id = (string) Str::uuid();

            $fileThesisPath = $fileThesisName = null;
            if ($request->hasFile('file_thesis')) {
                $fileThesisName = $request->file('file_thesis')->getClientOriginalName();
                $fileThesisPath = $request->file('file_thesis')->storeAs($folderName, 'skripsi_' . Auth::user()->username . '.' . $request->file('file_thesis')->getClientOriginalExtension(), 'public');
            }

            $sourceCodePath = $sourceCodeName = null;
            if ($request->hasFile('file_source_code')) {
                $sourceCodeName = $request->file('file_source_code')->getClientOriginalName();
                $sourceCodePath = $request->file('file_source_code')->storeAs($folderName, 'kode_' . Auth::user()->username . '.' . $request->file('file_source_code')->getClientOriginalExtension(), 'public');
            }

            $dataSourcePath = $dataSourceName = null;
            if ($request->hasFile('file_data_source')) {
                $dataSourceName = $request->file('file_data_source')->getClientOriginalName();
                $dataSourcePath = $request->file('file_data_source')->storeAs($folderName, 'data_' . Auth::user()->username . '.' . $request->file('file_data_source')->getClientOriginalExtension(), 'public');
            }

            DB::table('thesis')->insert([
                'id' => $thesis_id,
                'user_id' => $user->id,
                'abstract' => $validated['thesis_abstract'],
                'title' => $validated['thesis_title'],
                'supervisor' => $validated['supervisor'],
                'year' => $validated['year'],
                'file_path' => $fileThesisPath,
                'file_name' => $fileThesisName,
                'source_code_path' => $sourceCodePath,
                'source_code_name' => $sourceCodeName,
                'file_data_source_path' => $dataSourcePath,
                'file_data_source_name' => $dataSourceName,
                'link_data_source' => $request->input('link_data_source'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($request->input('examiners', []) as $examinerData) {
                try {
                    Examiner::create([
                        'thesis_id' => $thesis_id,
                        'name' => $examinerData,
                    ]);
                } catch (QueryException $th) {
                    if ($th->getCode() === '23000' && str_contains($th->getMessage(), 'Column \'name\' cannot be null')) {
                        Log::warning('Skipped inserting examiner due to null name.');
                    } else {
                        throw $th;
                    }
                }
            }
        } else {
            $fileThesisPath = $existingThesis->file_path;
            $fileThesisName = $existingThesis->file_name;

            if ($request->hasFile('file_thesis')) {
                if ($fileThesisPath) {
                    Storage::disk('public')->delete($fileThesisPath);
                }

                $fileThesisName = $request->file('file_thesis')->getClientOriginalName();
                $fileThesisPath = $request->file('file_thesis')->storeAs($folderName, 'skripsi_' . Auth::user()->username . '.' . $request->file('file_thesis')->getClientOriginalExtension(), 'public');
            }

            $sourceCodePath = $existingThesis->source_code_path;
            $sourceCodeName = $existingThesis->source_code_name;
            if ($request->hasFile('file_source_code')) {
                if ($sourceCodePath) {
                    Storage::disk('public')->delete($sourceCodePath);
                }

                $sourceCodeName = $request->file('file_source_code')->getClientOriginalName();
                $sourceCodePath = $request->file('file_source_code')->storeAs($folderName, 'kode_' . Auth::user()->username . '.' . $request->file('file_source_code')->getClientOriginalExtension(), 'public');
            }

            $dataSourcePath = $existingThesis->file_data_source_path;
            $dataSourceName = $existingThesis->file_data_source_name;
            if ($request->hasFile('file_data_source')) {
                if ($dataSourcePath) {
                    Storage::disk('public')->delete($dataSourcePath);
                }

                $dataSourceName = $request->file('file_data_source')->getClientOriginalName();
                $dataSourcePath = $request->file('file_data_source')->storeAs($folderName, 'data_' . Auth::user()->username . '.' . $request->file('file_data_source')->getClientOriginalExtension(), 'public');
            }

            DB::table('thesis')
                ->where('id', $existingThesis->id)
                ->update([
                    'title' => $validated['thesis_title'],
                    'supervisor' => $validated['supervisor'],
                    'year' => $validated['year'],
                    'file_path' => $fileThesisPath,
                    'file_name' => $fileThesisName,
                    'source_code_path' => $sourceCodePath,
                    'source_code_name' => $sourceCodeName,
                    'file_data_source_path' => $dataSourcePath,
                    'file_data_source_name' => $dataSourceName,
                    'link_data_source' => $request->input('link_data_source'),
                    'updated_at' => now(),
                ]);

            DB::table('examiners')->where('thesis_id', $existingThesis->id)->delete();
            foreach ($request->input('examiners', []) as $examinerData) {
                try {
                    Examiner::create([
                        'thesis_id' => $existingThesis->id,
                        'name' => $examinerData,
                    ]);
                } catch (QueryException $th) {
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
        $path = $file->store('profile_pictures', 'public');

        $user->profile_picture = $path;
        $user->save();

        return back()->with('success', 'Profile picture updated!');
    }


}
