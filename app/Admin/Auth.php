<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Auth extends Model
{
    protected $table = 'admin_auth';

    protected $primaryKey = 'auth_id';

    public function auth() {
        return $this->hasMany('App\Admin\Auth','auth_pid','auth_id');
    }
}
