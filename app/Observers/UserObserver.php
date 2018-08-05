<?php

namespace App\Observers;


use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserObserver
{
    use SoftDeletes;

    public function deleted(User $user){
        $user->buses()->delete();
    }
}
