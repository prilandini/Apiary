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

        $comments =null;
        
        if ($id = request()->postId) {
            $comments = Comment::where('postId', $id)->get();
        } else {
            $comments = Comment::with('user')->get();
        }

        $result = $comments->map(function($comment) {
            return [
                "postId" => (int) $comment->postId,
                "id" => (int) $comment->id,
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
            "postId" => (int) $comment->postId,
            "id" => (int) $comment->id,
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
            "postId" => (int) $comment->postId,
            "id" => (int) $comment->id,
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
            "postId" => (int) $comment->postId,
            "id" => (int) $comment->id,
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
        
        if ($comment==true) {
            return response(json_encode([],JSON_FORCE_OBJECT),200,['Content-Type'=>'applications/json']);
        }
    }
}
