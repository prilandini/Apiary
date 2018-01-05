<?php

namespace App\Http\Controllers;

use App\User;
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
                "id" => $user->id,
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
                    "name"=> json_decode($user->company["name"]),
                    "catchPhrase"=> json_decode($user->company["catchPhrase"]),
                    "bs"=> json_decode($user->company["bs"])
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
            "id" => $user->id,
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
                "name"=> json_decode($user->company["name"]),
                "catchPhrase"=> json_decode($user->company["catchPhrase"]),
                "bs"=> json_decode($user->company["bs"])
                ]
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
            "id" => $user->id,
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
                "name"=> json_decode($user->company["name"]),
                "catchPhrase"=> json_decode($user->company["catchPhrase"]),
                "bs"=> json_decode($user->company["bs"])
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
            "id" => $user->id,
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
            "company" => json_decode($user->company)
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
        $user = User::find($id);
        $user->delete();
        $message = ["message"=>"success to delete"];
        
        return $message;
    }
}
