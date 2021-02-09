<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:20', 'unique:userdetails,name'],
            'email' => ['required', 'unique:userdetails,email', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:5', 'max:20', 'confirmed'],
            'url' => ['nullable', 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'],
            'dob' => ['required', 'date', 'before:-18 years'],
            'g-recaptcha-response' => ['required', 'recaptcha'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'url' => $data['url'],
            'dob' => $data['dob'],
        ]);
    }
}
