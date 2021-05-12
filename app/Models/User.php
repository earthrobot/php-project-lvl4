<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany('App\Models\Task', 'created_by_id');
    }

    public function assigned_tasks(): HasMany
    {
        return $this->hasMany('App\Models\Task', 'assigned_to_id');
    }

    public function labels(): HasMany
    {
        return $this->hasMany('App\Models\Label', 'created_by_id');
    }

    public function task_statuses(): HasMany
    {
        return $this->hasMany('App\Models\TaskStatus', 'created_by_id');
    }

}
