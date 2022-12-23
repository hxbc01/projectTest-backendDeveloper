<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jabatan extends Model
{
    use HasFactory;
    protected $fillable =[
        'NIP',
        'nama',
        'password',
        'OPD',
        'id_status',
        'id_jabatan',
    ];
}
