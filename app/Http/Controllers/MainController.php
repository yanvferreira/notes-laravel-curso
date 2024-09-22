<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        //carrega notas do usuario

        // exibe a view home
        return view('home');
    }

    public function newNote()
    {
        echo "Estou na NewNote";
    }
}
