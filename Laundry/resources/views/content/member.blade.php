@extends('welcome')

@section('content')
<a class="btn btn-outline-success btn-lg" href="/form_member" style="margin-top: 1rem; margin-bottom: 1rem;">Tambahkan Member</a>
<form action="{{ url('member/cari') }}" class="form-inline float-right" style="margin-top: 1rem; margin-bottom: 1rem;">
    <input class="form-control mr-sm-2 form-control-lg" name="search" type="search" placeholder="Search" aria-label="Search" value="{{ old('search') }}">
    <button class="btn btn-lg btn-outline-success my-2 my-sm-0" type="submit">Search</button>
</form>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary text-uppercase">Member</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Telepon</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Telepon</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php $no=1; ?>
                  <?php foreach ($data as $k => $datas): ?>
                      <tr>
                        <th scope="row">{{ $no++ }}</th>
                        <td>{{ $datas->nama }}</td>
                        <td>{{ $datas->alamat }}</td>
                        <td>{{ $datas->jenis_kelamin }}</td>
                        <td>{{ $datas->tlp }}</td>
                        <td>
                          <a href="{{ url('editmember/' . $datas->id . '/edit') }}"><button type="button" class="btn btn-primary">Edit</button></a>
                          <a href="/hapus_member/{{ $datas->id }}"><button type="button" class="btn btn-danger">Hapus</button></a>
                        </td>
                      </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
