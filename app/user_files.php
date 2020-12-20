<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_files extends Model
{ 
   protected $fillable = ["user_id","file_name","url"];
}
