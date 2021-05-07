<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Google\ApiCore\ValidationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
//use App\Google\Auth\ClientAuth;
use App\Google\Vision\Client;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::all();
        return view('photos.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @throws ValidationException
     */
    public function create()
    {
        return view('photos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $photo = new Photo();
        $photo->user_id = 1;
        $photo->url = $request->url;
        $photo->save();

        return redirect()->route('photos.index');
    }

    /**
     * Display the specified resource.
     *$id
     * @param  int  $id
     * @return void
     */
    public function show()
    {
        /*$clientStorage = new ClientAuth();
        $clientStorage->
        auth_cloud_explicit(config('services.google.vision.project-id'), config('services.google.vision.json-key'));*/

        //dd(config('services.google.vision.json-key'));
        return Client::test();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
