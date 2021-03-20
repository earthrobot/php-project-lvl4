<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'status_id', 'assigned_to_id'];

    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by_id');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\TaskStatus');
    }

    public function assignedTo()
    {
        return $this->belongsTo('App\Models\User', 'assigned_to_id');
    }

    public function labels()
    {
        return $this->belongsToMany('App\Models\Label');
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
