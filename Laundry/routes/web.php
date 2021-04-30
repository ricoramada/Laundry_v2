<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\model_outlet;

Route::group(['middleware'=>'cek_login'], function() {
  Route::get('/', 'Page@welcome');

  // Role
  Route::get('/role/{id}','Page@roleForm');
  Route::post('/role/{id}/daftar', 'login@updateRole');

  // Profile
  Route::get('/profile/{id}', function () {
    if (Session('role') == null) {
      return redirect('role/'. Session('id'));
    } else {
      return view('content.Profile');
    }
  });
  Route::get('/profile/{id}/hapusAkun', 'login@deleteAccount');

  // Member
  Route::get('/member','Page@member');
  Route::get('/form_member','Page@form_member');
  Route::post('tambahmember','Page@TambahMember');
  Route::get('/hapus_member/{id}', 'Page@hapusmember');
  Route::get('/editmember/{member}/edit', 'Page@Edit_member');
  Route::post('/editmember/{member}/update', 'Page@update_member');
  Route::get('/member/cari', 'Page@cariMember');

  // Outlet
  Route::get('/outlet/{id}', 'Page@outlet');
  Route::get('/outlet', 'Page@outlet2');
  Route::get('/tampiloutlet', 'Page@tampil_outlet');
  Route::post('/tampiloutlet/buatoutlet', 'Page@buat_outlet');
  Route::get('/buatpaket', 'Page@tampil_membuat_outlet');
  Route::post('/buatpaket/tambahpaket', 'Page@membuat_paket');
  Route::get('/hapuspaket/{id}', 'Page@hapus_paket');
  Route::get('/outlet/{id}/hapusOutlet', 'Page@deleteOutlet');
  Route::get('/outlet/{id}/hapusAllPaket', 'Page@deleteAllPaket');
  Route::get('/outlet/{id}/cari', 'Page@cariPaket');

  // Cart
  Route::get('/formcart', 'Page@form_cart');
  Route::get('/formcart/cartbuy', 'Page@cart');
  Route::post('/formcart/cartbuy/buy', 'Page@cartbuy');
  Route::get('/formcart/hapus/{id}', 'Page@hapus_cart');
  Route::get('/formcart/edit/{id}', 'Page@formEditCart');
  Route::post('/formcart/edit/{id}/update', 'Page@update_edit_cart');
  Route::get('/formcart/{id}/bayar', 'Page@update_bayar');
  Route::post('/formcart/{id}/bayar/membayar', 'Page@Bayar');
  Route::get('/formcart/cari', 'Page@cariCart');

  // Info Transaksi
  Route::get('/infoTransaksi', 'Page@infoTransaksi');
  Route::get('/infoTransaksi/generate-pdf', 'Page@generatePDF');
});
//login dengan google
Route::get('redirect/{driver}', 'login@redirectToProvider')->name('login.provider');
Route::get('{driver}/callback', 'login@handleProviderCallback')->name('login.callback');

// Login dan Register
Route::get('register', function () {
  $data_outlet = model_outlet::where('id', '>', 0)->get();
  return view('Register',compact('data_outlet'));
});
Route::get('/register/admin', function () {
  return view('Register_admin');
});
Route::post('/daftar/admin', 'login@registerAdmin');
Route::get('login', function () {
  return view('Login');
});
Route::post('login/cek','login@cek');
Route::get('/logout','login@logout');
Route::post('daftar','login@register');
