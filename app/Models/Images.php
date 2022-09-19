<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Eloquent
 */

class Images extends Model
{
    use HasFactory;

    protected $fillable = ['imagable_type','imagable_id','size','path','name','extension'];

    public function imagable(){
        return $this->morphTo();
    }
}
