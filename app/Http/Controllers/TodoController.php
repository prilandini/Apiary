<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::all();

        $result = $todos->map(function($todo) {
            return [
                "userId" => $todo->userId,
                "id" => $todo->id,
                "title" => $todo->title,
                "completed" => $todo->completed 
            ];
        });

        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        request()->validate([
            "userId" => 'required',
            "title" => 'required',
            "completed" => 'required'
        ]);

        $todo = Todo::create($request->all());

        $result = [
            "userId" => $todo->userId,
            "id" => $todo->id,
            "title" => $todo->title,
            "completed" => $todo->completed
        ];

        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo = Todo::find($id);
        
        $result = [
            "userId" => $todo->userId,
            "id" => $todo->id,
            "title" => $todo->title,
            "completed" => $todo->completed
        ];

        return $result;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $todo = Todo::find($id);
        $todo->update(request()->all());

        $result = [
            "userId" => $todo->userId,
            "id" => $todo->id,
            "title" => $todo->title,
            "completed" => $todo->completed
        ];

        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::find($id);
        $todo->delete();
        $message = ["message"=>"success to delete"];
        
        return $message;
    }
}
