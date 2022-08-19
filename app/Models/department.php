<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class department extends Model
{
    use HasFactory;

    protected $fillable = ['mall_id', 'name', 'description', 'note'];

    public function mail()
    {
        return $this->belongsTo(Mall::class,'mall_id');
    }
}
