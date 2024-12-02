<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //menampilkan halaman login
    //pake request karna dipanggil dari from
    public function loginProses(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns', 
            'password' => 'required',
        ]);
        //ambil data dari input satukan pada array
        $user = $request->only('email', 'password');
        // cek kecocokan email dan password, lalu simpan pada class Auth
        if (Auth::attempt($user)) {
            //attempt -> 3 step, 1. passwordnya (enskripsi), 2. password(enskripsi) cocok sama email, 3. histori login(Auth)
            //jika berhasil arahkan ke landing page
            return redirect()->route('landingPage');
        }else {
            return redirect()->back()->with('failed', 'Gagal Login! silahkan coba lagi.');
        }
    }

    //menampilkan halaman logout
    public function logout()
    {
        Auth::logout();
        //arahkan ke halaman login lagi
        return redirect()->route('login')->with('logout', 'Anda Telah Logout!');
    }

    // menampilkan halaman awal/menampilkan halaman yg banyak datanya (tables)
//     public function index(Request $request)
//     {
//         // all() -> mengambil semua data dari table medicines model Medicine
//         // orderBy('nama_kolom', 'asc/desc') -> mengurutkan data berdasarkan kolom tertentu
//         // simplePaginate(angka) -> mengambil data dengan pagination per halamannya jumlah data disimpan di kurung (5)/ (format sederhana)
//         // where('nama_kolom', 'operator', 'nilai') -> mencari data berdasarkan kolom tertentu dan isi tertentu (isinya yg dr input)
//         // appends : menambahkan/membawa request pagination (data-data pagination tidak berubah meskipun ada request)
//         //LIKE : pencarian

//         $orderBy = $request->sort_email ? 'email' : 'name';
//         $users = User::where('name', 'LIKE', '%' . $request->cari . '%')->orderBy($orderBy, 'ASC')->simplePaginate(5)->appends($request->all());
//         return view('user.kelola_akun', compact('users'));
//         //compact : mengirim user ke halaman view
//     }

//         // menampilkan halaman form tambah data
//     public function create()
//     {
//         return view('account.akun_create');
//     }

//     // proses pengiriman data baru ke database
//     public function store(Request $request)
//     {
//         //validasi data
//         $request->validate([
//             'name' => 'required|max:100',
//             'email' => 'required|email|unique:users,email',
//             'role' => 'required',
//             'password' => 'required'
//         ], [
//             'name.required' => 'Nama Pengguna Harus Diisi!',
//             'email.required' => 'Email Harus Diisi!',
//             'email.email' => 'Format Email Tidak Valid!',
//             'email.unique' => 'Email Sudah Terdaftar!',
//             'role.required' => 'Role Harus Dipilih!',
//             'password.required' => 'Password Harus Diisi!'
//         ]);

//         User::create([
//             'name' => $request->name,
//             'email' => $request->email,
//             'role' => $request->role,
//             'password' => bcrypt($request->password),
//         ]);

//         return redirect()->route('kelola_akun.data')->with('success', 'Berhasil Menambah Pengguna!');
//     }

//    // menampilkan 1 data spesifik
//     public function show(Request $request)
//     {
//         //
//     }

//     // menampilkan form ubah data
//     public function edit($id)
//     {
//         //find -> untuk mencari data berdasarkan primary key nya
//         //compact -> untuk mengirimkan data
//         $user = User::find($id);
//         return view('account.edit_akun', compact('user'));

//     }

//     // memproses ubah data di databasenya
//     public function update(Request $request, $id)
//     {
        
//         $request->validate([
//             'name' => 'required|max:100',
//             'email' => 'required',
//             'password' => 'nullable', // Password, boleh kosong.
//             'role' => 'required'
//         ]);

        
//         //find -> untuk mencari data berdasarkan primary key nya
//         $user = User::find($id);
//         $user->update([
//             'name' => $request->name,
//             'email' => $request->email,
//             'password' => $request->password ?? $user->password,
//             'role' => $request->role
//         ]);

//         //redirect->route -> ngembaliin ke name nya
//         return redirect()->route('kelola_akun.data')->with('success', 'Berhasil Mengubah Data!');

//     }

//     // menghapus data di databasenya
//     public function destroy($id)
//     {
//         User::where('id', $id)->delete();
//         return redirect()->back()->with('success' , 'Berhasil Menghapus Data!');

//     }
}
