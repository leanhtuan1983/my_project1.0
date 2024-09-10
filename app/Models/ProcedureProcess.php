<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcedureProcess extends Model
{
    use HasFactory;
    protected $table = 'procedures_processes';
    protected $fillable = [
        'procedure_id','process_id'
    ];
}
