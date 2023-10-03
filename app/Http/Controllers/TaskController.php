<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cardid = request()->query('cardid');
        $card = Card::findOrFail($cardid);
        return view('task.create', [
            'card' => $card,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'cardid' => 'required|exists:cards,id'
        ]);
        $cardid = $request->cardid;
        $card = Card::findOrFail($cardid);
        $task = new Task();
        $task->name = $request->name;
        $task->description = $request->description;
        $task->card_id = $card->id;
        $task->save();
        return redirect()->route('boards.show', ['board' => $card->board_id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::findOrFail($id);
        $comments = [
            [
                'id' => 1,
                'name' => 'John Doe',
                'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, diam sit amet aliquet ultricies, nunc nisl ultrices nunc, quis aliquam nisl nunc eu nisl. Sed vitae nisl eget nisl aliquam ultricies. Sed vitae nisl eget nisl aliquam ultricies.',
                'created_at' => '2021-10-01 12:00:00',
            ],
            [
                'id' => 2,
                'name' => 'John Doe',
                'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, diam sit amet aliquet ultricies, nunc nisl ultrices nunc, quis aliquam nisl nunc eu nisl. Sed vitae nisl eget nisl aliquam ultricies. Sed vitae nisl eget nisl aliquam ultricies.',
                'created_at' => '2021-10-01 12:00:00',
            ],
            [
                'id' => 3,
                'name' => 'John Doe',
                'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, diam sit amet aliquet ultricies, nunc nisl ultrices nunc, quis aliquam nisl nunc eu nisl. Sed vitae nisl eget nisl aliquam ultricies. Sed vitae nisl eget nisl aliquam ultricies.',
                'created_at' => '2021-10-01 12:00:00',
            ],
        ];
        return view('task.show', [
            'task' => $task,
            'comments' => $comments,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
