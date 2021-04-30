@extends('welcome')

@section('content')
<div class="card text-center" style="width: 70rem; float: none; margin: 0 auto;">
  <div class="card-body">
    <h5 class="card-title">Silahkan Untuk Register Outlet telebih dahulu!!</h5>
    <p class="card-text">Selamat Bekerja {{ Session('nama') }} dan Sehat Selalu</p>
    <a href="/tampiloutlet" class="btn btn-primary">Membuat Toko</a>
  </div>
</div>
@endsection
