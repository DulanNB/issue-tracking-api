<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Eloquent
 */

class Comments extends Model
{
    use HasFactory;

    protected $fillable = ['issue_id','body'];

    public function images()
    {
        return $this->morphMany(Images::class,'imagable','imagable_type');
    }
}
