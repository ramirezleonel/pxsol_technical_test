<?php

namespace App\Http\Controllers;

use App\user_files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class UserFilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_files = user_files::all();
        return  $user_files;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\user_files  $user_files
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $query = DB::select((DB::raw("SELECT id as user_id FROM users where id={$id} and deleted_at is null")));
    
        $query2 = DB::select(DB::raw("SELECT id,file_name,url,created_at FROM user_files where user_id={$id} and deleted_at is null"));
        $json = collect($query[0]);
        $json["files"]= $query2;

        return $json;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user_files  $user_files
     * @return \Illuminate\Http\Response
     */
    public function edit(user_files $user_files)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user_files  $user_files
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user_files $user_files)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user_files  $user_files
     * @return \Illuminate\Http\Response
     */
    public function destroy(user_files $user_files)
    {
        //
    }
}
