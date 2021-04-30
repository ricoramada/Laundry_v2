<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_google extends Model
{
  protected $table = 'tb_user_google';
  protected $primaryKey = 'id';
  public $timestamps = false;
  protected $hidden = ['password'];
  protected $fillable = [
    'id',
    'id_google',
    'id_outlet',
    'nama_google',
    'nama',
    'photo',
    'email',
    'password',
    'number_user',
    'role'
  ];
}
