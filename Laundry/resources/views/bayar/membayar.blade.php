@extends('welcome')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card card-signin my-5">
        <div class="card-body">

          <h5 class="card-title text-center">Membayar</h5>
          <form class="form-signin" action="{{ url('formcart/'. $data->id .'/bayar/membayar') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
              <label>Kode Invoice</label>
              <input type="text" class="form-control form-control-lg" placeholder="Nama" value="{{ $data->kode_invoice }}" disabled>
            </div>

            <div class="form-group">
              <label>Nama</label>
              <input type="text" class="form-control form-control-lg" placeholder="Nama" value="{{ $data->member->nama }}" disabled>
            </div>

            <div class="form-group">
              <label>Paket</label>
              <input type="text" class="form-control form-control-lg" placeholder="Nama" value="{{ $data->paket->nama_paket }}" disabled>
            </div>

            <div class="form-group">
              <label>Biaya Tambahan</label>
              <input type="text" class="form-control form-control-lg" placeholder="Nama" value="{{ $data->biaya_tambahan }}" disabled>
            </div>

            <div class="form-group">
              <label>Diskon</label>
              <input type="text" class="form-control form-control-lg" placeholder="Nama" value="{{ $data->diskon }}" disabled>
            </div>

            <div class="form-group">
              <label>Pajak</label>
              <input type="text" class="form-control form-control-lg" placeholder="Nama" value="{{ $data->pajak }}" disabled>
            </div>

            <div class="form-group">
              <label>Total Harga</label>
              <input type="text" class="form-control form-control-lg" placeholder="Nama" value="{{ $data->total_harga }}" disabled>
            </div>

            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Bayar</button>
            <hr>
            <a class="btn btn-lg btn-facebook btn-block text-uppercase" href="/formcart"> Kembali</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
