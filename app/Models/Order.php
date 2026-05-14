<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'city',
        'address',
        'order_id',
        'comment',
        'total_vat',
        'delivery_boy_id',
        'delivery_date',
        'total_qty',
        'delivery_charge',
        'total_price',
        'lat',
        'long',
        'status',
        'areacode',
        'awb_details',
        'whatsapp',
        'payment_method',
        'created_by',
        'trans_id',
        'payment_status',
        'created_user_id',
        'deleted_at'
    ];

    protected $casts = [
        'awb_details' => 'array',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'trans_id');
    }
}
