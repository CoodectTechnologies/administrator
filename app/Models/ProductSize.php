<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\Session;

class ProductSize extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];

    //Logs
    protected static $logName = 'Producto medidas';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function getDescriptionForEvent(string $eventName): string {
        return "Una medida de producto ha sido {$eventName}";
    }
    public function currencies(){
        return $this->morphToMany(Currency::class, 'currenciable')->withTimestamps()->withPivot(['price']);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function productColors(){
        return $this->belongsToMany(ProductColor::class);
    }
    public function validateSizeColorSelected($colorId){
        foreach($this->productColors as $color):
            if($color->id == $colorId):
                return true;
            endif;
        endforeach;
        return false;
    }
    //Gets
    public function getPriceToString(){
        $sessionCurrency = Session::get('currency');
        $priceToString = '$'.number_format($this->getPrice(), 2).$sessionCurrency;
        if($pricePromotion = $this->getPricePromotion()):
            $pricePromotion = '$'.number_format($pricePromotion, 2).$sessionCurrency;
            $priceToString = '<del>'.$priceToString.'</del> '.$pricePromotion;
        endif;
        return $priceToString;
    }
    public function getPrice(){
        $price = 0;
        $sessionCurrency = Session::get('currency');
        $currencyProductSize = $this->currencies()->where('code', $sessionCurrency)->first();
        if(isset($currencyProductSize->pivot->price)):
            $price = $currencyProductSize->pivot->price;
        endif;
        return $price;
    }
    public function getPricePromotion(){
        $pricePromotion = 0;
        if($promotion = Promotion::getPromotion($this->product)):
            if($promotion->include_to_variant):
                $price = $this->getPrice();
                $pricePromotion = ($price - ((($promotion->percentage / 100)) * $price));
            endif;
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
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
}
