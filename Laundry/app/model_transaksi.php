<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class model_transaksi extends Model
{
  protected $table = 'tb_transaksi';
  protected $primaryKey = 'id';
  protected $dates = ['tgl', 'batas_waktu', 'tgl_bayar'];
  public $timestamps = false;
  protected $fillable = [
    'id',
    'id_outlet',
    'id_paket',
    'kode_invoice',
    'id_member',
    'tgl',
    'batas_waktu',
    'tgl_bayar',
    'biaya_tambahan',
    'diskon',
    'pajak',
    'status',
    'dibayar',
    'total_harga',
    'id_user'
  ];
  public function outlet()
  {
    return $this->belongsTo('App\model_outlet', 'id_outlet');
  }
  public function member()
  {
    return $this->belongsTo('App\model_member', 'id_member');
  }
  public function login()
  {
    return $this->belongsTo('App\model_login', 'id_user');
  }
  public function paket()
  {
    return $this->belongsTo('App\model_paket', 'id_paket');
  }
}
