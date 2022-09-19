<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ShippingZone extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];

    //Logs
    protected static $logName = 'Zonas de envío';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function getDescriptionForEvent(string $eventName): string {
        return "Una zona de envío ha sido {$eventName}";
    }
    public function states(){
        return $this->belongsToMany(State::class);
    }
    public function shippingClasses(){
        return $this->belongsToMany(ShippingClass::class)->withTimestamps()->withPivot(['price', 'multiply_quantity']);
    }
    public function priceToString(){
        return '$'.number_format($this->price, 2);
    }
    public function priceFreeOverToString(){
        if($this->free_shipping_over_to):
            return '$'.number_format($this->free_shipping_over_to, 2);
        else: 
            return 'No aplica';
        endif;   
    }
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
}
