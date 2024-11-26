<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';
    protected $primaryKey = 'BukuID';
    public $timestamps = false;

    protected $fillable = [
        'Judul',
        'TahunTerbit',
        'Penerbit',
        'Penulis',
        'NamaKategori',
    ];

    // Relasi ke peminjaman
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'BukuID', 'BukuID');
    }
}