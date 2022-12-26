<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jabatanModel extends Model
{
    use HasFactory;
    protected $table = 'jabatan';
    protected $primarykey = 'id_jabatan';
    protected $fillable = [
        'id_jabatan',
        'pangkat',
        'jabatan',
    ];
}
