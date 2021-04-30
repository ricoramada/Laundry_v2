@extends('welcome')
@section('content')

<div class="container">
  <div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card card-signin my-5">
        <div class="card-body">

          <h5 class="card-title text-center">Keranjang Cucian</h5>
          <form class="form-signin" action="{{ url('/formcart/edit/' . $data_transaksi->id . '/update') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
              <label for="nama_member">Nama Member</label>
              <select class="form-control form-control-lg" name="id_member">
                <option value="{{ $data_transaksi->member->id }}">{{ $data_transaksi->member->nama }}</option>
              </select>
            </div>

            <div class="form-group">
              <label for="nama_member">Nama Paket</label>
              <select class="form-control form-control-lg" name="id_paket">
                <option value="{{ $data_transaksi->paket->id }}">
                  Nama : {{ $data_transaksi->paket->nama_paket }} &nbsp;
                  Jenis : {{ $data_transaksi->paket->jenis }}
                </option>
              </select>
            </div>

            <div class="form-group">
              <label>Tanggal Sekarang</label>
              <input type="date" name="tgl" class="form-control form-control-lg" placeholder="Tanggal" value="{{ $data_transaksi->tgl->format('Y-m-d') }}" required>
            </div>

            <div class="form-group">
              <label>Batas Waktu</label>
              <input type="date" name="batas_waktu" class="form-control form-control-lg" placeholder="Batas Waktu" value="{{ $data_transaksi->batas_waktu->format('Y-m-d') }}" required>
            </div>

            <div class="form-group">
              <label>Tanggal Bayar</label>
              <input type="date" name="tgl_bayar" class="form-control form-control-lg" placeholder="Tanggal Bayar" value="{{ $data_transaksi->tgl_bayar->format('Y-m-d') }}" required>
            </div>

            <div class="form-group">
              <label>Biaya Tambahan</label>
              <input type="number" name="biaya_tambahan" class="form-control form-control-lg" placeholder="Biaya Tambahan" value="{{ $data_transaksi->biaya_tambahan }}" required>
            </div>

            <div class="form-group">
              <label>Diskon</label>
              <input type="number" name="diskon" class="form-control form-control-lg" placeholder="Diskon" value="{{ $data_transaksi->diskon }}" required>
            </div>

            <div class="form-group">
              <label>Pajak</label>
              <input type="number" name="pajak" class="form-control form-control-lg" placeholder="Pajak" value="{{ $data_transaksi->pajak }}" required>
            </div>

            <div class="form-group">
              <label>Status</label>
              <select class="form-control form-control-lg" name="status">
                <?php if ($data_transaksi->status == 'baru'): ?>
                  <option value="baru">Baru</option>
                  <option value="proses">Proses</option>
                  <option value="selesai">Selesai</option>
                  <option value="diambil">Diambil</option>
                <?php endif; ?>
                <?php if ($data_transaksi->status == 'proses'): ?>
                  <option value="proses">Proses</option>
                  <option value="baru">Baru</option>
                  <option value="selesai">Selesai</option>
                  <option value="diambil">Diambil</option>
                <?php endif; ?>
                <?php if ($data_transaksi->status == 'selesai'): ?>
                  <option value="selesai">Selesai</option>
                  <option value="baru">Baru</option>
                  <option value="proses">Proses</option>
                  <option value="diambil">Diambil</option>
                <?php endif; ?>
                <?php if ($data_transaksi->status == 'diambil'): ?>
                  <option value="diambil">Diambil</option>
                  <option value="baru">Baru</option>
                  <option value="proses">Proses</option>
                  <option value="selesai">Selesai</option>
                <?php endif; ?>
              </select>
            </div>

            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Edit</button>
            <hr>
            <a class="btn btn-lg btn-facebook btn-block text-uppercase" href="/formcart"> Kembali</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
