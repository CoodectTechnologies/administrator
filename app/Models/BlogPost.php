<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Traits\LogsActivity;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;

class BlogPost extends Model implements Viewable 
{
    use HasFactory, Sluggable, LogsActivity, InteractsWithViews;

    protected $guarded = [];
    protected $removeViewsOnDelete = true;

    //Logs
    protected static $logName = 'Post';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function getDescriptionForEvent(string $eventName): string {
        return "Un post ha sido {$eventName}";
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
    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function blogCategories(){
        return $this->belongsToMany(BlogCategory::class);
    }
    public function blogTags(){
        return $this->belongsToMany(BlogTag::class);
    }
    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
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
    public function viewUniques(){
        return views($this)->unique()->count();
    }
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
}
