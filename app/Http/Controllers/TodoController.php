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
        $todos = null;

        if ($id = request()->userId) {
            $todos = Todo::where('userId', $id)->get();
        } else {
            $todos = Todo::get();
        }

        $result = $todos->map(function($todo) { 
            return [
                "userId" => (int) $todo->userId,
                "id" => (int) $todo->id,
                "title" => $todo->title,
                "completed" => (boolean) $todo->completed 
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
            "userId" => (int) $todo->userId,
            "id" => (int) $todo->id,
            "title" => $todo->title,
            "completed" => (boolean) $todo->completed
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
            "userId" => (int) $todo->userId,
            "id" => (int) $todo->id,
            "title" => $todo->title,
            "completed" => (boolean) $todo->completed
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
            "userId" => (int) $todo->userId,
            "id" => (int) $todo->id,
            "title" => $todo->title,
            "completed" => (boolean) $todo->completed
        ];

        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        
        if ($todo) {
            return response(json_encode([],JSON_FORCE_OBJECT),200,[
                'Content-Type'=>'applications/json'
            ]);
        }
    }
}
