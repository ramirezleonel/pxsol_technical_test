<?php

namespace App\Http\Controllers;

use App\users;
use Illuminate\Http\Request;

class usersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $users =users::select(['id'])->where('deleted_at', null)
            ->with(['files' => function ($query) {
                $query->where("deleted_at",null);
            }])->get();
            return  response()->json($users,200);
        }catch(Exception $ex){
            return  response()->json(500);
        }
      
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
    public function show(user_files $user_files)
    {
        //
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
