<style media="screen">
  table {
    border-left: 0.01em solid #010101;
    border-right: 0;
    border-top: 0.01em solid #010101;
    border-bottom: 0;
    border-collapse: collapse;
  }
  table td,
  table th {
    border-left: 0;
    border-right: 0.01em solid #010101;
    border-top: 0;
    border-bottom: 0.01em solid #010101;
    text-align: center;
  }
</style>
<h1>Info Transaksi</h6>
<table>
  <h4 style="float: right; margin-top: -1px;">Total Pendapatan</h4>
  <input type="text" class="form-control-md" value="Rp. {{ $modelTransaksi->sum('total_harga') }}" style="float: right;" disabled>
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
  <tbody>
    <?php foreach ($modelTransaksi as $k => $datas): ?>
      <tr>
        <th scope="row">{{ $k +1 }}</th>
        <td>{{ $datas->outlet->nama_outlet }}</td>
        <td>{{ $datas->member->nama }}</td>
        <td>{{ $datas->paket->nama_paket }}</td>
        <td>{{ $datas->paket->jenis }}</td>
        <td>{{ $datas->tgl }}</td>
        <td>{{ $datas->tgl_bayar }}</td>
        <td>{{ $datas->member->alamat }}</td>
        <td>{{ $datas->member->tlp }}</td>
        <td>{{ $datas->biaya_tambahan }}</td>
        <td>{{ $datas->diskon }}</td>
        <td>{{ $datas->pajak }}</td>
        <td>{{ $datas->total_harga }}</td>
        <td>{{ $datas->login->nama }}</td>
        <td>{{ $datas->dibayar }}</td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
