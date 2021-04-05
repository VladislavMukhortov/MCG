<?php

namespace App\Http\Controllers\Api\v_1\Note;


use App\Http\Controllers\Controller;
use App\Http\Requests\NoteRequest;
use App\Models\Notes;
use App\Repositories\ContactNotesRepositoryEloquent;
use Illuminate\Http\Request;
use App\Repositories\NotesRepositoryEloquent;


class NoteController extends Controller
{

    protected $repository;

    public function __construct (NotesRepositoryEloquent $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        //
    }

    /**
     * Create new note
     *
     * @param NoteRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store (NoteRequest $request)
    {
        $note = $this->repository->store($request->all());

        if ($note) {
            return response()->json(['success' => true, 'messages' => [__('page.notes.create.success'),], 'data' => ['noteId' => $note->id,]]);
        }
    }

    public function update ()
    {
        //
    }

    /**
     * Deslete note by ID
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy ($id)
    {
        $note = Notes::where('id', $id)->first()->delete();

        if ($note) {
            return response()->json(['success' => true, 'messages' => [__('page.notes.delete.success')]]);
        }
    }
}
