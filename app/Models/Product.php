<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;

    protected $fillable = [
        'name',
        'image',
        'stock',
        'brand',
        'description',
        'price',
        'sku',
        'is_newarrival',
        'delivery_charge',
        'is_vat',
        'category_id',
        'mega_deal',
        'old_price',
        'specification',
        'is_active',
        'is_mega_offer'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty();
    }

    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
