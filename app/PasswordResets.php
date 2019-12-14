<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordResets extends Model
{
    protected $table = 'password_resets';

    public $timestamps = false;

    public function user() {
        return $this->hasOne('App\User','email','email');
    }
}
