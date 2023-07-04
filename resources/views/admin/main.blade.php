<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <meta name="description" content="Tour">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - @yield('title-admin')</title>
    <!-- page css -->
    <link href="/backend/css/pages/login-register-lock.css" rel="stylesheet">
	<link href="/backend/css/pages/jquery.datetimepicker.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="/backend/assets/node_modules/morrisjs/morris.css" rel="stylesheet">
    <!--Toaster Popup message CSS -->
    <link href="/backend/assets/node_modules/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- Custom CSS -->
	<link href="/backend/dist/css/style.min.css?v=1" rel="stylesheet">
    <link href="/backend/css/pages/dashboard1.css?v={{ time() }}" rel="stylesheet">
	<link href="/backend/dist/css/pages/tab-page.css" rel="stylesheet">
</head>

<body class="horizontal-nav skin-megna fixed-layout">
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Admin</p>
        </div>
    </div>
	<div id="main-wrapper">
        @include('admin.layout.header')
		<!-- Page Content -->
        <div class="page-wrapper">
			<div class="container-fluid">
				@yield('content-admin')
			</div>
		</div>
		@include('admin.layout.footer')
	</div>
    <script src="/backend/assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap popper Core JavaScript -->
    <script src="/backend/assets/node_modules/popper/popper.min.js"></script>
    <script src="/backend/assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="/backend/dist/js/perfect-scrollbar.jquery.min.js"></script>
	<script src="/backend/js/jquery.datetimepicker.full.min.js"></script>
    <!--Wave Effects -->
    <script src="/backend/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="/backend/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="/backend/dist/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--morris JavaScript -->
    <script src="/backend/assets/node_modules/raphael/raphael-min.js"></script>
    <script src="/backend/assets/node_modules/morrisjs/morris.min.js"></script>
    <script src="/backend/assets/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!-- Popup message jquery -->
    <script src="/backend/assets/node_modules/toast-master/js/jquery.toast.js"></script>
    <!-- Chart JS -->
    <script src="/backend/dist/js/dashboard1.js"></script>
    <script src="/backend/assets/node_modules/toast-master/js/jquery.toast.js"></script>
	<script type="text/javascript" src="/backend/editor/ckfinder/ckfinder.js"></script>
	<script type="text/javascript" src="/backend/editor/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="/backend/editor/ckeditor/config.js?v=1"></script>
	<script type="text/javascript" src="/backend/editor/editor.js?v=1"></script>
    <!--Custom JavaScript -->
	@yield('admin-js')
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
    </script>
</body>

</html>
