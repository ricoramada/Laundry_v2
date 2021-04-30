<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use PDF;
use App\model_member;
use App\model_outlet;
use App\model_paket;
use App\model_transaksi;
use App\model_login;
use App\user_google;

class Page extends Controller
{
  // Welcome
  public function welcome()
  {
    $data_outlet = model_outlet::where('id', Session('id_outlet'));
    $jumlah_outlet = $data_outlet->count();
    $data_paket = model_paket::where('id_outlet', Session('id_outlet'))->get();
    $jumlah_paket= $data_paket->count();
    $data_member = model_member::where('id_user', Session('id'))->get();
    $jumlah_member = $data_member->count();
    $data_transaksi = model_transaksi::paginate(5);
    $data = model_transaksi::where('id_outlet', Session('id_outlet'))->get();
    $jumlah_transaksi = $data->count();
    if (Session('login_status')) {
      if (Session('role') == null) {
        return redirect('role/'. Session('id'));
      } else {
        return view('content.Awalan',compact('jumlah_outlet','data_transaksi','jumlah_paket','jumlah_member','jumlah_transaksi'));
      }
    }else {
      return redirect('login');
    }
  }

  // Daftar Role
  public function roleForm($id)
  {
    $data_outlet = model_outlet::where('id', '>', 0)->get();
    return view('content.role',compact('data_outlet'));
  }

  // Batas=======================================================================
  // Member
  public function member()
  {
    $data = model_member::where('id_user', Session('id'))->get();
    if (Session('login_status')) {
      return view('content.member',compact('data'));
    } else {
      return redirect('login');
    }
  }

  // Mencari Data Member
  public function cariMember(Request $req)
  {
    $search = $req->search;
    $data = model_member::where('nama', 'LIKE', "%" . $search . "%")
                ->orWhere('jenis_kelamin', 'LIKE', "%" . $search . "%")
                ->orWhere('alamat', 'LIKE', "%" . $search . "%")
                ->orWhere('tlp', 'LIKE', "%" . $search . "%")
                ->paginate();
    return view('content.member',compact('data'));
  }

