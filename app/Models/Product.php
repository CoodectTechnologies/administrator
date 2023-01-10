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
    public function currencies(){
        return $this->morphToMany(Currency::class, 'currenciable')->withTimestamps()->withPivot(['price']);
    }
    public function promotions(){
        return $this->morphToMany(Promotion::class, 'promotionable')->withTimestamps();
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
    public function viewUniques(){
        return views($this)->unique()->count();
    }
    public function getPromotion(){
        return Promotion::getPromotion($this);
    }
    public function getPriceToString(){
        $sessionCurrency = Session::get('currency');
        $priceToString = '$'.number_format($this->getPrice(), 2).$sessionCurrency;
        if($pricePromotion = $this->getPricePromotion()):
            $pricePromotion = '<ins class="new-price">'.'$'.number_format($pricePromotion, 2).$sessionCurrency.'</ins>';
            $priceToString = '<del class="old-price">'.$priceToString.'</del> '.$pricePromotion;
        else:
            $priceMaxSize = $this->getPriceSizeMax();
            if($priceMaxSize):
                $priceMaxSize = '$'.number_format($priceMaxSize, 2).$sessionCurrency;
                $priceToString = $priceToString.' - '.$priceMaxSize;
            endif;
        endif;
        return $priceToString;
    }
    public function getPrice(){
        $price = 0;
        $sessionCurrency = Session::get('currency');
        $currencyProduct = $this->currencies()->where('code', $sessionCurrency)->first();
        if(isset($currencyProduct->pivot->price)):
            $price = $currencyProduct->pivot->price;
        endif;
        return $price;
    }
    public function getPricePromotion(){
        $pricePromotion = 0;
        if($promotion = Promotion::getPromotion($this)):
            $price = $this->getPrice();
            $pricePromotion = ($price - ((($promotion->percentage / 100)) * $price));
        endif;
        return $pricePromotion;
    }
    public function getPriceFinal(){
        $priceFinal = 0;
        if($pricePromotion = $this->getPricePromotion()):
            $priceFinal = $pricePromotion;
        else:
            $priceFinal = $this->getPrice();
        endif;
        return $priceFinal;
    }
    public function getPriceSizeMax(){
        $sessionCurrency = Session::get('currency');
        $priceMaxSize = 0;
        $productSizes = $this->productSizes()->with('currencies')->whereHas('currencies', function($query) use($sessionCurrency) {
            $query->where('code', $sessionCurrency);
        })->cursor();
        foreach($productSizes as $productSize):
            foreach($productSize->currencies as $currency):
                if($priceMaxSize <= $currency->pivot->price):
                    $priceMaxSize = $currency->pivot->price;
                endif;
            endforeach;
        endforeach;
        return $priceMaxSize;
    }
    public function getPromotionPercentage(){
        $promotionPercentage = 0;
        if($pricePromotion = $this->getPricePromotion()):
            $price = $this->getPrice();
            $promotionPercentage = number_format((($pricePromotion * 100) / $price) - 100, 2);
        endif;
        return $promotionPercentage;

    }
    public function getStatusToString(){
        if($this->status == 'Borrador'):
            return '<div class="badge badge-light-warning">'.$this->status.'</div>';
        elseif($this->status == 'Publicado'):
            return '<div class="badge badge-light-success">'.$this->status.'</div>';
        else:
            return '<div class="badge badge-light-danger">Desconocido</div>';
        endif;
    }
    public function getIsNew(){
        $isNew = false;
        $daysExpiredNew = 7; //Si un producto llega a los 7 días de ser creado, ya no será considerado nuevo
        $diffTime = Carbon::parse($this->created_at)->diffInDays(date('Y-m-d'));
        if($diffTime <= $daysExpiredNew):
            $isNew = true;
        endif;
        return $isNew;
    }
    public function getIsInStock(){
        $isInStock = true;
        if(!$this->quantity === null):
            $isInStock = ($this->quantity > 0);
        endif;
        return $isInStock;
    }
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
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
    public function getStarsAVG(){
        $starsAVG = 0;
        $commentStars = $this->comments()->validate()->sum('stars');
        $commentCounts = $this->comments()->validate()->count();
        if($commentStars && $commentCounts):
            $starsAVG = number_format(($commentStars / $commentCounts), 1);
        endif;
        return $starsAVG;
    }
    public function getStarsPercentageAVG(){
        $getStarsAVG = $this->getStarsAVG();
        return ($getStarsAVG * 100) / 5;
    }
    public function getStarsPercentage($qty){
        $starsPercentage = 0;
        $commentsTotal = $this->comments()->validate()->count();
        $commentCounts = $this->comments()->where('stars', $qty)->validate()->count();
        if($commentCounts):
            $starsPercentage = ($commentCounts * 100) / $commentsTotal;
        endif;
        return floor($starsPercentage);
    }
    //Scopes
    public function scopeCurrencySession($query){
        return $query->whereHas('currencies', function($query){
            $query->where('code', Session::get('currency'));
        });
    }
    public function scopeValidateProduct($query){
        return $query->where('status', 'Publicado');
    }
}
