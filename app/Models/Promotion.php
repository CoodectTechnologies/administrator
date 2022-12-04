<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Promotion extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];

    //Logs
    protected static $logName = 'Promoción';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function getDescriptionForEvent(string $eventName): string {
        return "Una promoción ha sido {$eventName}";
    }
    public function products(){
        return $this->morphedByMany(Product::class, 'promotionable')->withTimestamps();
    }
    public function productCategories(){
        return $this->morphedByMany(ProductCategory::class, 'promotionable')->withTimestamps();
    }
    public function productBrands(){
        return $this->morphedByMany(ProductBrand::class, 'promotionable')->withTimestamps();
    }
    public function dateStartToString(){
        return Carbon::parse($this->date_start)->toFormattedDateString();
    }
    public function dateEndToString(){
        return Carbon::parse($this->date_end)->toFormattedDateString();
    }
    //Gets
    public static function getPromotion(Product $product){
        $oPromotion = null;
        $promotions = Self::validatePromotion()->orderByDesc('id')->get();
        foreach($promotions as $promotion):
            switch($promotion->type):
                case 'Todos':
                    $oPromotion = $promotion;
                    break 2;
                case 'Producto':
                    $productId = $product->id;
                    $products = $promotion->products();
                    if($promotion->conditional == 'Que sean'):
                        $products->whereIn('promotionable_id', [$productId]);
                    elseif($promotion->conditional == 'Que no sean'):
                        $products->whereNotIn('promotionable_id', [$productId]);
                    endif;
                    $products = $products->count();
                    if($products):
                        $oPromotion = $promotion;
                    endif;
                    break 2;
                case 'Categoría':
                    $categoryIds = $product->productCategories()->pluck('product_category_id')->toArray();
                    $productCategories = $promotion->productCategories();
                    if($promotion->conditional == 'Que sean'):
                        $productCategories = $productCategories->whereIn('promotionable_id', $categoryIds);
                    elseif($promotion->conditional == 'Que no sean'):
                        $productCategories = $productCategories->whereNotIn('promotionable_id', $categoryIds);
                    endif;
                    $productCategories = $productCategories->count();
                    if($productCategories):
                        $oPromotion = $promotion;
                    endif;
                    break 2;
                case 'Marca':
                    $brandId = $product->product_brand_id;
                    $productBrands = $promotion->productBrands();
                    if($promotion->conditional == 'Que sean'):
                        $productBrands->whereIn('promotionable_id', [$brandId]);
                    elseif($promotion->conditional == 'Que no sean'):
                        $productBrands->whereNotIn('promotionable_id', [$brandId]);
                    endif;
                    $productBrands = $productBrands->count();
                    if($productBrands):
                        $oPromotion = $promotion;
                    endif;
                    break 2;
            endswitch;
        endforeach;
        return $oPromotion;
    }
    //Scopes
    public function scopeValidatePromotion($query){
        return $query->where('active', true)
        ->whereDate('date_start', '>=', date('Y-m-d'))
        ->whereDate('date_end', '>=', date('Y-m-d'));
    }
}