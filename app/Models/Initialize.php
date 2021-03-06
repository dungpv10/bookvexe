<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Initialize extends Model
{
    use SoftDeletes;

    protected $table = 'initializes';

    protected $guarded = ['id'];

    protected $appends = ['status_name'];

    protected $statuses = [
        INITIALIZE_FINISH => 'Vừa xong tuyến',
        INITIALIZE_NOT_START => 'Chưa chạy',
        INITIALIZE_ON_A_WAY => 'Đang chạy chuyến'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function driver(){
        return $this->belongsTo(User::class, 'driver_id', 'id');
    }
    public function accessory(){
        return $this->belongsTo(User::class, 'car_accessory_id', 'id');
    }

    public function bus(){
        return $this->belongsTo(Bus::class, 'bus_id', 'id');
    }

    public function getStatusNameAttribute(){
        $status = $this->getAttribute('status');

        return $this->statuses[$status];
    }

}
