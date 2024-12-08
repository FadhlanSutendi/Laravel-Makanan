<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\FromCollection;

class orderExport implements FromCollection, WithMapping, WithHeadings
{
     /**
    * Mengambil data koleksi dari database.
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Order::orderby('created_at', 'desc')->get();
    }

    /**
    * Mapping data untuk setiap baris.
    * @param mixed $order
    * @return array
    */
    public function map($order): array
    {
        // Decode JSON kolom 'makanans' untuk mendapatkan detail makanan
        $makanans = json_decode($order->makanans, true);

        // Jika ada banyak makanan, gabungkan detailnya menjadi string
        $makananDetails = collect($makanans)->map(function ($makanan) {
            return "{$makanan['name_makanan']} (Qty: {$makanan['qty']}, Total: Rp " . number_format($makanan['total_price'], 0, ',', '.') . ")";
        })->implode("; ");

        return [
            $order->id,
            $order->name,
            $makananDetails,
            'Rp ' . number_format($order->total_price, 0, ',', '.'),
            $order->created_at->format('d-m-Y H:i:s'),
        ];
    }

    /**
    * Definisi heading untuk file Excel.
    * @return array
    */
    public function headings(): array
    {
        return [
            'ID Pesanan',
            'Nama Pemesan',
            'Detail Makanan',
            'Total Harga',
            'Tanggal Pesanan',
        ];
    }
}
