<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
    use HasFactory;
    protected $table = 'lots';
    protected $fillable = [
        'name','product_id'
    ];
    public function products() {
        return $this -> belongsTo(Product::class);
    }
}
