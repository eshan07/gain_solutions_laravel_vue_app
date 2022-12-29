<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'name', 'bn_name', 'feature_image', 'description','specification','delivery_info','faqs','short_note','current_stock','price','unit','slug','active'];

    public function image(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Image::class,'imageable','imageable_type', 'imageable_id');
    }
    public function getRouteKeyName() {
        return 'slug';
    }
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function order()
    {
        return $this->morphMany(OrderDetail::class, 'itemable', 'item_type', 'item_id');
    }
}
