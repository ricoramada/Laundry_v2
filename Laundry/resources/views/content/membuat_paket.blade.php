@extends('welcome')

@section('content')
<div class="row">
  <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
    <div class="card card-signin my-5">
      <div class="card-body">

        @if ($message = Session::get('message'))
         <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
         @endif

        <h5 class="card-title text-center">Buat Paket</h5>
        <form class="form-signin" action="{{ url('/buatpaket/tambahpaket') }}" method="post" enctype="multipart/form-data">
          @csrf

          <div class="form-group">
            <label for="nama_member">Jenis Paket</label>
            <select class="form-control form-control-lg" name="jenis">
              <option value="" selected disabled>--Pilih Jenis Paket--</option>
              <option value="Kiloan">Kiloan</option>
              <option value="Selimut">Selimut</option>
              <option value="Bed Cover">Bed Cover</option>
              <option value="Kaos">Kaos</option>
              <option value="Lain">Lain</option>
            </select>
          </div>

          <div class="form-group">
            <label for="inputEmail">Nama Paket</label>
            <input type="text" name="nama_paket" id="inputEmail" class="form-control form-control-lg" placeholder="Nama Paket" required>
          </div>

          <div class="form-group">
            <label for="inputEmail">Harga</label>
            <input type="number" name="harga" id="inputEmail" class="form-control form-control-lg" placeholder="Harga" required>
          </div>

          <button class="btn btn-primary btn-block text-uppercase" type="submit">Tambahkan</button>
          <hr class="md-2">
          <a class="btn btn-success btn-block text-uppercase" href="{{ url('outlet/' . Session('id_outlet') ) }}"><i class="fas fa-long-arrow-alt-left"></i> Kembali</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
