<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    use HasFactory;
    protected $table = 'processes';
    protected $fillable = [
        'name','description','dept_id'
    ];
    public function department() {
        return $this -> belongsTo(Department::class,'dept_id');
    }
}
