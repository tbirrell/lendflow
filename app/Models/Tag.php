<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends BaseModel
{
    use HasFactory;

    //=== RELATIONSHIPS ===//
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    //=== ATTRIBUTES ===//

    //=== SCOPES ===//

    //=== METHODS ===//
}
