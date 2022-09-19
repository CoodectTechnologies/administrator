<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Cviebrock\EloquentSluggable\Sluggable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use Illuminate\Support\Facades\Storage;

class Product extends Model implements Viewable
{
    use HasFactory, Sluggable, LogsActivity, InteractsWithViews;

    protected $guarded = [];
    protected $removeViewsOnDelete = true;

    //Logs
    protected static $logName = 'Producto';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function getDescriptionForEvent(string $eventName): string {
        return "Un producto ha sido {$eventName}";
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
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function image(){
        return $this->morphOne(Image::class, 'imageable')->where('main', true);
    }
    public function images(){
        return $this->morphMany(Image::class, 'imageable')->whereNull('main');
    }
    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
    }
    public function orders(){
        return $this->belongsToMany(Order::class)->withTimestamps()->withPivot(['color', 'size', 'quantity', 'price', 'subtotal', 'created_at']);
    }
    public function productGender(){
        return $this->belongsTo(ProductGender::class);
    }
    public function productSizes(){
        return $this->hasMany(ProductSize::class);
    }
    public function productColors(){
        return $this->hasMany(ProductColor::class);
    }
    public function productCategories(){
        return $this->belongsToMany(ProductCategory::class);
    }
    public function productBrand(){
        return $this->belongsTo(ProductBrand::class);
    }
    public function shippingClass(){
        return $this->belongsTo(ShippingClass::class);
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
    public function priceToString(){
        if($this->price_promotion):
            return '<del>'.'$'.number_format($this->price, 2).'</del> '.'$'.number_format($this->price_promotion, 2);
        else: 
            return '$'.number_format($this->price, 2);
        endif;
    }
    public function promotionPercentage(){
        return number_format((($this->price_promotion * 100) / $this->price) - 100, 2);
    }
    public function statusToString(){
        if($this->status == 'Borrador'):
            return '<div class="badge badge-light-warning">'.$this->status.'</div>';
        elseif($this->status == 'Publicado'):
            return '<div class="badge badge-light-success">'.$this->status.'</div>';
        else:
            return '<div class="badge badge-light-danger">Desconocido</div>';
        endif;
    }
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
}
