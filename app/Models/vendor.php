<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vendor extends Model
{
    use HasFactory;
    protected $fillable = ['department_id', 'name', 'phone', 'description', 'note', 'logo'];
    public function department()
    {
        return $this->belongsTo(department::class, 'department_id');
    }
    public function getLogoAttribute($value)
    {
        $actual_link = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
        return ($value == null ? '' : $actual_link . 'assets/vendor/' . $value.'/'.$value);
    }


    public function products()
    {
        return $this->belongsToMany(product::class, 'vendor_products', 'product_id', 'vendor_id');
    }


    
    public function realedProducts()
    {
        return $this->hasMany(VendorProduct::class, 'vendor_id', 'id');
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($vendors) {
            $vendors->realedProducts()->each(function ($realedProduct) {
                $realedProduct->delete();
            });
        });
    }

}
