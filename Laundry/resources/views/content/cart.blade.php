@extends('welcome')

@section('content')
@if ($message = Session::get('message'))
 <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ $message }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<a class="btn btn-outline-success btn-lg" href="/formcart/cartbuy" style="margin-top: 1rem; margin-bottom: 1rem;">Kerajang Cucian</a>
<form action="{{ url('formcart/cari') }}" class="form-inline float-right" style="margin-top: 1rem; margin-bottom: 1rem;">
  <input class="form-control mr-sm-2 form-control-lg" name="search" type="search" placeholder="Search" aria-label="Search" value="{{ old('search') }}">
  <button class="btn btn-lg btn-outline-success my-2 my-sm-0" type="submit">Search</button>
</form>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary text-uppercase">Keranjang</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Outlet</th>
                      <th scope="col">Kode Invoice</th>
                      <th scope="col">Member</th>
                      <th scope="col">Nama Paket</th>
                      <th scope="col">Jenis Paket</th>
                      <th scope="col">Tanggal</th>
                      <th scope="col">Batas Waktu</th>
                      <th scope="col">Tanggal Bayar</th>
                      <th scope="col">Biaya Tambahan</th>
                      <th scope="col">Diskon</th>
                      <th scope="col">Pajak</th>
                      <th scope="col">Status</th>
                      <th scope="col">Dibayar</th>
                      <th scope="col">Nama Kasir</th>
                      <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Outlet</th>
                      <th scope="col">Kode Invoice</th>
                      <th scope="col">Member</th>
                      <th scope="col">Nama Paket</th>
                      <th scope="col">Jenis Paket</th>
                      <th scope="col">Tanggal</th>
                      <th scope="col">Batas Waktu</th>
                      <th scope="col">Tanggal Bayar</th>
                      <th scope="col">Biaya Tambahan</th>
                      <th scope="col">Diskon</th>
                      <th scope="col">Pajak</th>
                      <th scope="col">Status</th>
                      <th scope="col">Dibayar</th>
                      <th scope="col">Nama Kasir</th>
                      <th scope="col">Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                  <?php $no=1; ?>
                  <?php foreach ($data_transaksi as $k => $datas): ?>
                    <?php if ($datas->id_outlet == Session('id_outlet')): ?>
                      <tr>
                        <th scope="row">{{ $no++ }}</th>
                        <td>{{ $datas->outlet->nama_outlet }}</td>
                        <td>{{ $datas->kode_invoice }}</td>
                        <td>{{ $datas->member->nama }}</td>
                        <td>{{ $datas->paket->nama_paket }}</td>
                        <td>{{ $datas->paket->jenis }}</td>
                        <td>{{ $datas->tgl }}</td>
                        <td>{{ $datas->batas_waktu }}</td>
                        <td>{{ $datas->tgl_bayar }}</td>
                        <td>Rp.{{ $datas->biaya_tambahan }}</td>
                        <td>{{ $datas->diskon }}%</td>
                        <td>Rp.{{ $datas->pajak }}</td>
                        <td>{{ $datas->status }}</td>
                        <td>{{ $datas->dibayar }}</td>
                        <td>{{ $datas->login->nama }}</td>
                        <td>
                          <?php if (Session('role') == 'admin' || Session('role') == 'kasir'): ?>
                          <a href="{{ url('formcart/edit/' . $datas->id ) }}"><button type="button" class="btn btn-primary">Edit</button></a>
                          <?php endif; ?>
                          <?php if ($datas->dibayar == 'dibayar'): ?>
                            <button type="button" class="btn btn-success" disabled>Sudah</button>
                          <?php else: ?>
                            <a href="{{ url('formcart/' . $datas->id . '/bayar') }}"><button type="button" class="btn btn-success">Bayar</button></a>
                          <?php endif; ?>
                          <a href="{{ url('formcart/hapus/'. $datas->id) }}"><button type="button" class="btn btn-danger">Hapus</button></a>
                        </td>
                      </tr>
                      @continue
                    <?php endif; ?>
                    <?php if ($datas->id_outlet != Session('id_outlet')): ?>
                      <tr>
                        <td class="text-center" colspan="15" style="font-size: 25px;">
                          Tidak Ada data Transaksi
                        </td>
                      </tr>
                      @break
                    <?php endif; ?>
                  <?php endforeach; ?>
                </tbody>
            </table>
            <?php if ($datas->id_outlet == Session('id_outlet')): ?>
              {{ $data_transaksi->links() }}
            <?php endif; ?>
        </div>
    </div>
</div>
@endsection
