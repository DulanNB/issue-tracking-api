<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Eloquent
 */

class IssueCategories extends Model
{
    use HasFactory;

    protected $fillable = ['category_id','issue_id'];

}
