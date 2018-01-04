<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $comments = Comment::all()->load('user');

        $comments = Comment::with('user')->get();

        $result = $comments->map(function($comment) {
            return [
                "postId" => $comment->postId,
                "id" => $comment->id,
                "name" => $comment->user['name'],
                "email" => $comment->user['email'],
                "body" => $comment->body
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
            "postId" => 'required',
            "body" => 'required'
        ]);

        $comment = Comment::create($request->all());
        
        $result = [
            "postId" => $comment->postId,
            "id" => $comment->id,
            "name" => $comment->user['name'],
            "email" => $comment->user['email'],
            "body" => $comment->body
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
        $comment = Comment::find($id);

        $result = [
            "postId" => $comment->postId,
            "id" => $comment->id,
            "name" => $comment->user['name'],
            "email" => $comment->user['email'],
            "body" => $comment->body
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
        $comment = Comment::find($id);

        $comment->update(request()->all());

        $result = [
            "postId" => $comment->postId,
            "id" => $comment->id,
            "name" => $comment->user['name'],
            "email" => $comment->user['email'],
            "body" => $comment->body
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
        $comment = Comment::find($id);
        $comment->delete();
        $message = ["message"=>"success to delete"];
        
        return $message;
    }
}
