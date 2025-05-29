<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Thesis;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {   
        return view('home.index');
    }

    public function adminIndex()
    {
        $labelsThesis = [];
        $dataThesis = [];

        $currentYear = Carbon::now()->year;
        $allMonthsThesis = [];

        for ($i = 1; $i <= 12; $i++) {
            $month = Carbon::create($currentYear, $i, 1)->format('Y-m');
            $allMonthsThesis[$month] = 0;
        }

        $thesis = \DB::table('thesis')
            ->select(\DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), \DB::raw('count(*) as total'))
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        foreach ($thesis as $thesis_list) {
            $allMonthsThesis[$thesis_list->month] = $thesis_list->total;
        }

        $labelThesis = array_keys($allMonthsThesis);
        $dataThesis = array_values($allMonthsThesis);

        $userCount = User::where('role', 'user')->count();
        $thesisCount = Thesis::count();

        $newThesis = Thesis::with('user')->limit(5)->get();
        
        return view('home.index-admin', compact('labelThesis', 'dataThesis', 'userCount', 'thesisCount', 'newThesis'));
    }
}
