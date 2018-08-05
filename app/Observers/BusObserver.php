<?php

namespace App\Observers;


use App\Models\Bus;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusObserver
{
    use SoftDeletes;

    public function deleted(Bus $bus){
        $bus->images()->delete();
        $bus->rates()->delete();
        $bus->routes()->delete();
    }
}
