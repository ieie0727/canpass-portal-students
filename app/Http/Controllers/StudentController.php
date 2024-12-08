<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /** 一覧 */
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    /** 新規作成画面 */
    public function create()
    {
        return view('students.create');
    }

    /** 新規作成処理 */
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'family_name' => 'required|string|max:255',
            'given_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'birth_date' => 'required|date',
            'admission_date' => 'required|date',
            'status' => 'required|in:在籍,休塾,退塾',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 新規登録
        Student::create([
            'family_name' => $request->family_name,
            'given_name' => $request->given_name,
            'email' => $request->email,
            'birth_date' => $request->birth_date,
            'admission_date' => $request->admission_date,
            'status' => $request->status,
            'password' => Hash::make($request->password), // パスワードのハッシュ化
        ]);

        // リダイレクト
        return to_route('students.index')->with('success', '新規生徒を追加しました');
    }

    /** 詳細表示 */
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('students.show', compact('student'));
    }

    /** 編集画面 */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    /** 編集処理 */
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'family_name' => 'required|string|max:255',
            'given_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
            'birth_date' => 'required|date',
            'admission_date' => 'required|date',
            'status' => 'required|in:在籍,休塾,退塾',
        ]);

        // アップデート
        $student = Student::findOrFail($id);
        $student->update($request->all());

        return to_route('students.show', $student->id)->with('success', '生徒情報を更新しました');
    }

    /** 削除 */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('students.index')->with('success', '生徒情報を削除しました。');
    }
}
