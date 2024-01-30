<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class loginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $data = $request->only(['email', 'password']);
        $validator = $this->validator($data);

        if ($validator->fails()) {
            return back()->with('error', $validator)->withInput();
        }

        if (Auth::attempt($data)) {
            return redirect()->route('dashboard')->with('success', 'Seja bem-vindo de volta!');
        } else {
            return back()->with('error', 'Usuário ou senha incorretos');
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:30'],
            'password' => ['required', 'string', 'min:6']
        ]);
    }

    public function profile()
    {
        return view('painel.profile.index');
    }

    public function changePassword(Request $request)
    {
        // Obtenha o usuário logado
        $user = Auth::user();

        // Verifique se a senha fornecida está correta
        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Senha incorreta');
            return redirect()->back();
        }

        if (isset($request->new_password)) {
            if (strlen($request->new_password) >= 6) {
                if ($request->new_password === $request->password_confirmation) {
                    $user->password = Hash::make($request->new_password);
                } else {
                    return back()->with('error', 'A confirmação da senha não confere');
                }
            } else {
                return back()->with('error', 'A senha precisa ter no mínimo 6 caracteres');
            }
        }

        $user->save();
        return back()->with('success', 'Senha atualizada com sucesso');

    }
}
