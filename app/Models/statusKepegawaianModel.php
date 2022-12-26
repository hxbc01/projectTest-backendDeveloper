<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class statusKepegawaianModel extends Model
{
    use HasFactory;
    protected $table = 'status_kepegawaian';
    protected $primarykey = 'id_status';
    protected $fillable = [
        'id_status',
        'status_pegawai',
        
    ];
}
