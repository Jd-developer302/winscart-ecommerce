<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rma extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'comment',
        'product_id',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class , 'user_id');
    }
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class , 'order_id', 'order_id');
    }
    public function product() :BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