  // Tambah Member
  public function form_member()
  {
    if ('login_status') {
      return view('content.tambah_member');
    } else {
      return redirect('login');
    }
  }
  public function TambahMember(Request $req)
  {
    try {
      $data = [
        'id_user' => Session('id'),
        'nama' => $req->nama,
        'alamat' => $req->alamat,
        'jenis_kelamin' => $req->jenis_kelamin,
        'tlp' => $req->tlp
      ];
      model_member::create($data);
      if ($data > 0) {
        return redirect('/member')->with('message', 'Menambahkan member telah berhasil!!');
      } else {
        return redirect('/member')->with('message', 'Menambahkan member tidak berhasil!!');
      }
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }
  // Hapus Member
  public function hapusmember($id)
  {
    $data = model_member::find($id);
    try {
      $data_transaksi = model_transaksi::where('id_member', $id)->delete();
      $data->delete();
      return back();
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }
  // Update Member
  public function Edit_member($id)
  {
    $data = model_member::findOrFail($id);
    return view('content.edit_member', compact('data'));
  }
  public function update_member($id, Request $req)
  {
    $data = model_member::findOrFail($id);
    $data->nama = $req->nama;
    $data->alamat = $req->alamat;
    $data->jenis_kelamin = $req->jenis_kelamin;
    $data->tlp = $req->tlp;
    $data->save();
    return redirect('/member')->with('message','Success Edit!!');
  }

  // Batas=========================================================================================

  //Outlet 1
  public function outlet($id)
  {
    $data_outlet = model_outlet::where('id_user', $id)->first();
    $data_paket = model_paket::where('id_outlet', $id)->get();
    if (Session('login_status')) {
      return view('content.outlet',compact('data_outlet','data_paket'));
    }else {
      return redirect('login');
    }
  }

  // Cari Data Paket
  public function cariPaket($id,Request $req)
  {
    $search = $req->search;
    $data_outlet = model_outlet::findOrFail($id);
    $data_paket = model_paket::where('id_outlet', $id)
                ->where('nama_paket', 'LIKE', "%" . $search . "%")
                ->orWhere('jenis', 'LIKE', "%" . $search . "%")
                ->paginate();
    return view('content.outlet',compact('data_outlet','data_paket'));
  }

  public function tampil_membuat_outlet()
  {
    if (Session('login_status')) {
      return view('content.membuat_paket');
    }
  }

  // Membuat Paket Outlet
  public function membuat_paket(Request $req)
  {
    try {
      $id = Session()->get('id');
      $model_outlet = model_outlet::findOrFail($id);
      $data = [
        'id_outlet' => $model_outlet->id,
        'jenis' => $req->jenis,
        'nama_paket' => $req->nama_paket,
        'harga' => $req->harga,
      ];
      model_paket::create($data);
      return back()->with('message','Berhasil Membuat Paket!!');
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }
  // Menghapus Outlet Paket
  public function hapus_paket($id)
  {
    $data = model_paket::findOrFail($id);
    try {
      $data->delete();
      return redirect('outlet/' . Session('id_outlet'))->with('message', 'Success Menghapus Paket');
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }

  // Menghapus semua data Paket di Outlet
  public function deleteAllPaket($id)
  {
    try {
      $cek = model_transaksi::where('id_outlet', $id)->get();
      if ($cek) {
        $data_transaksi = model_transaksi::where('id_outlet', $id)->delete();
        $data = model_paket::where('id_outlet', $id)->delete();
        return redirect('outlet/' . Session('id_outlet'))->with('message', 'Success Menghapus Seluruh Paket');
      }else {
        $data = model_paket::where('id_outlet', $id)->delete();
        return redirect('outlet/' . Session('id_outlet'))->with('message', 'Success Menghapus Seluruh Paket');
      }
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }

  // Menghapus Outlet
  public function deleteOutlet($id, Request $req)
  {
    $data_user = model_login::findOrFail($id);
    $data_paket = model_paket::where('id_outlet', $id)->first();
    $data = model_outlet::where('id_user', $id)->first();
    $data_user->id_outlet = 0;
    $zero = 0;
    if ($data_paket == null) {
      Session::put('id_outlet', $zero);
      $data_user->save();
      $data->delete();
      return redirect('/outlet');
    } else {
      return back()->with('message_danger', 'Jika ingin menghapus Outlet, HARUS menghapus seluruh data yang ada di Outlet ini!!');
    }
  }

  // Outlet 2
  public function outlet2()
  {
    if (Session('login_status')) {
      return view('content.outlet2');
    }else {
      return redirect('login');
    }
  }
  // Membuat Outlet
  public function tampil_outlet()
  {
    if (Session('login_status')) {
      return view('content.membuat_outlet');
    } else {
      return redirect('login');
    }
  }
  // Tambah outlet
  public function buat_outlet(Request $req)
  {
    $id = Session()->get('id');
    if (Session('nama_google') == 'google') {
      $data_google = user_google::findOrFail($id);
      $data_google->id_outlet = $id;
      $data = [
        'id_user' => $id,
        'nama_outlet' => $req->nama_outlet,
        'alamat' => $req->alamat,
        'tlp' => $req->tlp
      ];
      Session::put('id_outlet', $id);
      model_outlet::create($data);
      $data_google->save();
      return redirect('outlet/' . $id)->with('message','Success!!');
    }
    $data_id_outlet = model_login::findOrFail($id);
    $data_id_outlet->id_outlet = $id;
    $data = [
      'id_user' => $id,
      'nama_outlet' => $req->nama_outlet,
      'alamat' => $req->alamat,
      'tlp' => $req->tlp
    ];
    Session::put('id_outlet', $id);
    model_outlet::create($data);
    $data_id_outlet->save();
    return redirect('outlet/' . $id)->with('message','Success!!');
  }

  // Batas=========================================================================================

  // Form Cart
  public function form_cart()
  {
      $data_transaksi = model_transaksi::paginate(2);
      if (Session('login_status')) {
        return view('content.cart',compact('data_transaksi'));
      } else {
        return redirect('login');
      }
  }

  // Mencari Data Cart
  public function cariCart(Request $req)
  {
    $search = $req->search;
    $data_transaksi = model_transaksi::where('id_paket', 'LIKE', "%" . $search . "%")
                ->orWhere('id_outlet', 'LIKE', "%" . $search . "%")
                ->orWhere('id_member', 'LIKE', "%" . $search . "%")
                ->orWhere('kode_invoice', 'LIKE', "%" . $search . "%")
                ->orWhere('tgl', 'LIKE', "%" . $search . "%")
                ->orWhere('batas_waktu', 'LIKE', "%" . $search . "%")
                ->orWhere('tgl_bayar', 'LIKE', "%" . $search . "%")
                ->orWhere('biaya_tambahan', 'LIKE', "%" . $search . "%")
                ->orWhere('diskon', 'LIKE', "%" . $search . "%")
                ->orWhere('pajak', 'LIKE', "%" . $search . "%")
                ->orWhere('status', 'LIKE', "%" . $search . "%")
                ->orWhere('dibayar', 'LIKE', "%" . $search . "%")
                ->orWhere('total_harga', 'LIKE', "%" . $search . "%")
                ->orWhere('id_user', 'LIKE', "%" . $search . "%")
                ->paginate();
    return view('content.cart',compact('data_transaksi'));
  }

  // Tampil Cart
  public function cart()
  {
    $data_member = model_member::where('id_user', Session('id'))->get();
    $data_paket = model_paket::where('id_outlet', Session('id_outlet'))->get();
    if (Session('login_status')) {
      return view('content.cart_buy',compact('data_member', 'data_paket'));
    } else {
      return redirect('login');
    }
  }
  // Masukan Keranjang Cucian
  public function cartbuy(Request $req)
  {
    $id = Session()->get('id');
    $data_belum_dibayar = 'belum_dibayar';
    $num_rand = mt_rand(100000, 999999);
    $data_paket = model_paket::where('id', $req->id_paket)->first();
    try {
      $data = [
        'id_outlet' => Session('id_outlet'),
        'id_paket' => $req->id_paket,
        'kode_invoice' => $num_rand,
        'id_member' => $req->id_member,
        'tgl' => $req->tgl,
        'batas_waktu' => $req->batas_waktu,
        'tgl_bayar' => $req->tgl_bayar,
        'biaya_tambahan' => $req->biaya_tambahan,
        'diskon' => $req->diskon,
        'pajak' => $req->pajak,
        'status' => $req->status,
        'dibayar' => $data_belum_dibayar,
        'total_harga' => ($req->diskon == 0) ? $data_paket->harga + $req->biaya_tambahan + $req->pajak : $req->diskon/100 * $data_paket->harga + $req->biaya_tambahan + $req->pajak,
        'id_user' => $id
      ];
      model_transaksi::create($data);
      return redirect('/formcart')->with('message','Berhasil ditambahkan ke Keranjang Cucian');
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }
  // Hapus Cart
  public function hapus_cart($id)
  {
    $data = model_transaksi::findOrFail($id);
    try {
      $data->delete();
      return redirect('/formcart')->with('message','Berhasil dihapus!!');
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }
  // Edit Cart
  public function formEditCart($id)
  {
    $data_transaksi = model_transaksi::findOrFail($id);
    $data = model_transaksi::all();
    return view('content.edit_cart',compact('data_transaksi','data'));
  }
  public function update_edit_cart($id, Request $req)
  {
    $data = model_transaksi::findOrFail($id);
    $data->tgl = $req->tgl;
    $data->batas_waktu = $req->batas_waktu;
    $data->tgl_bayar = $req->tgl_bayar;
    $data->biaya_tambahan = $req->biaya_tambahan;
    $data->diskon = $req->diskon;
    $data->pajak = $req->pajak;
    $data->status = $req->status;
    $data->save();
    return redirect('/formcart')->with('message', 'Edit cart berhasil!!');
  }
  // Cart Membayar
  public function update_bayar($id)
  {
    $data = model_transaksi::findOrFail($id);
    return view('bayar.membayar',compact('data'));
  }
  public function Bayar($id)
  {
    $data = model_transaksi::findOrFail($id);
    $data->dibayar = 'dibayar';
    $data->save();
    return redirect('/formcart')->with('message', 'Sudah Membayar');
  }

  // Batas=========================================================================================

  // Informasi Transaksi
  public function infoTransaksi()
  {
    $data_detail = model_transaksi::paginate(5);
    $data = model_transaksi::where('id_outlet', Session('id_outlet'))->get();
    $total_harga = $data->sum('total_harga');
    if ('login_status') {
      if (Session('role') == null) {
        return redirect('role/'. Session('id'));
      } else {
        return view('content.info_transaksi',compact('data_detail','total_harga'));
      }
    } else {
      return redirect('login');
    }
  }
  // Download Info
  public function generatePDF()
  {
    $modelTransaksi = model_transaksi::all();
    $pdf = PDF::loadView('content.downloadInfo', compact('modelTransaksi'))->setPaper('a4', 'landscape');
    return $pdf->download('DataTransaksi.pdf');
  }

}
