<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    protected $student;

    public function __construct()
    {
        // 認証済みユーザーのデータを取得
        $this->middleware(function ($request, $next) {
            $this->student = Student::findOrFail(Auth::user()->id);
            return $next($request);
        });
    }

    /** 詳細表示 */
    public function show()
    {
        $student = $this->student; // 自分自身のデータ
        return view('students.show', compact('student'));
    }

    /** 編集画面 */
    public function edit()
    {
        $student = $this->student;
        return view('students.edit', compact('student'));
    }

    /** 編集処理 */
    public function update(Request $request)
    {
        // バリデーション
        $request->validate([
            'family_name' => 'required|string|max:255',
            'given_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $this->student->id,
            'birth_date' => 'required|date',
        ]);

        // 自分の情報を更新
        $this->student->update($request->all());

        return redirect()->route('students.show')
            ->with('success', '生徒情報を更新しました');
    }
}
