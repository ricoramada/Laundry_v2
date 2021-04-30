@extends('welcome')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card card-signin my-5">
        <div class="card-body">
          <h5 class="card-title text-center">Daftar Role & Outlet Anda</h5>
          <form class="form-signin" action="{{ url('role/'. Session('id') . '/daftar') }}" method="post">
            @csrf
            <div class="form-group">
              <label for="nama_member">Nama Outlet</label>
              <select class="form-control form-control-lg" name="id_outlet">
                <option value="" selected disabled>--Outlet Yang Tersedia--</option>
                <?php if ($data_outlet != null): ?>
                  <?php foreach ($data_outlet as $k): ?>
                    <option value="{{ $k->id }}">{{ $k->nama_outlet }}</option>
                  <?php endforeach; ?>
                <?php else: ?>
                  <option value="tidak ada outlet">Tidak Ada Outlet</option>
                <?php endif; ?>
              </select>
            </div>

            <div class="form-group">
              <label for="nama_member">Role</label>
              <select class="form-control form-control-lg" name="role" required>
                <option value="" selected disabled>--Pilih Role--</option>
                <option value="Kasir">Kasir</option>
                <option value="Owner">Owner</option>
              </select>
            </div>

            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Daftar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
