<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'order_code', 'total_price', 'status'
    ];

    public function checkOrderStatus()
    {
        switch( $this->status ){
            case 0:
                echo 'text-warning';
                break;

            case 1:
                echo 'text-success';
                break;

            case 2:
                echo 'text-danger';
                break;
        }
    }

    public function getCreatedAtAttribute()
    {
        return date('M d, Y', strtotime($this->attributes['created_at']));
    }
}
