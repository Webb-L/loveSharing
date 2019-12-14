<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'admin_role';

    protected $primaryKey = 'role_id';

    public $timestamps = false;

    public function auth() {
        return $this->hasOne('App\Admin\Auth','auth_id','role_auth_ids');
    }
}
