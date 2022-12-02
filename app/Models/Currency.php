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
    public function products(){
        return $this->belongsToMany(Product::class)->withTimestamps()->withPivot(['price']);
    }
}
