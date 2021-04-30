<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class model_paket extends Model
{
  protected $table = 'tb_paket';
  protected $primaryKey = 'id';
  public $timestamps = false;
  protected $fillable = [
    'id',
    'id_outlet',
    'jenis',
    'nama_paket',
    'harga'
  ];
  public function transaksi()
  {
    return $this->hasMany('App\model_transaksi', 'id');
  }
}
