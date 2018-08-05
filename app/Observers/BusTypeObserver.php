<?php

namespace App\Observers;


use App\Models\BusType;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusTypeObserver
{
    use SoftDeletes;

    public function deleted(BusType $busType)
    {
        $busType->buses()->delete();
    }
}
