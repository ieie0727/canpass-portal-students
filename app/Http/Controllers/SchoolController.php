<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Score;
use App\Models\Student;


class SchoolController extends Controller
{
    // 定数として宣言
    public const SCORE_OBJ = [
        1 => '１学期中間',
        2 => '１学期期末',
        3 => '２学期中間',
        4 => '２学期期末',
        5 => '学年末',
    ];

    public const GRADE_OBJ = [
        1 => '１学期',
        2 => '２学期',
        3 => '３学期',
        4 => '学年',
    ];

    public const SUBJECT_NAMES = [
        '国語',
        '数学',
        '英語',
        '社会',
        '理科',
        '音楽',
        '美術',
        '保体',
        '技家',
    ];

    public const SUBJECT_COLUMNS = [
        'japanese',
        'math',
        'english',
        'social',
        'science',
        'music',
        'art',
        'physical',
        'industrial',
    ];


    /** 初期動作 */
    public function __construct()
    {
        view()->share('SCORE_OBJ', self::SCORE_OBJ);
        view()->share('GRADE_OBJ', self::GRADE_OBJ);
        view()->share('SUBJECT_NAMES', self::SUBJECT_NAMES);
        view()->share('SUBJECT_COLUMNS', self::SUBJECT_COLUMNS);
    }



    /** 一覧表示 */
    public function index($id, Request $request)
    {
        $student = Student::find($id);
        $grade = $request->query('grade');

        // 学年が指定されていない場合の処理
        if (!$grade) {
            return view('schools.index', [
                'message' => '学年を指定してください。',
                'scores' => [],
                'grades' => []
            ]);
        }

        $scores = Score::where('student_id', $id)
            ->where('grade', $grade)
            ->get();

        $grades = Grade::where('student_id', $id)
            ->where('grade', $grade)
            ->get();

        return view('schools.index', compact('student', 'scores', 'grades'));
    }



    /** 新規画面 */
    public function create() {}


    /** 新規処理 */
    public function store(Request $request) {}



    /** 定期テスト編集 */
    public function editScore($id)
    {
        $score = Score::findOrFail($id);
        return view('schools.scores.edit', compact('score'));
    }

    public function updateScore(Request $request, $id)
    {
        $request->validate([
            'japanese' => 'required|integer|min:0|max:100',
            'math' => 'required|integer|min:0|max:100',
            // 他の科目も同様に
        ]);

        $score = Score::findOrFail($id);
        $score->update($request->all());

        return redirect()->route('schools.index', ['id' => $score->student_id, 'grade' => $score->grade])
            ->with('success', 'スコアが更新されました。');
    }

    /** 内申点編集 */
    public function editGrade($id)
    {
        $grade = Grade::findOrFail($id);
        return view('schools.grades.edit', compact('grade'));
    }

    public function updateGrade(Request $request, $id)
    {
        $request->validate([
            'japanese' => 'required|integer|min:1|max:5',
            'math' => 'required|integer|min:1|max:5',
            // 他の科目も同様に
        ]);

        $grade = Grade::findOrFail($id);
        $grade->update($request->all());

        return redirect()->route('schools.index', ['id' => $grade->student_id, 'grade' => $grade->grade])
            ->with('success', '内申点が更新されました。');
    }

    /** 削除処理 */
    public function destroy($id) {}
}
