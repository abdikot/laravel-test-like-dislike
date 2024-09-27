<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function getLikesCountAttribute() {
        return $this->likes()->where('is_like', true)->count();
    }

    public function getDisLikesCountAttribute() {
        return $this->likes()->where('is_like', false)->count();
    }
}
