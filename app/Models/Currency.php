<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $guarded = [];

    //Logs
    protected static $logName = 'Moneda';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function getDescriptionForEvent(string $eventName): string {
        return "Una moneda ha sido {$eventName}";
    }
    public function promotions(){
        return $this->belongsToMany(Promotion::class)->withTimestamps();
    }
    public function coupons(){
        return $this->belongsToMany(Coupon::class)->withTimestamps();
    }
    public function products(){
        return $this->morphedByMany(Product::class, 'currenciable')->withPivot(['price']);
    }
    public function productSizes(){
        return $this->morphedByMany(ProductSize::class, 'currenciable')->withPivot(['price']);
    }
}
