<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Question;
use App\Models\Record;
use Illuminate\Support\Facades\Auth;


class TestController extends Controller
{
    /** テストのホーム画面 */
    public function home()
    {
        return view('tests.home');
    }


    /** 教科の単元一覧 */
    public function subject($subject)
    {
        $student_id = Auth::user()->id;

        $sections = Section::where('subject', $subject)
            ->withCount('questions')
            ->orderBy('number', 'asc')
            ->get();

        $records = Record::where('student_id', $student_id)
            ->whereIn('section_id', $sections->pluck('id'))
            ->get()
            ->keyBy('section_id');

        return view('tests.subject', compact('subject', 'sections', 'records'));
    }


    /**1回目の解答画面 */
    public function try(Request $request)
    {
        $section_id = $request->section_id;

        // セクションの存在確認
        $section = Section::find($section_id);
        if (!$section) {
            return redirect()->route('tests.home')->with('error', '指定された単元が存在しません。');
        }

        // セクションに紐付く問題を取得
        $questions = Question::where('section_id', $section_id)
            ->orderBy('number', 'asc')
            ->get();

        return view('tests.try', compact('questions', 'section'));
    }


    /**最初の提出処理 */
    public function submit(Request $request, $section_id)
    {
        $student_id = Auth::user()->id;
        $answers = $request->input('answers', []);

        // セクションに関連する質問を取得
        $section = Section::findOrFail($section_id);
        $questions = Question::where('section_id', $section_id)->get();

        // 集計処理
        $corrects = [];
        $incorrects = [];

        foreach ($questions as $question) {
            //生徒の解答を判定
            $studentAnswer = $answers[$question->id] ?? null;
            $isCorrect = $studentAnswer == $question->correct_answer;

            //正解・不正解のIDを記録
            if ($isCorrect) {
                $corrects[] = $question->id; // 正解した質問IDを記録
            } else {
                $incorrects[] = $question->id; // 不正解の質問IDを記録
            }
        }

        // 合格判定
        $score = count($corrects);
        $is_passed = $score >= $section->passing_score;

        // レコードの保存
        Record::create([
            'student_id' => $student_id,
            'section_id' => $section_id,
            'attempt_number' => 1,
            'score' => $score,
            'corrects' => implode(',', $corrects), // 配列をカンマ区切りで保存
            'incorrects' => implode(',', $incorrects),
            'is_passed' => $is_passed,
        ]);

        // リダイレクトして結果を表示
        return redirect()->route('tests.record', ['section_id' => $section_id]);
    }


    /**2回目以降の解答画面 */
    public function retry($section_id)
    {
        $student_id = Auth::user()->id;

        // セクションの確認
        $section = Section::findOrFail($section_id);

        // セクションに関連する質問を取得
        $questions = Question::where('section_id', $section_id)
            ->orderBy('number', 'asc')
            ->get();

        // 過去の回答を取得
        $record = Record::where('student_id', $student_id)
            ->where('section_id', $section_id)
            ->first();

        $answers = [];
        if ($record) {
            $questionIds = explode(',', $record->corrects . ',' . $record->incorrects);
            foreach ($questionIds as $questionId) {
                $answers[$questionId] = $record->corrects ? '正解' : '不正解'; // 例示的な取得法
            }
        }

        return view('tests.retry', compact('section', 'questions', 'answers'));
    }


    /**再提出処理 */
    public function resubmit(Request $request, $section_id)
    {
        $student_id = Auth::user()->id;

        // 回答データを取得
        $answers = $request->input('answers', []);

        // セクションと質問を取得
        $section = Section::findOrFail($section_id);
        $questions = Question::where('section_id', $section_id)->get();
        $record = Record::where('student_id', $student_id)->where('section_id', $section_id)->first();

        // 再集計
        $corrects = [];
        $incorrects = [];

        foreach ($questions as $question) {
            $studentAnswer = $answers[$question->id] ?? null;
            $isCorrect = $studentAnswer == $question->correct_answer;

            if ($isCorrect) {
                $corrects[] = $question->id;
            } else {
                $incorrects[] = $question->id;
            }
        }

        // 合格判定
        $score = count($corrects);
        $is_passed = $score >= $section->passing_score;

        // レコードを更新
        $record->update(
            [
                'score' => $score,
                'corrects' => implode(',', $corrects),
                'incorrects' => implode(',', $incorrects),
                'attempt_number' => $record->attempt_number + 1,
                'is_passed' => $is_passed,
                'updated_at' => now(),
            ]
        );

        // 結果表示ページへリダイレクト
        return redirect()->route('tests.record', ['section_id' => $section_id])
            ->with('success', '回答を再提出しました！');
    }


    //結果の表示
    public function record($section_id)
    {
        $student_id = Auth::user()->id; // ログイン中の生徒IDを取得

        // 指定されたセクションと記録を取得
        $section = Section::findOrFail($section_id);
        $record = Record::where('student_id', $student_id)
            ->where('section_id', $section_id)
            ->firstOrFail();

        // 質問リストを取得
        $questions = Question::where('section_id', $section_id)
            ->orderBy('number', 'asc')
            ->get();

        return view('tests.record', compact('section', 'record', 'questions'));
    }
}
