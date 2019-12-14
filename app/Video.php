<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes;

    protected $table = "video_list";

    protected $fillable = ['*'];

    protected $hidden = ['*'];

    public function user() {
        return $this->hasOne('App\User','id','users_id');
    }

}
