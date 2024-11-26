<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class relasi extends Model
{
    use HasFactory;

    protected $table = 'relasi';
    public $timestamps = false;

    protected $fillable = ['BukuID', 'KategoriID'];

    
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'BukuID');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriBuku::class, 'KategoriID');
    }
}
