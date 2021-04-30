<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class model_outlet extends Model
{
  protected $table = 'tb_outlet';
  protected $primaryKey = 'id';
  public $timestamps = false;
  protected $fillable = [
    'id',
    'id_user',
    'nama_outlet',
    'alamat',
    'tlp'
  ];
  public function transaksi()
  {
    return $this->hasMany('App\model_transaksi', 'id');
  }
  public function login()
  {
    return $this->belongsTo('App\model_login', 'id_user');
  }
}
