<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ModuleWeb extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];

    //Logs
    protected static $logName = 'Módulo web';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function getDescriptionForEvent(string $eventName): string {
        return "Un módulo web ha sido {$eventName}";
    }
    public function banners(){
        return $this->hasMany(Banner::class);
    } 
    public function galleries(){
        return $this->hasMany(Gallery::class);
    } 
    public function videos(){
        return $this->hasMany(Video::class);
    } 
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
}
