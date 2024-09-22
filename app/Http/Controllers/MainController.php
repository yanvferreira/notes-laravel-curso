<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

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
        $id = $this->descryptId($id);

        echo "Estou editando a nota com id: " . $id;
    }

    public function deleteNote($id)
    {
        $id = $this->descryptId($id);
        
        echo "Estou editando a nota com id: " . $id;
    }

    private function descryptId($id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->route('home');
        }

        return $id;
    }
}
