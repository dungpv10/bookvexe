<?php

namespace App\Observers;


use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserObserver
{
    use SoftDeletes;

    public function deleted(User $user){
        foreach($user->buses as $bus){
            $bus->routes()->delete();
        }
        $user->buses()->delete();
        $user->points()->delete();
    }
}
