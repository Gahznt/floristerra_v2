<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;

class loginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function authenticate(Request $request){
        $data = $request->only(['email', 'password']);
        $validator = $this->validator($data);

        if($validator->fails()){
            return redirect()->route('login')->withErrors($validator)->withInput();
        }

        if(Auth::attempt($data)){
            return redirect()->route('dashboard');
        }else{
            toastr()->error('Usuário ou senha incorretos', 'Erro');
            return redirect()->route('login');
        }
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:30'],
            'password' => ['required', 'string', 'min:6']
        ]);
    }
}
