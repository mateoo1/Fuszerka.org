<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    //Table Name
    protected $table = 'replies';

    //Primary Key
    public $primaryKey = 'id';
    
    //Timestamps
    public $timestamps = true;
    
    public function comment() {

        return $this->belongsTo('App\Comment');
        
    }
}
