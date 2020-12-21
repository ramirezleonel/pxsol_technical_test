<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_files extends Model
{ 
   protected $fillable = [
       "user_id",
       "file_name",
       "url"
    ];

   protected $table = 'user_files';


   public function users()
   {
       return $this->hasOne(users::class, 'user_id', 'id');
   }
}
