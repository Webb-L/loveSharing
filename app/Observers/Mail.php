<?php

namespace App\Observers;

use App\User;

class Mail
{
    public function creating(User $user){
        $user->email_token = str_shuffle(bcrypt(md5(time())));
    }
}
