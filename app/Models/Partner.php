<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Traits\LogsActivity;

class Partner extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];

    //Logs
    protected static $logName = 'Socio';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function getDescriptionForEvent(string $eventName): string {
        return "Un socio ha sido {$eventName}";
    }
    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }
    public function imagePreview(){
        $image = asset('assets/admin/media/files/upload.png');
        if($this->image):
            if(Storage::exists($this->image->url)):
                $image = Storage::url($this->image->url);
            else:
                $image = $this->image->url;
            endif;
        endif;
        return $image;
    }
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
}
