<?php
/**
 * Created by PhpStorm.
 * User: dungpv
 * Date: 7/19/18
 * Time: 02:03
 */

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
