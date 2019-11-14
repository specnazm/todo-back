<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    
        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'title', 'description', 'priority', 'completed', 'user_id'
        ];

       
       protected $table = 'tasks';
}
