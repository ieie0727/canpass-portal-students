<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Record;
use App\Models\Section;

class HomeController extends Controller
{
    public function index()
    {
        $student_id = Auth::user()->id;

        // 学習進捗データ
        $totalSections = Section::count();
        $completedSections = Record::where('student_id', $student_id)->distinct('section_id')->count('section_id');
        $remainingSections = $totalSections - $completedSections;

        // 合格数の推移データ
        $progressData = Record::where('student_id', $student_id)
            ->where('is_passed', true)
            ->selectRaw('DATE(updated_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('count', 'date')
            ->toArray();

        // データが空の場合のデフォルト値
        if (empty($progressData)) {
            $progressData = ['No Data' => 0];
        }

        // 最近の履歴
        $recentRecords = Record::where('student_id', $student_id)
            ->with('section')
            ->latest('updated_at')
            ->take(5)
            ->get();

        return view('home', compact(
            'completedSections',
            'remainingSections',
            'progressData',
            'recentRecords'
        ));
    }
}
