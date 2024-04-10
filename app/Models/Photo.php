<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Photo extends Model
{
    use HasFactory;
    protected $table = "photos";
    protected $fillable = ["igm1", "img2", "img3"];

    public function products() {
        return $this->hasMany(Product::class);
    }

}
