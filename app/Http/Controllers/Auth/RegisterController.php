<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        info("Creating a new student record...");
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'family_name' => ['required', 'string', 'max:255'],
            'given_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:students'],
            'birth_date' => ['required', 'date'],
            'admission_date' => ['required', 'date'],
            'withdrawal_date' => ['nullable', 'date'],
            //'status' => ['required', 'in:在籍,休塾,退塾'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new student instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Student
     */
    protected function create(array $data)
    {
        Log::info("新規登録が押されました");
        return Student::create([
            'role' => 'student',
            'family_name' => $data['family_name'],
            'given_name' => $data['given_name'],
            'email' => $data['email'],
            'birth_date' => $data['birth_date'],
            'admission_date' => $data['admission_date'],
            'withdrawal_date' => $data['withdrawal_date'] ?? null,
            'status' => $data['status'] ?? "在籍",
            'password' => Hash::make($data['password']),
        ]);
    }
}
