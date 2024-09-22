<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        echo "Estou no index";
    }

    public function newNote()
    {
        echo "Estou na NewNote";
    }
}
