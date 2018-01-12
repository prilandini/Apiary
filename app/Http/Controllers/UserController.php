<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Album;
use App\Todo;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        $result = $users->map(function($user) {
            return [
                "id" => (int) $user->id,
                "name" => $user->name,
                "username" => $user->username,
                "email" => $user->email,
                "address" => [
                    "street" => $user->street,
                    "suite" => $user->suite,
                    "city" => $user->city,
                    "zipcode" => $user->zipcode,
                    "geo" => [
                        "lat" => $user->lat,
                        "lng" => $user->lng,
                        ]
                    ],
                "phone" => $user->phone,
                "company" => [
                    "name"=> $user->company["name"],
                    "catchPhrase"=> $user->company["catchPhrase"],
                    "bs"=> $user->company["bs"]
                    ]
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
            "name" => 'required',
            "username" => 'required',
            "email" => 'required',
            "city" => 'required',
            "phone" => 'required',
            "password" => 'required'
        ]);

        $user = User::create($request->all());
        
        $result = [
            "id" => (int) $user->id,
            "name" => $user->name,
            "username" => $user->username,
            "email" => $user->email,
            "address" => [
                "street" => $user->street,
                "suite" => $user->suite,
                "city" => $user->city,
                "zipcode" => $user->zipcode,
                "geo" => [
                    "lat" => $user->lat,
                    "lng" => $user->lng,
                    ]
                ],
            "phone" => $user->phone,
            "company" => [
                "name"=> $user->company["name"],
                "catchPhrase"=> $user->company["catchPhrase"],
                "bs"=> $user->company["bs"]
            ],
            
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
        $user = User::find($id);

        $result = [
            "id" => (int) $user->id,
            "name" => $user->name,
            "username" => $user->username,
            "email" => $user->email,
            "address" => [
                "street" => $user->street,
                "suite" => $user->suite,
                "city" => $user->city,
                "zipcode" => $user->zipcode,
                "geo" => [
                    "lat" => $user->lat,
                    "lng" => $user->lng,
                    ]
                ],
            "phone" => $user->phone,
            "company" => [
                "name"=> $user->company["name"],
                "catchPhrase"=> $user->company["catchPhrase"],
                "bs"=> $user->company["bs"]
                ]
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
        $user = User::find($id);
        $user->update(request()->all());

        $result = [
            "id" => (int) $user->id,
            "name" => $user->name,
            "username" => $user->username,
            "email" => $user->email,
            "address" => [
                "street" => $user->street,
                "suite" => $user->suite,
                "city" => $user->city,
                "zipcode" => $user->zipcode,
                "geo" => [
                    "lat" => $user->lat,
                    "lng" => $user->lng,
                    ]
                ],
            "phone" => $user->phone,
            "company" => [
                "name"=> $user->company["name"],
                "catchPhrase"=> $user->company["catchPhrase"],
                "bs"=> $user->company["bs"]
                ]
        ];

        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        
        if ($user) {
            return response(json_encode([],JSON_FORCE_OBJECT),200,[
                'Content-Type'=>'applications/json'
            ]);
        }
    }

    public function getPosts($id)
    {
        $posts = Post::where("userId", $id)->get();

        $result = $posts->map(function($post) {
            return [
                "userId" => (int) $post->userId,
                "id" => (int) $post->id,
                "title" => $post->title,
                "body" => $post->body,
            ];
        });
        
        return $result;
    }

    public function getAlbums($id)
    {
        $albums = Album::where('userId', $id)->get();

        $result = $albums->map(function($album) {
            return [
                "userId" => (int) $album->userId,
                "id" => (int) $album->id,
                "title" => $album->title,
            ];
        });

        return $result;
    }

    public function getTodos($id) 
    {
        $todos = Todo::where('userId', $id)->get();
        
        $result = $todos->map(function($todo) {
            return [
                "userId" => (int) $todo->userId,
                "id" => (int) $todo->id,
                "title" => $todo->title,
                "completed" => (boolean)$todo->completed
            ];
        });

        return $result;
    }
}
