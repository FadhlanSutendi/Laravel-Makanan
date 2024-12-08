<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Makanan;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\orderExport;


class OrdersController extends Controller
{
    public function exportExcelDataOrder()
    {
        return Excel::download(new orderExport, 'Rekap Menu -' . date('d-m-Y_H-i-s') . '.xlsx');
    }

    public function exportPDF($id)
    {
        $orders = Order::findOrFail($id); // Ambil data siswa berdasarkan ID
        $pdf = Pdf::loadView('orders.pdfcetak', compact('orders')); // Load tampilan 'export-pdf' dengan data siswa
        return $pdf->download("Rekap Menu -{$orders->id}-{$orders->name}.pdf"); // Unduh file PDF dengan nama yang menyertakan ID siswareturn $pdf->download("data-siswa-{$siswa->name}.pdf"); // Unduh file PDF dengan nama yang menyertakan ID siswa
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    
        return view('orders.index');
    }

    public function data()
    {
    
        $orders = Order::all();
        return view('orders.data', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $makanan =  Makanan::all();
        return view('orders.create', compact('makanan'));
    }

    /**
     * Store a newly created resource in storage.
     */
  
     public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'name' => 'required',
        'makanan' => 'required' // Pastikan 'makanan' adalah array
    ]);

    // Menghitung jumlah setiap item makanan yang dipesan
    $arrayValues = array_count_values($request->makanan);

    // Membuat array kosong untuk format baru
    $arrayNewMakanan = [];

    foreach ($arrayValues as $key => $value) {
        // Mencari data makanan berdasarkan ID
        $makanan = Makanan::where('id', $key)->first();

        // Jika makanan tidak ditemukan
        if (!$makanan) {
            return redirect()->back()->with('failed', 'Makanan dengan ID ' . $key . ' tidak ditemukan.');
        }

        // Menghitung total harga makanan
        $totalPrice = $makanan['harga'] * $value;

        // Membuat format array baru
        $arrayItem = [
            "id" => $makanan['id'],
            "name_makanan" => $makanan['name'],
            "qty" => $value,
            "harga" => $makanan['harga'],
            "total_price" => $totalPrice
        ];
        array_push($arrayNewMakanan, $arrayItem);
    }

    // Menghitung total harga
    $total = 0;
    foreach ($arrayNewMakanan as $item) {
        $total += $item['total_price'];
    }

    // Menghitung total dengan PPN 10%
    $ppn = $total + ($total * 0.1);

    // Pastikan Anda mengirimkan data dalam format JSON untuk kolom 'makanans'
    $makanansJson = json_encode($arrayNewMakanan);
    $makanansIdJson = json_encode(array_keys($arrayValues));

    // Menyimpan data pesanan ke database
    $newOrder = Order::create([
        "makanans" => $makanansJson, // Format JSON untuk array detail makanan
        "makanans_id" => $makanansIdJson, // ID makanan dalam format JSON
        "name" => $request->name,
        "total_price" => $ppn
    ]);

    // Mengembalikan respons
    if ($newOrder) {
        return redirect()->route('pesan.struk', $newOrder['id'])->with('success', 'Berhasil memesan makanan');
    } else {
        return redirect()->back()->with('failed', 'Gagal memesan makanan');
    }
}


     

    /**
     * Display the specified resource.
     */
    public function show($id)
{
    // Ambil data order berdasarkan ID
    $order = Order::find($id);

    if (!$order) {
        return redirect()->back()->with('failed', 'Pesanan tidak ditemukan.');
    }

    // Decode data makanan (yang disimpan dalam format JSON) agar bisa ditampilkan
    $makanans = json_decode($order->makanans, true);  // Menjadi array

    return view('orders.struk   ', compact('order', 'makanans'));
}
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
