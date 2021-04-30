<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css">
    <link rel="stylesheet" href="/css/art.css">
    <link rel="stylesheet" href="/css/login.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/duotone.css" integrity="sha384-R3QzTxyukP03CMqKFe0ssp5wUvBPEyy9ZspCB+Y01fEjhMwcXixTyeot+S40+AjZ" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/fontawesome.css" integrity="sha384-eHoocPgXsiuZh+Yy6+7DsKAerLXyJmu2Hadh4QYyt+8v86geixVYwFqUvMU8X90l" crossorigin="anonymous"/>
    <!-- Icons -->
    <link rel="icon" href="/laundry.png" sizes="any">
    <title>Laundry</title>
  </head>
  <body>
    <!-- Navbar -->
    <div class="container-fluid-lg">
      <nav class="navbar navbar-expand-lg navbar-mainbg">
        <a class="navbar-brand navbar-logo" href="/" style="font-family: 'Lucida Handwriting';"><i class="far fa-washer"></i>Laundry</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars text-white"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <div class="hori-selector"><div class="left"></div><div class="right"></div></div>
            <li class="nav-item active">
              <a class="nav-link" href="/profile/{{Session('id')}}"><i class="fas fa-user-alt"></i> {{ Session('nama') }}</a>
            </li>
            <?php if (Session('role') == 'admin' || Session('role') == 'kasir'): ?>
              <?php if (Session('id_outlet') == 0): ?>
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('outlet/') }}"><i class="far fa-store"></i> Store</a>
                </li>
              <?php else: ?>
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('outlet/' . Session::get('id_outlet') ) }}"><i class="far fa-store"></i> Store</a>
                </li>
              <?php endif; ?>
            <?php endif; ?>
            <?php if (Session('role') == 'admin' || Session('role') == 'kasir'): ?>
              <li class="nav-item">
                <a class="nav-link" href="/member"><i class="fas fa-users"></i> Member</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/formcart"><i class="far fa-cart-arrow-down"></i> Cart</a>
              </li>
            <?php endif; ?>
            <li class="nav-item">
              <a class="nav-link" href="/infoTransaksi"><i class="far fa-info"></i> Info Transaksi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/logout"><i class="far fa-sign-out-alt"></i> Logout</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
    <!-- Content -->
    <div class="container" style="width: 100rem; padding-top: 20px; margin: 0 auto;">
      @yield('content')
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript">
    // ---------Responsive-navbar-active-animation-----------
        function test(){
          var tabsNewAnim = $('#navbarSupportedContent');
          var selectorNewAnim = $('#navbarSupportedContent').find('li').length;
          var activeItemNewAnim = tabsNewAnim.find('.active');
          var activeWidthNewAnimHeight = activeItemNewAnim.innerHeight();
          var activeWidthNewAnimWidth = activeItemNewAnim.innerWidth();
          var itemPosNewAnimTop = activeItemNewAnim.position();
          var itemPosNewAnimLeft = activeItemNewAnim.position();
          $(".hori-selector").css({
            "top":itemPosNewAnimTop.top + "px",
            "left":itemPosNewAnimLeft.left + "px",
            "height": activeWidthNewAnimHeight + "px",
            "width": activeWidthNewAnimWidth + "px"
          });
          $("#navbarSupportedContent").on("click","li",function(e){
            $('#navbarSupportedContent ul li').removeClass("active");
            $(this).addClass('active');
            var activeWidthNewAnimHeight = $(this).innerHeight();
            var activeWidthNewAnimWidth = $(this).innerWidth();
            var itemPosNewAnimTop = $(this).position();
            var itemPosNewAnimLeft = $(this).position();
            $(".hori-selector").css({
              "top":itemPosNewAnimTop.top + "px",
              "left":itemPosNewAnimLeft.left + "px",
              "height": activeWidthNewAnimHeight + "px",
              "width": activeWidthNewAnimWidth + "px"
            });
          });
        }
        $(document).ready(function(){
          setTimeout(function(){ test(); });
        });
        $(window).on('resize', function(){
          setTimeout(function(){ test(); }, 500);
        });
        $(".navbar-toggler").click(function(){
          setTimeout(function(){ test(); });
        });
    </script>
  </body>
</html>
