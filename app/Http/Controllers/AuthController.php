<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {
        // form validation
        $request->validate(
            [
                'text_username' => 'required|email',
                'text_password' => 'required|min:6|max:16'
            ],
            // error messages
            [
                'text_username.required' => 'Username é obrigatório',
                'text_username.email' => 'O username deve ser um email válido',
                'text_password.required' => 'A senha é obrigatória',
                'text_password.min' => 'A senha deve ter pelo menos :min caracteres',
                'text_password.max' => 'A senha deve ter no maximo :max caracteres'
            ]
        );

        // get todos os usuarios do banco de dados
        // $users = User::all()->toArray();

        // como uma instancia de um objeto da classe Models\User

        $userModel = new User();
        $users = $userModel->all()->toArray();

        echo '<pre>';
        print_r($users);
        echo '</pre>';
    }

    public function logout()
    {
        echo 'logout';
    }
}
