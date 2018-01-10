<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = null;

        if ($id = request()->userId) {  
            $posts = Post::where('userId', $id)->get();
        } else {    
            $posts = Post::get();
        }

        $result = $posts->map(function($post) {
            return [
                "userId" => $post->userId,
                "id" => $post->id,
                "title" => $post->title,
                "body" => $post->body,
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
            "body" => 'required'
        ]);

        $post = Post::create($request->all());
        
        $result = [
            "userId" => $post->userId,
            "id" => $post->id,
            "title" => $post->title,
            "body" => $post->body,
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
        $post = Post::find($id);

        $result = [
            "userId" => $post->userId,
            "id" => $post->id,
            "title" => $post->title,
            "body" => $post->body,
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
        $post = Post::find($id);
        $post->update(request()->all());

        $result = [
                "userId" => $post->userId,
                "id" => $post->id,
                "title" => $post->title,
                "body" => $post->body,
            ];

        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        
        if ($post) {
            return response(json_encode([],JSON_FORCE_OBJECT),200,[
                'Content-Type'=>'applications/json'
            ]);
        }
    }

    public function getComments($id)
    {
        $comments = Comment::where('postId', $id)->get();

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
    
}
