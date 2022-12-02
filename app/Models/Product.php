<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Cviebrock\EloquentSluggable\Sluggable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use AmrShawky\LaravelCurrency\Facade\Currency;

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
    public function currency(){
        return $this->belongsToMany(Currency::class)->withTimestamps()->withPivot(['price']);
    }
    public function productPromotions(){
        return $this->belongsToMany(ProductPromotion::class)->withTimestamps();
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
    //Gets
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
        $sessionCurrency = Session::get('currency');
        $priceToString = '$'.number_format(currency($this->price), 2).$sessionCurrency;
        if($this->price_promotion):
            $pricePromotion = '$'.number_format(currency($this->price_promotion), 2).$sessionCurrency;
            $priceToString = '<del>'.$priceToString.'</del> '.$pricePromotion;
        else:
            if($priceMax = $this->productSizes()->max('price')):
                $priceMax = '$'.number_format(currency($priceMax), 2).$sessionCurrency;
                $priceToString = $priceToString.' - '.$priceMax;
            endif;
        endif;
        return $priceToString;
    }
    public function hasPromotion(){
        $hasPromotion = false;
        if($this->price_promotion):
            $hasPromotion = true;
        endif;
        return $hasPromotion;
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
    public function isNew(){
        $isNew = false;
        $daysExpiredNew = 7; //Si un producto llega a los 7 días de ser creado, ya no será considerado nuevo
        $diffTime = Carbon::parse($this->created_at)->diffInDays(date('Y-m-d'));
        if($diffTime <= $daysExpiredNew):
            $isNew = true;
        endif;
        return $isNew;
    }
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
}
