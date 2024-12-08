<?php

namespace App\Http\Controllers;
use App\Models\makanan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class MakananController extends Controller
{
    /**
     * Display a listing of the resource.
    */

    public function index()
    {
        
        $makanans = makanan::all();
        return view('makanans.index', compact('makanans'));
    }


    public function checkout(Request $request){
        $makanans = makanan::all();
        return view('orders.checkout', compact('makanans'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    return view('makanans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validasi data input
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'harga' => 'required|numeric',
        'kategori' => 'required|max:500',
        'deskripsi' => 'required|max:500',
    ]);

    // Simpan data ke database
    Makanan::create([
        'name' => $request->input('name'),
        'harga' => $request->input('harga'),
        'kategori' => $request->input('kategori'),
        'deskripsi' => $request->input('deskripsi'),
    ]);

    // Redirect ke halaman form atau halaman lain dengan pesan sukses
    return redirect()->route('data-makanan.data')->with('success', 'Makanan berhasil ditambahkan.');
}


    /**
     * Display the specified resource.
     */
    public function show(makanan $makanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $makanan = makanan::findOrFail($id);
        return view('makanans.edit', compact('makanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|max:255',
            'harga' => 'required|numeric|min:0',
            'kategori' => 'required|max:100',
            'deskripsi' => 'required|max:500',
        ]
    );
    makanan::where('id', $id)->update([
            'name'=>$request->name,
            'harga'=>$request->harga,
            'kategori'=>$request->kategori,
            'deskripsi'=>$request->deskripsi
    ]);


    return redirect()->route('data-makanan.data')->with('success', 'Makanan updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $hapusdata = makanan::where('id', $id)->delete();
        return redirect()->route('data-makanan.data')->with('success', 'Makanan deleted successfully');
    }
}
