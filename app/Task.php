<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


/**
 * Properties:
 * @property-read int                                            $id
 * @property string                                              $title
 * @property string                                              $description
 * @property \Carbon\Carbon                                      $created_at
 * @property \Carbon\Carbon                                      $updated_at
 *
 * Relations:
 * @property \App\Image                           $image              {@see Task::images()}
 */
class Task extends Model
{
    protected $fillable = ['title', 'description'];

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }
}
