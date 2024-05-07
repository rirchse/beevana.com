<!DOCTYPE html>
<html lang="en">
<head>
    
    @include('partials.styles')

    @yield('stylesheets')

</head>

<body class="hold-transition skin-blue sidebar-mini">	
		
		<div class="wrapper">

			@include('users.header')
			<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

				@yield('content')

			</div>
      <!-- /.content-wrapper -->

			@include('users.footer')

		</div><!-- /wrapper -->	

	<!--   Core JS Files   -->
	@include('partials.scripts')

	@yield('scripts')

	<script type="text/javascript">
		$(document).ready(function() {
			// Javascript method's body can be found in assets/js/demos.js
			demo.initDashboardPageCharts();
			demo.initVectorMap();
		});
	</script>

	<script type="text/javascript">
    $(document).ready(function() {
        md.initSliders()
        demo.initFormExtendedDatetimepickers();
    });


    $('.datepicker').attr('placeholder', 'MM/DD/YYYY');
    $('.datepicker').datepicker({
    	format: 'mm/dd/yyyy',
	    autoclose: true
	  })
    </script>
</body>
</html>