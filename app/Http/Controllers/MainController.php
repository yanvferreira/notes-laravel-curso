<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MainController extends Controller
{
    public function index()
    {
        //carrega notas do usuario
        $id = session('user.id');
        $user = User::find($id)->toArray();
        $notes = User::find($id)->notes()->get()->toArray();

        echo '<pre>';
        print_r($user);
        print_r($notes);
        echo '</pre>';

        die();

        // exibe a view home
        return view('home');
    }

    public function newNote()
    {
        echo "Estou na NewNote";
    }
}
