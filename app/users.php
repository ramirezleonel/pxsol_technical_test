<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{ 
    protected $fillable = ["name","last_name"];

    protected $table = 'users';
    
    public function files()
    {
        return $this->hasMany(user_files::class, 'user_id', 'id');
    }
}
