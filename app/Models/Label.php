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

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Task', 'label_task', 'task_id', 'label_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'created_by_id');
    }
}
