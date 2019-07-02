<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function task()
    {
        return $this->belongsTo('App\Task', 'task_id', 'id');
    }
}
