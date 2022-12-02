<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class City extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];

    //Logs
    protected static $logName = 'Ciudad';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function getDescriptionForEvent(string $eventName): string {
        return "Una ciudad ha sido {$eventName}";
    }
    public function state(){
        return $this->belongsTo(State::class);
    }
    public function country(){
        return $this->hasOneThrough(Country::class, State::class, 'id', 'id', 'state_id', 'country_id');
        // Country::class,
        // State::class,
        // 'id', // Foreign key on the countries table...
        // 'id', // Foreign key on the states table...
        // 'state_id', // Local key on the cities table...
        // 'country_id' // Local key on the countries table...
    }
}
