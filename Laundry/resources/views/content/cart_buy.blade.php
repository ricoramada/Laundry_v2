@extends('welcome')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card card-signin my-5">
        <div class="card-body">

          <h5 class="card-title text-center">Keranjang Cucian</h5>
          <form class="form-signin" action="{{ url('/formcart/cartbuy/buy') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
              <label for="nama_member">Nama Member</label>
              <select class="form-control form-control-lg" name="id_member">
                <option value="" selected disabled>--Pilih Nama Member--</option>
                <?php foreach ($data_member as $k): ?>
                <option value="{{ $k->id }}">{{ $k->nama }}</option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group">
              <label for="nama_member">Paket</label>
              <select class="form-control form-control-lg" name="id_paket">
                <option value="" selected disabled>--Pilih Paket--</option>
                <?php foreach ($data_paket as $k): ?>
                <option value="{{ $k->id }}">
                  Nama : {{ $k->nama_paket }} &nbsp;
                  Jenis : {{ $k->jenis }}
                </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group">
              <label>Tanggal Sekarang</label>
              <input type="date" name="tgl" id="inputPassword" class="form-control form-control-lg" placeholder="Tanggal" required>
            </div>

            <div class="form-group">
              <label>Batas Waktu</label>
              <input type="date" name="batas_waktu" id="inputPassword" class="form-control form-control-lg" placeholder="Batas Waktu" required>
            </div>

            <div class="form-group">
              <label>Tanggal Bayar</label>
              <input type="date" name="tgl_bayar" id="inputPassword" class="form-control form-control-lg" placeholder="Tanggal Bayar" required>
            </div>

            <div class="form-group">
              <label>Biaya Tambahan</label>
              <input type="number" name="biaya_tambahan" id="inputPassword" class="form-control form-control-lg" placeholder="Biaya Tambahan" required>
            </div>

            <div class="form-group">
              <label>Diskon</label>
              <input type="number" name="diskon" id="inputPassword" class="form-control form-control-lg" placeholder="Diskon" required>
            </div>

            <div class="form-group">
              <label>Pajak</label>
              <input type="number" name="pajak" id="inputPassword" class="form-control form-control-lg" placeholder="Pajak" required>
            </div>

            <div class="form-group">
              <label>Status</label>
              <select class="form-control form-control-lg" name="status">
                <option value="" selected disabled>--Pilih Status Cucian--</option>
                <option value="baru">Baru</option>
                <option value="proses">Proses</option>
                <option value="selesai">Selesai</option>
                <option value="diambil">Diambil</option>
              </select>
            </div>

            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Tambahkan</button>
            <hr>
            <a class="btn btn-lg btn-facebook btn-block text-uppercase" href="/formcart"> Kembali</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
