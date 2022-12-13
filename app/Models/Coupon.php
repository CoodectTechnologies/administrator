<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Coupon extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];

    //Logs
    protected static $logName = 'Cupón';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function getDescriptionForEvent(string $eventName): string {
        return "Un cupón ha sido {$eventName}";
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function currencies(){
        return $this->belongsToMany(Currency::class)->withTimestamps();
    }
    public function dateEndToString(){
        return Carbon::parse($this->date_end)->toFormattedDateString();
    }
    public function minimumExpenseToString(){
        return '$'.number_format($this->minimum_expense, 2);
    }
}
