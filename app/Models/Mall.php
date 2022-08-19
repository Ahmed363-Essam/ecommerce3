<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mall extends Model
{
    use HasFactory;
    protected $fillable = ['manager_id', 'name', 'address', 'phone', 'space', 'note', 'photo'];

    public function getPhotoAttribute($value)
    {
        $actual_link = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
        return ($value == null ? '' : $actual_link . 'assets/mail/' . $value.'/'.$value);
    }

    public function manager()
    {
        return $this->belongsTo(Manager::class,'manager_id');
    }


    public function department()
    {
        return $this->hasMany(department::class,'mall_id');
    }

}
