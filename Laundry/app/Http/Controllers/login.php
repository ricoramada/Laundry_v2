<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\model_member;
use App\model_outlet;
use App\model_paket;
use App\model_transaksi;
use App\model_login;
use App\user_google;
use Validator;
use Session;
use Socialite;

class login extends Controller
{
  // Login Lewat Google
  public function redirectToProvider($driver)
  {
    return Socialite::driver($driver)->redirect();
  }
  public function handleProviderCallback($driver)
  {
        $user = Socialite::driver($driver)->user();
        $random = mt_rand(100000000, 999999999);
        $id_outlet = 0;
        $create = user_google::firstOrCreate([
          'email' => $user->getEmail()
        ], [
          'nama_google' => $driver,
          'id_google' => $user->getId(),
          'number_user' => $random,
          'nama' => $user->getName(),
          'photo' => $user->getAvatar(),
          'id_outlet' => $id_outlet,
        ]);
        if ($create->role == null) {
          Session::put('id', $create->id);
          Session::put('id_google', $user->getId());
          Session::put('nama', $user->getName());
          Session::put('nama_google', $driver);
          Session::put('photo', $user->getAvatar());
          Session::put('id_outlet', $create->id_outlet);
          Session::put('number_user', $create->number_user);
          Session::put('role', $create->role);
          Session::put('email', $user->getEmail());
          Session::put('login_status', true);
          return redirect('role/'. Session('id'));
        } else {
          Session::put('id', $create->id);
          Session::put('id_google', $user->getId());
          Session::put('nama', $user->getName());
          Session::put('nama_google', $driver);
          Session::put('photo', $user->getAvatar());
          Session::put('id_outlet', $create->id_outlet);
          Session::put('number_user', $create->number_user);
          Session::put('role', $create->role);
          Session::put('email', $user->getEmail());
          Session::put('login_status', true);
          return redirect('/');
        }
  }

  // Login
  public function cek(Request $req){
      $this->validate($req,[
      'username'=>'required',
      'password'=>'required'
      ]);
      $proses = model_login::where('username',$req->username)->where('password',md5($req->password));
      if($proses->count()>0){
          $data = $proses->first();
          if($data->level == 'admin'){
              Session::put('id', $data->id);
              Session::put('email', $data->email);
              Session::put('nama', $data->nama);
              Session::put('username', $data->username);
              Session::put('password', $data->password);
              Session::put('number_user', $data->number_user);
              Session::put('id_outlet', $data->id_outlet);
              Session::put('role', $data->role);
              Session::put('login_status', true);
              return redirect('/');
          }else{
              Session::put('id', $data->id);
              Session::put('email', $data->email);
              Session::put('nama', $data->nama);
              Session::put('username', $data->username);
              Session::put('password', $data->password);
              Session::put('number_user', $data->number_user);
              Session::put('id_outlet', $data->id_outlet);
              Session::put('role', $data->role);
              Session::put('login_status', true);
              return redirect('/');
          }
      } else {
          return redirect('login')->with('message', 'Username dan Password salah !!');
      }
  }

  //Register
  public function register(Request $req){
      $proses1 = model_login::where('nama',$req->nama);
      $proses2 = model_login::where('username',$req->username);
      $random = mt_rand(100000000, 999999999);
      if($proses1->count()<1 && $proses2->count()<1){
          model_login::create([
            'email' => $req->email,
            'nama' => $req->nama,
            'username' => $req->username,
            'password' => md5($req->password),
            'number_user' => $random,
            'id_outlet' => $req->id_outlet,
            'role' => $req->role
          ]);
          return redirect('login');
      } else {
        Session::flash('message', 'Email dan Username sudah tersedia');
        return redirect()->back();
      }
  }

  // Register Admin
  public function registerAdmin(Request $req){
      $proses1 = model_login::where('nama',$req->nama);
      $proses2 = model_login::where('username',$req->username);
      $random = mt_rand(100000000, 999999999);
      $id_outlet = 0;
      $admin = 'admin';
      if($proses1->count()<1 && $proses2->count()<1){
          model_login::create([
            'email' => $req->email,
            'nama' => $req->nama,
            'username' => $req->username,
            'password' => md5($req->password),
            'number_user' => $random,
            'id_outlet' => $id_outlet,
            'role' => $admin
          ]);
          return redirect('login');
      } else {
        Session::flash('message', 'Email dan Username sudah tersedia');
        return redirect()->back();
      }
  }

  // Hapus Akun
  public function deleteAccount($id)
  {
    try {
      $data = model_login::where('id', $id);
      $data_outlet = model_outlet::where('id', $id)->count();
      $data_member = model_member::where('id_user', $id)->count();
      $data_transaksi = model_transaksi::where('id_user', $id)->count();
      if (Session('nama_google') == 'google') {
        $dataUserGoogle = user_google::findOrFail($id);
        $dataUserGoogle->delete();
        return redirect('login');
      } else {
        if ($data_outlet == null && $data_member == null && $data_transaksi == null) {
          $data->delete();
          return redirect('login');
        }else {
          return back()->with('data', 'Jika ingin menghapus akun, HARUS menghapus seluruh data yang ada di Akun ini!!');
        }
      }
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }

  // Update Role
  public function updateRole($id, Request $req)
  {
    $data = user_google::findOrFail($id);
    Session::put('id_outlet', $data->id_outlet = $req->id_outlet);
    Session::put('role', $data->role = $req->role);
    $data->id_outlet = $req->id_outlet;
    $data->role = $req->role;
    $data->save();
    return redirect('/');
  }

  //Logout
  public function logout(){
      Session::flush();
      return redirect('login');
  }
}
