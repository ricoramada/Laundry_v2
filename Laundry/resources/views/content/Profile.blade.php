@extends('welcome')

@section('content')

@if ($message = Session::get('data'))
 <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ $message }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="container">
  <div class="page-content page-container" id="page-content" style="align: center;">
    <div class="padding">
      <div class="row container d-flex justify-content-center">
        <div class="col-xl-6 col-xl-12">
          <div class="card user-card-full">
            <div class="row m-l-0 m-r-0">
              <div class="col-sm-4 bg-c-lite-green user-profile">
                <div class="card-block text-center text-white">
                  <?php if (!Session('photo')): ?>
                    <div class="m-b-25"> <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image"> </div>
                  <?php else: ?>
                    <div class="m-b-25"> <img src="{{ Session('photo') }}" class="img-radius" alt="User-Profile-Image"> </div>
                  <?php endif; ?>
                  <h6 class="f-w-600">{{ Session('nama') }}</h6>
                  <p>{{ Session('role') }}</p> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                </div>
              </div>
              <div class="col-sm-8">
                <div class="card-block">
                  <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                  <div class="row">
                    <div class="col-sm-6">
                      <p class="m-b-10 f-w-600">Email</p>
                      <h6 class="text-muted f-w-400">{{ Session('email') }}</h6>
                    </div>
                    <div class="col-sm-6">
                      <p class="m-b-10 f-w-600">User ID</p>
                      <h6 class="text-muted f-w-400">{{ Session('number_user') }}</h6>
                    </div>
                  </div>
                  <ul class="social-link list-unstyled m-t-40 m-b-10">
                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook" data-abc="true"><i class="fab fa-facebook-square" aria-hidden="true"></i></a></li>
                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter" data-abc="true"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram" data-abc="true"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                  </ul>
                </div>
                <a href="{{ url('profile/' . Session('id') . '/hapusAkun') }}" class="btn btn-danger" style="float: right;">Delete Akun</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
