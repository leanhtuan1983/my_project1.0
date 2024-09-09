<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    use HasFactory;
    protected $table ='procedures';

    protected $fillable = [
        'name', 'description', 'process_id'
    ]; 
    public function process() {
        return $this->hasMany(Process::class);
    }
}
