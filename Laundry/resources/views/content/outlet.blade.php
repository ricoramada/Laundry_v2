@extends('welcome')

@section('content')
<div class="card text-center">
  <div class="card-header">
    <h5 class="card-title">Selamat Datang Di {{ $data_outlet->nama_outlet }}</h5>
    <!-- Default dropright button -->
    <?php if (Session('role') == 'admin'): ?>
      <div class="btn-group" style="float: right;">
        <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: black;"><i class="fas fa-cog" style="float: right;">
        </i></a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
          <a href="{{ url('outlet/'. Session('id') .'/hapusOutlet')}}" style="text-decoration: none;"><button class="dropdown-item btn-danger" type="button">Hapus Outlet</button></a>
          <a href="{{ url('outlet/'. Session('id') .'/hapusAllPaket') }}" style="text-decoration: none;"><button class="dropdown-item btn-danger" type="button">Hapus Semua Paket</button></a>
        </div>
      </div>
    <?php endif; ?>
  </div>
  <div class="card-body">
    <p class="card-text" style="font-size: 30px;">
      Selamat Bekerja {{ Session('nama') }} dan Sehat Selalu
    </p>
  </div>
</div>

  <?php if (Session('role') == 'admin'): ?>
    <a class="btn btn-outline-success btn-lg" href="/buatpaket" style="margin-top: 1rem; margin-bottom: 1rem;">Paket Cucian</a>
    <form action="{{ url('outlet/'. Session('id_outlet') .'/cari')}}" class="form-inline float-right" style="margin-top: 1rem; margin-bottom: 1rem;">
      <input class="form-control mr-sm-2 form-control-lg" name="search" type="search" placeholder="Search" aria-label="Search" value="{{ old('search') }}">
      <button class="btn btn-lg btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  <?php else: ?>
    <form class="form-inline" style="margin-top: 1rem; margin-bottom: 1rem;">
      <input class="form-control mr-sm-2 form-control-lg" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-lg btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  <?php endif; ?>

  @if ($message = Session::get('message'))
   <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>{{ $message }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
  </div>
  @endif

  @if ($message = Session::get('message_danger'))
   <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>{{ $message }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
  </div>
  @endif

  <div class="row">
    <?php foreach ($data_paket as $k): ?>
    <div class="card text-center col-md-2 col-sm-6 col-12" style="margin: 1rem; float: left;">
      <div class="card-body">
        <h5 class="card-title">{{ $k->nama_paket }}</h5>
        <h6 class="card-subtitle mb-2 text-muted">RP {{ $k->harga }}</h6>
        <p class="card-text">Jenis {{ $k->jenis }}</p>
        <?php if (Session('role') == 'admin'): ?>
          <a href="{{ url('hapuspaket/' . $k->id ) }}" class="btn btn-danger">Delete Paket</a>
        <?php endif; ?>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
@endsection
