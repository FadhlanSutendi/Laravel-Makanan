<?php

namespace App\Http\Controllers;
use App\Models\Penjual;
use Illuminate\Http\Request;

class PenjualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $penjual = Penjual::all();
        return view('penjuals.index', compact('penjual'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('penjuals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|max:255',
            'kategori' => 'required|max:100',
            'deskripsi' => 'required|max:500',
        ],[
            'name.required' => 'Nama harus diisi',
            'kategori.required' => 'Jenis harus diisi',
            'deskripsi.required' => 'Deskripsi harus diisi'
        ]
    ); 


        Penjual::create([
            'name' => $request->input('name'),
            'kategori' => $request->input('kategori'),
            'deskripsi' => $request->input('deskripsi'),
        ]);

        return redirect()->back()->with('success', 'Penjual created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $penjual = Penjual::findOrFail($id);
        return view('penjuals.create', compact('penjual'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|max:255',
            'kategori' => 'required|max:100',
            'deskripsi' => 'required|max:500',
        ]
    );
    Penjual::where('id', $id)->update([
            'name'=>$request->name,
            'kategori'=>$request->kategori,
            'deskripsi'=>$request->deskripsi
    ]);


    return redirect()->route('penjual.data')->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $penjual = Penjual::where('id', $id)->delete();
        return redirect()->route('penjual.data')->with('success', 'data deleted successfully');
    }
}