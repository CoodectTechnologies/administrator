<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

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
    public function products(){
        return $this->belongsTo(Product::class);
    }
    public function productColors(){
        return $this->belongsToMany(ProductColor::class);
    }
    public function priceToString(){
        return '$'.number_format($this->price, 2, '.', ',');
    }
    public function validateSizeColorSelected($colorId){
        foreach($this->productColors as $color):
            if($color->id == $colorId):
                return true;
            endif;
        endforeach;
        return false;
    }
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
}
