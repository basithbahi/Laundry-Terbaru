<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile Admin| Laundry</title>
    <meta content="" name="keywords">
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{ asset('style/images/icons/favicon.png')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('style/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('style/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('style/fonts/iconic/css/material-design-iconic-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('style/fonts/linearicons-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('style/vendor/animate/animate.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('style/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('style/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('style/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('style/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('style/vendor/slick/slick.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('style/vendor/MagnificPopup/magnific-popup.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('style/vendor/perfect-scrollbar/perfect-scrollbar.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('style/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('style/css/main.css')}}">
<!--===============================================================================================-->

    <style>
        body {
            color: #ffffff;
        }

        .center-table {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            border: 2px solid #000;
            color: #ffffff;
        }

        th, td {
            border: 2px solid #000;
            padding: 8px;
            text-align: left;
            color: #ffffff; /* Tambahkan untuk mengubah warna teks */
        }

        th {
            background-color: #f2f2f2;
        }

        .edit-button {
            margin-top: 20px;
        }

        .edit-button a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .edit-button a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="home"">
                    <img src="{{ asset('style/images/icons/Icon-Utama.png')}}" alt="IMG-LOGO" width="150" height="25">
            </a>

            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

      <nav id="navbar" class="navbar">
        <ul>
          <div class="menu-desktop">
						<ul class="main-menu">
							<li class="active-menu">
								<a href="{{ route('dashboard') }}">Home</a>
                            </li>
          <div class="topbar-divider d-none d-sm-block"></div>
          <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 medium">
                    {{ auth()->user()->nama }}
                </span>
                 <img class="rounded-circle" src="{{ asset('storage/' .auth()->user()->foto_profil) }}" alt="Foto Profil" width="50" height="50">
            </a>
           <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-center" href="{{ route('logout') }}">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-black"></i>
                  <span class="text-black">Logout</span>
                </a>
              </div>
           </li>
           <br>
        </ul>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->

    <div class="center-table">
        <h2>Profile</h2>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <tbody>
                    @if (Auth::check())
                        <tr>
                            <td style="color: black;">NIK:</td>
                            <td style="color: black;">{{ Auth::user()->nik }}</td>
                        </tr>
                        <tr>
                            <td style="color: black;">Nama:</td>
                            <td style="color: black;">{{ Auth::user()->nama }}</td>
                        </tr>
                        <tr>
                            <td style="color: black;">Alamat:</td>
                            <td style="color: black;">{{ Auth::user()->alamat }}</td>
                        </tr>
                        <tr>
                            <td style="color: black;">TTL:</td>
                            <td style="color: black;">{{ Auth::user()->ttl }}</td>
                        </tr>
                        <tr>
                            <td style="color: black;">JK:</td>
                            <td style="color: black;">{{ Auth::user()->jk }}</td>
                        </tr>
                        <tr>
                            <td style="color: black;">Nomor Telepon:</td>
                            <td style="color: black;">{{ Auth::user()->nomor_telepon }}</td>
                        </tr>
                        <tr>
                            <td style="color: black;">Email:</td>
                            <td style="color: black;">{{ Auth::user()->email }}</td>
                        </tr>
                        <tr>
                            <td style="color: black;">Foto_Profil:</td>
                            <td>
                                <img src="{{ asset('path/to/folder/'.Auth::user()->foto_profil) }}" alt="Foto Profil" width="100">
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="edit-button">
            <a href="{{ route('admin.editProfile', ['admin' => Auth::user()]) }}">Edit</a>
        </div>
    </div>
<!--===============================================================================================-->
	<script src="{{ asset('style/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('style/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('style/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{ asset('style/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('style/vendor/select2/select2.min.js')}}"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
<!--===============================================================================================-->
	<script src="{{ asset('style/vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{ asset('style/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('style/vendor/slick/slick.min.js')}}"></script>
	<script src="{{ asset('style/js/slick-custom.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('style/vendor/parallax100/parallax100.js')}}"></script>
	<script>
        $('.parallax100').parallax100();
	</script>
<!--===============================================================================================-->
	<script src="{{ asset('style/vendor/MagnificPopup/jquery.magnific-popup.min.js')}}"></script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
		});
	</script>
<!--===============================================================================================-->
	<script src="{{ asset('style/vendor/isotope/isotope.pkgd.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('style/vendor/sweetalert/sweetalert.min.js')}}"></script>
	<script>
		$('.js-addwish-b2').on('click', function(e){
			e.preventDefault();
		});
		$('.js-addwish-b2').each(function(){
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");
				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});
		$('.js-addwish-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");
				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});
		/---------------------------------------------/
		$('.js-addcart-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});
	</script>
<!--===============================================================================================-->
	<script src="{{ asset('style/vendor/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});
			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>
<!--===============================================================================================-->
	<script src="{{ asset('style/js/main.js')}}"></script>


</body>
</html>
