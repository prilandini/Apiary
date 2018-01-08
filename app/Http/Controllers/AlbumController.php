<?php

namespace App\Http\Controllers;

use App\Album;
use Illuminate\Http\Request;
use function GuzzleHttp\json_encode;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Album::all();

        $result = $albums->map(function($album) {
            return [
                "userId" => $album->userId,
                "id" => $album->id,
                "title" => $album->title,
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
            'userId' => 'required',
            'title' => 'required'
        ]);

        $album = Album::create($request->all());

        $result = [
                "userId" => $album->userId,
                "id" => $album->id,
                "title" => $album->title,
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
        $album = Album::find($id);

        $result = [
            "userId" => $album->userId,
            "id" => $album->id,
            "title" => $album->title,
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
        $album = Album::find($id);
        $album->update(request()->all());

        $result = [
            "userId" => $album->userId,
            "id" => $album->id,
            "title" => $album->title,
            ]; 

        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Album $album)
    {
        $album->delete();
        
        if ($album) {
            return response(json_encode([],JSON_FORCE_OBJECT), 200, [
                'Content-Type'=>'application/json'
            ]);
        }
    }
}
