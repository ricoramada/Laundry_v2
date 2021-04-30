@extends('welcome')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-white">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Data Member</div>
                              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_member }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Data Transaksi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_transaksi }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Data Outlet
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $jumlah_outlet }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Data Paket Outlet</div>
                              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_paket }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Begin Page Content -->
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
              <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary text-uppercase">Transaksi Berlansung</h6>
              </div>
              <div class="card-body">
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
                                <th scope="col">Alamat Member</th>
                                <th scope="col">Nomer Telepon</th>
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
                                <th scope="col">Alamat Member</th>
                                <th scope="col">Nomer Telepon</th>
                                <th scope="col">Nama Kasir</th>
                                <th scope="col">Keterangan</th>
                              </tr>
                          </tfoot>
                          <tbody>
                            <?php foreach ($data_transaksi as $k => $datas): ?>
                              @if($datas->id_outlet == Session('id_outlet'))
                                <tr>
                                  <th scope="row">{{ $k +1 }}</th>
                                  <td>{{ $datas->outlet->nama_outlet }}</td>
                                  <td>{{ $datas->member->nama }}</td>
                                  <td>{{ $datas->paket->nama_paket }}</td>
                                  <td>{{ $datas->paket->jenis }}</td>
                                  <td>{{ $datas->tgl }}</td>
                                  <td>{{ $datas->member->alamat }}</td>
                                  <td>{{ $datas->member->tlp }}</td>
                                  <td>{{ $datas->login->nama }}</td>
                                  <td>{{ $datas->dibayar }}</td>
                                </tr>
                                @continue
                              @endif
                              @if($datas->id_outlet != Session('id_outlet'))
                                <tr>
                                  <td class="text-center" colspan="10" style="font-size: 25px;">
                                    Tidak Ada data Transaksi
                                  </td>
                                </tr>
                                @break
                              @endif
                            <?php endforeach; ?>
                          </tbody>
                      </table>
                      {{ $data_transaksi->links() }}
                  </div>
              </div>
          </div>
      <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->
</div>
<!-- /.container-fluid -->
@endsection
