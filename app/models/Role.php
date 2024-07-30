<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $primaryKey = 'role_id';

    protected $fillable = [
        'role_name',
    ];

    public function groups()
    {
        return $this->hasMany(Group::class, 'role_id', 'role_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'groups', 'role_id', 'user_id');
    }
}
