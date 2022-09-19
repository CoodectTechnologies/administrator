<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Traits\LogsActivity;

class ProductGender extends Model
{
    use HasFactory, Sluggable, LogsActivity;

    protected $guarded = [];

    //Logs
    protected static $logName = 'Producto género';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function getDescriptionForEvent(string $eventName): string {
        return "Un género de producto ha sido {$eventName}";
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
    public function products(){
        return $this->hasMany(Product::class);
    }
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
}
