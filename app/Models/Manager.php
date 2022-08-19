<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;

    protected $fillable = ['name','email','phone','password','address','photo'];

    //protected $hidden = ['email'];

    public function getPhotoAttribute($value)
    {
        $actual_link = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
        return ($value == null ? '' : $actual_link . 'assets/manager/' . $value.'/'.$value);
    }

    public function Mall()
    {
        return $this->hasMany(Mall::class,'manager_id');
    }


    public static function boot()
    {
        parent::boot();

        self::deleting(function($manager)
        {
            $manager->Mall()->each(function($Mall)
            {
                $Mall->delete();
            });
        });
    }
}
