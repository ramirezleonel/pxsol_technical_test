<?php

namespace App\Http\Controllers;

use App\user_files;
use App\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
    }

      /**
     * Save new file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveFile(Request $request)
    {
        if($request->file != null && $request->user_id != null){

            $result = $request->file('file')->storeAs('public',$request->file->getClientOriginalName());
            $path = Storage::disk('files')->getAdapter()->getPathPrefix();

            $uploaded_file=  user_files::create([
                    'user_id'=> $request->user_id,
                    'file_name'=> $request->file->getClientOriginalName() ,
                    'url'=> $path . $request->file->getClientOriginalName(),
                    ]
            );
            $user_files =users::where('deleted_at', null)
                ->where('id', 1)
                ->with(['files' => function ($query) {
                    $query->where("deleted_at",null)
                    ->orderBy('created_at','desc')
                    ->orderBy('file_name','desc');
                }])->first();
               
            $json["user_id"] = $user_files->id;
            $json["uploaded_file"] = $uploaded_file;
            $json["files"] = $user_files->files;
               
                return $json;
        }
        return ["result" => "404"];
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
