@extends('welcome')

@section('content')
  <div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card card-signin my-5">
        <div class="card-body">
          <h5 class="card-title text-center">Tambah Member</h5>
          <form class="form-signin" action="{{ url('editmember/'. $data->id . '/update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="inputPassword">Nama Member</label>
              <input type="text" name="nama" id="inputPassword" class="form-control form-control-lg" placeholder="Nama Member" value="{{ $data->nama }}" required>
            </div>

            <div class="form-group">
              <label for="inputEmail">Alamat</label>
              <input type="text" name="alamat" id="inputEmail" class="form-control form-control-lg" placeholder="Alamat" value="{{ $data->alamat }}" required>
            </div>

            <div class="form-group">
              <label for="inputEmail">Nomor Telepon</label>
              <input type="number" name="tlp" id="inputEmail" class="form-control form-control-lg" placeholder="Nomor Telepon" value="{{ $data->tlp }}" required>
            </div>

            <div class="form-group">
              <label for="nama_member">Jenis Kelamin</label>
              <select class="form-control form-control-lg" name="jenis_kelamin">
                <?php if ($data->jenis_kelamin == 'Laki-Laki'): ?>
                  <option value="Laki-Laki">Laki-Laki</option>
                  <option value="Perempuan">Perempuan</option>
                <?php else: ?>
                  <option value="Perempuan">Perempuan</option>
                  <option value="Laki-Laki">Laki-Laki</option>
                <?php endif; ?>
              </select>
            </div>

            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Submit</button>
            <hr class="md-2">
            <a class="btn btn-lg btn-success btn-block text-uppercase" href="/member"><i class="fas fa-long-arrow-alt-left"></i> Kembali</a>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
