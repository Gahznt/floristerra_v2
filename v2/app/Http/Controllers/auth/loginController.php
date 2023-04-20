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
            return back()->with('error', $validator)->withInput();
            // return redirect()->route('login')->withErrors($validator)
        }

        if(Auth::attempt($data)){
            return redirect()->route('dashboard')->with('success', 'Seja bem-vindo de volta!');
        }else{
            return back()->with('error', 'Usuário ou senha incorretos');
        }
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:30'],
            'password' => ['required', 'string', 'min:6']
        ]);
    }
}
