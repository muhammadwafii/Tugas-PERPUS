<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Relasi;
use App\Models\Kategori;
use App\Models\Buku;
use Exception;

class relasiController extends Controller
{
    public function index()
    {
        $relasis = relasi::with(['kategori', 'buku'])->get();
        return view('relasi.index', compact('relasis'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        $bukus = Buku::all();

        return view('relasi.create', compact('kategoris', 'bukus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:buku,BukuID', 
            'kategori_id' => 'required|exists:kategori,KategoriID', 
        ]);

        relasi::create([
            'BukuID' => $request->buku_id, 
            'KategoriID' => $request->kategori_id,
        ]);

        return redirect()->route('relasi.index')->with('success', 'relasi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $relasi = relasi::find($id);

        if (!$relasi) {
            return redirect()->route('relasi.index')->with('error', 'relasi tidak ditemukan');
        }

        $kategoris = Kategori::all();
        $bukus = Buku::all();

        return view('relasi.edit', compact('relasi', 'kategoris', 'bukus'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'BukuID' => 'required|exists:buku,BukuID', 
            'KategoriID' => 'required|exists:kategori,KategoriID',
        ]);

        $relasi = relasi::find($id);

        if (!$relasi) {
            return redirect()->route('relasi.index')->with('error', 'relasi tidak ditemukan');
        }

        $relasi->BukuID = $request->BukuID;
        $relasi->KategoriID = $request->KategoriID;
        $relasi->save();

        return redirect()->route('relasi.index')->with('success', 'relasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $relasi = relasi::find($id);

        try {
            $relasi->delete();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'relasi gagal dihapus');
        }

        return redirect()->back()->with('success', 'relasi berhasil dihapus');
    }
}
