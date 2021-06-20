<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * Gets all the users with this role.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
