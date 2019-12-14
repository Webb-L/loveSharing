<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;

    protected $table = 'news';

    protected $hidden = ['*'];

    protected $fillable = ['*'];

    public function user() {
        return $this->hasOne('App\Admin\User','id','user_id');
    }
    public function admin() {
        return $this->hasOne('App\Admin\User','id','admin_id');
    }
}
