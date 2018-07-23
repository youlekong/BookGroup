<?php

namespace App\Observers;

use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Log;


class UserObserver
{
    /**
     * 监听用户创建的事件。
     *
     * @param  User  $user
     * @return void
     */
    public function created(User $user)
    {
        //
        $uid = $user->id;
        if ( !UserInfo::where('u_id', $uid)->first() )
            UserInfo::create(['u_id' => $uid]);
    }

    
}