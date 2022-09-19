<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Traits\LogsActivity;

class Portfolio extends Model implements Viewable
{
    use HasFactory, Sluggable, LogsActivity, InteractsWithViews;

    protected $guarded = [];
    protected $removeViewsOnDelete = true;

    //Logs
    protected static $logName = 'Portafolio';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function getDescriptionForEvent(string $eventName): string {
        return "Un proyecto ha sido {$eventName}";
    }
    public function getRouteKeyName(){
        return 'slug';
    }
    public function sluggable(): array {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function service(){
        return $this->belongsTo(Service::class);
    }
    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }
    public function images(){
        return $this->morphMany(Image::class, 'imageable')->whereNull('main');
    }
    public function imagePreview(){
        $image = asset('assets/admin/media/svg/files/blank-image.svg');
        if($this->image):
            if(Storage::exists($this->image->url)):
                $image = Storage::url($this->image->url);
            else:
                $image = $this->image->url;
            endif;
        endif;
        return $image;
    }
    public function viewUniques(){
        return views($this)->unique()->count();
    }
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
}
