<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\UserTrait;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use UserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'isp_id', 'owner_id'
    ];

    protected $appends = ['allPermissions', 'profilelink', 'avatarlink', 'isme'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAllpermissionsAttribute()
    {   $res = [];
        $allPermissions = $this->getAllPermissions();
        foreach($allPermissions as $p)
        {
            $res[] = $p->name;
        }
        return $res;
    }

    /**
     * Owner ID
     * Used for teams.
     *
     * @return void
     */
    public function owner()
    {
        return $this->belongsTo('App\User', 'owner_id', 'id');
    }
}
