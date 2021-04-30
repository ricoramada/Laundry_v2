<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class model_member extends Model
{
  protected $table = 'tb_member';
  protected $primaryKey = 'id';
  public $timestamps = false;
  protected $fillable = [
    'id',
    'id_user',
    'nama',
    'alamat',
    'jenis_kelamin',
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
