<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'imagename'
    ];
  
    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setImageNamesAttribute($value)
    {
        $this->attributes['imagename'] = json_encode($value);
    }
}
