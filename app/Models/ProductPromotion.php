<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ProductPromotion extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];

    //Logs
    protected static $logName = 'Promoción';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function getDescriptionForEvent(string $eventName): string {
        return "Una promoción ha sido {$eventName}";
    }
    public function products(){
        return $this->belongsToMany(Product::class)->withTimestamps();
    }
}
