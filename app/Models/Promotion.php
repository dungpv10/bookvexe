<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model
{
    use SoftDeletes;
    protected $table = 'promotions';

    protected $guarded = ['id'];

    public $appends = ['status_name', 'promotion_type_name'];


    protected $types = [
        PROMOTION_FOR_CUSTOMER => 'Tất cả',
        PROMOTION_OLD_CUSTOMER => 'Khách hàng cũ',
        PROMOTION_NEW_CUSTOMER => 'Khách hàng mới'
    ];

    protected $statuses = [
        PROMOTION_ACTIVE => 'Đang hoạt động',
        PROMOTION_DEACTIVE => 'Tạm ngưng'
    ];

    public function agent(){

        return $this->belongsTo(Agent::class, 'agent_id', 'id');
    }

    public function getPromotionTypeNameAttribute(){
        $attribute = $this->getAttribute('promotion_type');

        return in_array($attribute, array_keys($this->types)) ? $this->types[$attribute] : 'Tất cả';
    }

    public function getStatusNameAttribute(){
        $attribute = $this->getAttribute('status');

        return in_array($attribute, array_keys($this->statuses)) ? $this->statuses[$attribute] : 'Tất cả';
    }
}
