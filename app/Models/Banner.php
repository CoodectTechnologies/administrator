<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Traits\LogsActivity;

class Banner extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];

    //Logs
    protected static $logName = 'Banner';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function getDescriptionForEvent(string $eventName): string {
        return "Un banner ha sido {$eventName}";
    }
    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }
    public function moduleWeb(){
        return $this->belongsTo(ModuleWeb::class);
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
    public function videoPreview(){
        $video = asset('assets/web/video/home/banner1.mp4');
        if($this->video):
            if(Storage::exists($this->video)):
                $video = Storage::url($this->video);
            else:
                $video = $this->video;
            endif;
        endif;
        return $video;
    }
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
}
