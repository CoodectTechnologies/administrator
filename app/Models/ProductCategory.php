<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Activitylog\Traits\LogsActivity;

class ProductCategory extends Model
{
    use HasFactory, Sluggable, LogsActivity;

    protected $guarded = [];

    //Logs
    protected static $logName = 'Producto categoría';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function getDescriptionForEvent(string $eventName): string {
        return "Una categoría de producto ha sido {$eventName}";
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
    public function parent(){
        return $this->belongsTo(ProductCategory::class, 'parent_id');
    }
    public function childrens(){
        return $this->hasMany(ProductCategory::class, 'parent_id');
    }
    public function allChildrens(){
        return $this->childrens()->with(['allChildrens', 'products']);
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
        return $this->belongsToMany(Product::class);
    }
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
    //Scopes
    public function scopeAllProductsByCategory(){
        $ids = Self::_getIdsChildrens($this->id);
        $ids[] = $this->id;
        $products = Product::query()->with('image', 'productCategories')->whereHas('productCategories', function($query) use($ids) {
            $query->whereIn('product_category_id', $ids);
        })->cursor();
        return $products;
    }
    public function scopeAllChildrens($query, $categoryFatherId){
        $ids = Self::_getIdsChildrens($categoryFatherId);
        return $query->whereIn('id', $ids);
    }
    private function _getIdsChildrens($categoryFatherId){
        $ids = [];
        $category = Self::with('allChildrens')->where('id', $categoryFatherId)->first();
        foreach($category->allChildrens as $categoryChildren):
            $ids[] = $categoryChildren->id;
            if(count($categoryChildren->allChildrens)):
                $ids = Self::_mergeCategoryChildrensStep($ids, $categoryChildren);
            endif;
        endforeach;
        return $ids;
    }
    private function _mergeCategoryChildrensStep($ids, $category){
        foreach($category->allChildrens as $categoryChildren):
            $ids[] = $categoryChildren->id;
            if(count($categoryChildren->allChildrens)):
                $ids[] = Self::_getIdsChildrens($categoryChildren->id);
            endif;
        endforeach;
        return $ids;
    }
}
