<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ShippingClass extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];

    //Logs
    protected static $logName = 'Clase de envío';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function getDescriptionForEvent(string $eventName): string{
        return "Una clase de envío ha sido {$eventName}";
    }
    public function shippingZones(){
        $this->belongsToMany(ShippingZone::class)->withTimestamps()->withPivot(['price', 'multiply_quantity']);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
}
