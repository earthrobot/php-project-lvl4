<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Label extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'created_by_id');
    }

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Task');
    }

    /**
     * The attributes that should be cast.
     *
     * @var array
     */

    protected $casts = [
        'created_at' => 'datetime:d.m.Y',
    ];
}
