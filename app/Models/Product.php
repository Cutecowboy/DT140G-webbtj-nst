<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";
    protected $fillable = ["name", "brand", "description", "price", "category_id", "photo_id", "book_id"];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function photo(){
        return $this->belongsTo(Photo::class);
    }
    public function booked(){
        return $this->belongsTo(Booked::class);
    }


}
