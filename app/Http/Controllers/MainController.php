<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Services\Operations;
use App\Models\Note;

class MainController extends Controller
{
    public function index()
    {
        //carrega notas do usuario
        $id = session('user.id');
        //$user = User::find($id)->toArray();
        $notes = User::find($id)
                    ->notes()
                    ->whereNull('deleted_at')
                    ->get()
                    ->toArray();

        // exibe a view home
        return view('home', ['notes' => $notes]);
    }

    public function newNote()
    {
        return view('new_note');
    }

    public function newNoteSubmit(Request $request)
    {
        // validar requisição
        $request->validate(
            [
                'text_title' => 'required|min:3|max:200',
                'text_note' => 'required|min:3|max:3000'
            ],
            // error messages
            [
                'text_title.required' => 'O título é obrigatório',
                'text_title.min' => 'O título deve ter pelo menos :min caracteres',
                'text_title.max' => 'O título deve ter no maximo :max caracteres',
                'text_note.required' => 'A nota é obrigatória',
                'text_note.min' => 'A nota deve ter pelo menos :min caracteres',
                'text_note.max' => 'A nota deve ter no maximo :max caracteres'
            ]
        );

        // pegar id do usuario
        $id = session(('user.id'));


        // criar uma nova nota
        $note = new Note();
        $note->user_id = $id;
        $note->title = $request->text_title;
        $note->text = $request->text_note;

        $note->save();

        // redirecionar para a home
        return redirect()->route('home');
    }

    public function editNote($id)
    {
        // $id = $this->decryptId($id);
        $id = Operations::decryptId($id);

        // carregar notas
        $nota = Note::find($id);

        // exibir a view de edição
        return view('edit_note', ['nota' => $nota]);
    }

    public function editNoteSubmit(Request $request)
    {
        // validar requisição
        $request->validate(
            [
                'text_title' => 'required|min:3|max:200',
                'text_note' => 'required|min:3|max:3000'
            ],
            // error messages
            [
                'text_title.required' => 'O título é obrigatório',
                'text_title.min' => 'O título deve ter pelo menos :min caracteres',
                'text_title.max' => 'O título deve ter no maximo :max caracteres',
                'text_note.required' => 'A nota é obrigatória',
                'text_note.min' => 'A nota deve ter pelo menos :min caracteres',
                'text_note.max' => 'A nota deve ter no maximo :max caracteres'
            ]
        );

        // checkar se o id existe
        if($request->nota_id == null){
            return redirect()->route('home');
        }

        // decryptar o id
        $id = Operations::decryptId($request->nota_id);

        // carregar nota
        $nota = Note::find($id);

        // atualizar nota
        $nota->title = $request->text_title;
        $nota->text = $request->text_note;
        $nota->save();

        // redirecionar para a home
        return redirect()->route('home');
    }

    public function deleteNote($id)
    {
        $id = Operations::decryptId($id);

        // carregar nota
        $nota = Note::find($id);

        // mostrar a view de confirmação
        return view('delete_note', ['nota' => $nota]);

    }

    public function deleteNoteConfirm($id)
    {
        $id = Operations::decryptId($id);

        // carregar nota

        $nota = Note::find($id);

        // 1. Hard delete - Deleta a nota do banco de dados
        // $nota->delete();

        // 2. soft delete
        $nota->deleted_at = date('d-m-Y H:i:s');
        $nota->save();

        // redirecionar para home
        return redirect()->route('home');
    }
}
