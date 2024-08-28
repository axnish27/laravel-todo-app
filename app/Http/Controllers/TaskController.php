<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('task.index', [
            'tasks' => Task::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'project_id' => $request->project_id,
            'user_id' => Auth::id()
        ]);


        redirect(route('/'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('task.edit', [
            'task' => Task::where('id',$id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Task::where('id',$id)->update($request-> except([
            '_token' , '_method'
        ]));
        redirect(route('/'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Task::where('id',$id)->delete();
        redirect(route('/'));
    }
}
