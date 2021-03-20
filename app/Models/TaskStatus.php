<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */

    protected $casts = [
        'created_at' => 'datetime:d.m.Y',
    ];
}
