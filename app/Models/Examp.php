<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examp extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function tugas()
    {
        return $this->belongsTo(Ruangan::class, 'id_tugas');
    }

    public function examp()
    {
        return $this->hasMany(Submit_examp::class, 'id_tugas');
    }
}