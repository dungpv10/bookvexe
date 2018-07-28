<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $guarded = ['id'];
    protected $appends = ['gender_name'];
    public static $gender = [
        USER_GENDER_FEMALE => 'Nữ',
        USER_GENDER_MALE => 'Nam'
    ];

    public function bus(){
        return $this->belongsTo(Bus::class, 'bus_id', 'id');
    }

    public function getGenderNameAttribute(){

        return self::$gender[$this->getAttribute('gender')];
    }

}
