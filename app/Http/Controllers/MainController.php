<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Services\Operations;

class MainController extends Controller
{
    public function index()
    {
        //carrega notas do usuario
        $id = session('user.id');
        //$user = User::find($id)->toArray();
        $notes = User::find($id)->notes()->get()->toArray();

        // exibe a view home
        return view('home', ['notes' => $notes]);
    }

    public function newNote()
    {
        echo "Estou na NewNote";
    }

    public function editNote($id)
    {
        // $id = $this->decryptId($id);
        $id = Operations::decryptId($id);

        echo "Estou editando a nota com id: " . $id;
    }

    public function deleteNote($id)
    {
        $id = Operations::decryptId($id);

        echo "Estou editando a nota com id: " . $id;
    }

}
