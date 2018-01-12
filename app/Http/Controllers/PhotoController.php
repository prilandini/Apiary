<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = null;

        if ($id = request()->albumId) {
            $photos = Photo::where('albumId', $id)->get();
        } else {
            $photos = Photo::get();
        }
        
        $result = $photos->map(function($photo) {
            return [
                "albumId" => (int) $photo->albumId,
                "id" => (int) $photo->id,
                "title" => $photo->title,
                "url" => $photo->url,
                "thumbnailUrl" => $photo->thumbnailUrl
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
            "albumId" => 'required',
            "title" => 'required',
            "url" => 'required',
            "thumbnailUrl" => 'required'
        ]);

        $photo = Photo::create($request->all());
        
        $result = [
            "albumId" => (int) $photo->albumId,
            "id" => (int) $photo->id,
            "title" => $photo->title,
            "url" => $photo->url,
            "thumbnailUrl" => $photo->thumbnailUrl
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
        $photo = Photo::find($id);
        
        $result = [
            "albumId" => (int) $photo->albumId,
            "id" => (int) $photo->id,
            "title" => $photo->title,
            "url" => $photo->url,
            "thumbnailUrl" => $photo->thumbnailUrl
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
        $photo = Photo::find($id);
        $photo->update(request()->all());

        $result = [
            "albumId" => (int) $photo->albumId,
            "id" => (int) $photo->id,
            "title" => $photo->title,
            "url" => $photo->url,
            "thumbnailUrl" => $photo->thumbnailUrl
            ];
        
        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        $photo->delete();
        
        if ($photo) {
            return response(json_encode([],JSON_FORCE_OBJECT),200,[
                'Content-Type'=>'application/json'
            ]);
        }
    }
}
