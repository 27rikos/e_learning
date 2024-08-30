<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function mapel()
    {
        return $this->hasMany(Examp::class, 'id_tugas');
    }
}