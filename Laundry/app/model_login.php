<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class model_login extends Model
{
    protected $table = 'tb_user';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
      'id',
      'email',
      'nama',
      'username',
      'password',
      'number_user',
      'id_outlet',
      'role'
    ];
    public function transaksi()
    {
      return $this->hasMany('App\model_transaksi','id');
    }
    public function member()
    {
      return $this->hasMany('App\model_member','id');
    }
    public function outlet()
    {
      return $this->hasMany('App\model_outlet','id');
    }
}
