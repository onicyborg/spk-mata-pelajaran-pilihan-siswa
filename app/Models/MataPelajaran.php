<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;

    protected $table = 'mata_pelajaran';

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'mata_pelajaran_id', 'id');
    }

    public function biodata()
    {
        return $this->hasMany(Biodata::class, 'mapel_fav', 'id');
    }
}
