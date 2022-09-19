<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
* @mixin Eloquent
*/

class Categories extends Model
{
    use HasFactory;
    protected $fillable = ['name','description'];

    /**
     * @return HasMany
     */
    public function subCategories(): HasMany
    {
        return $this->hasMany(SubCategories::class);
    }

}
