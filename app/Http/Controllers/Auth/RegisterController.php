<?php

namespace App\Http\Controllers\Auth;

use App\Grade;
use App\Institution;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

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
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'grade' => 'required|max:255',
            'identification_document' => 'nullable',
            'telephone' => 'nullable',
            'address' => 'nullable',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'active' => 1,
            'role' => 'USER',
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'grade' => $data['grade'],
            'institution_ref' => $data['institution_ref'],
            'identification_document' => $data['identification_document'],
            'telephone' => $data['telephone'],
            'address' => $data['address'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function showRegistrationForm()
    {
        $grades = Grade::all();
        $institutions = Institution::all();
        return view('auth.register', ['grades' => $grades, 'institutions' => $institutions]);
    }
}
