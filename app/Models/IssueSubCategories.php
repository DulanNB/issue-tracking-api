<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Eloquent
 */

class IssueSubCategories extends Model
{
    use HasFactory;

    protected $fillable = ['subcategory_id','issue_id'];

}
