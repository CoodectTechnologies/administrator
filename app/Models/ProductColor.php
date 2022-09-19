<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ProductColor extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];

    //Logs
    protected static $logName = 'Producto color';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Un color de producto ha sido {$eventName}";
    }
    public function products(){
        return $this->belongsTo(Product::class);
    }
    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }
    public function productSizes(){
        return $this->belongsToMany(ProductSize::class);
    }
    public function validateColorSizeSelected($sizeId){
        foreach($this->productSizes as $size):
            if($size->id == $sizeId):
                return true;
            endif;
        endforeach; 
        return false;
    } 
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
}
