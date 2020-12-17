<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'document_id',
        'name',
        'lastname',
        'birthday',
        'phone',
        'address',
        'email',
        'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function document()
    {
        return $this->belongsTo(\App\Models\Document::class);
    }

    public function roles()
    {
        return $this->belongsToMany(\App\Models\Role::class, 'role_users')->withTimestamps();
    }

    public function myTopics()
    {
        return $this->belongsToMany(\App\Models\Topic::class, 'users_progress')->withPivot('completed');
    }

    public function hasTopic($topic)
    {
        $aux = null;
        if ($this->myTopics()->where('title', $topic)->first()) {
            return  $this->myTopics()->where('title', $topic)->first();
        }
        return false;
    }

    public function completeTopics()
    {
        $topics = \App\Models\Topic::all();
        // return sizeof($topics);
        if (sizeof($topics) == sizeof($this->myTopics)) {
            // return $this->myTopics()->where('completed', '1')->first();
            if ($this->myTopics()->where('completed', '0')->first()) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public function topics()
    {
        return $this->hasMany(\App\Models\Topic::class);
    }

    public function image()
    {
        return $this->morphOne(\App\Models\Image::class, 'imageable');
    }

    public function authorizeRoles($roles)
    {
        abort_unless($this->hasAnyRole($roles), 401);
        return true;
    }

    public function authorizeRolesSession($roles)
    {
        abort_unless($this->hasAnyRoleSession($roles), 401);
        return true;
    }
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function hasRoleSession($role)
    {
        $aux = $this->roles()->where('name', $role)->first();
        if ($aux) {
            if ($aux->name == session('role')) {
                return true;
            }
        }
        return false;
    }

    public function hasAnyRoleSession($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRoleSession($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRoleSession($roles)) {
                return true;
            }
        }
        return false;
    }

    public function fullname()
    {
        return $this->name . ' ' . $this->lastname;
    }

    public function formato()
    {
        return $this->hasOne(\App\Formato::class);
    }
}
