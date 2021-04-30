@extends('welcome')

@section('content')
<a href="{{ url('infoTransaksi/generate-pdf') }}"><button type="button" class="btn btn-success btn-lg">Cetak PDF</button></a>
<br>
<br>
<div class="card shadow mb-4">
    <div class="card-body">
      <h4>Total Pendapatan</h4>
      <input type="text" class="form-control-lg" value="Rp. {{ $total_harga }}" style="margin-bottom: 10px;" disabled>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Outlet</th>
                    <th scope="col">Nama Member</th>
                    <th scope="col">Nama Paket</th>
                    <th scope="col">Jenis Cucian</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Tanggal Dibayar</th>
                    <th scope="col">Alamat Member</th>
                    <th scope="col">Nomer Telepon</th>
                    <th scope="col">Biaya Tambahan</th>
                    <th scope="col">Diskon</th>
                    <th scope="col">Pajak</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Nama Kasir</th>
                    <th scope="col">Keterangan</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Outlet</th>
                    <th scope="col">Nama Member</th>
                    <th scope="col">Nama Paket</th>
                    <th scope="col">Jenis Cucian</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Tanggal Dibayar</th>
                    <th scope="col">Alamat Member</th>
                    <th scope="col">Nomer Telepon</th>
                    <th scope="col">Biaya Tambahan</th>
                    <th scope="col">Diskon</th>
                    <th scope="col">Pajak</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Nama Kasir</th>
                    <th scope="col">Keterangan</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php $no=1; ?>
                  <?php foreach ($data_detail as $k => $datas): ?>
                    <?php if ($datas->id_outlet == Session('id_outlet')): ?>
                    <tr>
                      <th scope="row">{{ $no++ }}</th>
                      <td>{{ $datas->outlet->nama_outlet }}</td>
                      <td>{{ $datas->member->nama }}</td>
                      <td>{{ $datas->paket->nama_paket }}</td>
                      <td>{{ $datas->paket->jenis }}</td>
                      <td>{{ $datas->tgl }}</td>
                      <td>{{ $datas->tgl_bayar }}</td>
                      <td>{{ $datas->member->alamat }}</td>
                      <td>{{ $datas->member->tlp }}</td>
                      <td>Rp.{{ $datas->biaya_tambahan }}</td>
                      <td>{{ $datas->diskon }}%</td>
                      <td>Rp.{{ $datas->pajak }}</td>
                      <td>Rp.{{ $datas->total_harga }}</td>
                      <td>{{ $datas->login->nama }}</td>
                      <td>{{ $datas->dibayar }}</td>
                    </tr>
                      @continue
                    <?php endif; ?>
                    <?php if ($datas->id_outlet != Session('id_outlet')): ?>
                      <tr>
                        <td class="text-center" colspan="15" style="font-size: 25px; height: 100px;">
                          Tidak Ada data Transaksi
                        </td>
                      </tr>
                      @break
                    <?php endif; ?>
                  <?php endforeach; ?>
                </tbody>
            </table>
            {{ $data_detail->links() }}
        </div>
    </div>
</div>
@endsection
