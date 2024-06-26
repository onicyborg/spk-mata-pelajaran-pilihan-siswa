<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;

    protected $table = 'biodata';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function mapel_fav()
    {
        return $this->belongsTo(MataPelajaran::class, 'mapel_fav', 'id');
    }
}
