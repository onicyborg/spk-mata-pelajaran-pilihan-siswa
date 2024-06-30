<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;

    protected $table = 'biodata';
    protected $fillable = [
        'tempat_lahir',
        'tanggal_lahir',
        'gender',
        'email',
        'kelas',
        'no_hp',
        'jurusan',
        'user_id',
        'mapel_fav',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function mapel_fav()
    {
        return $this->belongsTo(MataPelajaran::class, 'mapel_fav', 'id');
    }
}
