<!-- side nav js -->
<script src='<?php echo $website->get_assets_folder(); ?>js/SidebarNav.min.js' type='text/javascript'></script>
<script>
  $('.sidebar-menu').SidebarNav()
</script>
<!-- //side nav js -->

<!-- Classie --><!-- for toggle left push menu script -->
	<script src="<?php echo $website->get_assets_folder(); ?>js/classie.js"></script>
	<script>
		var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
			showLeftPush = document.getElementById( 'showLeftPush' ),
			body = document.body;
			
		showLeftPush.onclick = function() {
			classie.toggle( this, 'active' );
			classie.toggle( body, 'cbp-spmenu-push-toright' );
			classie.toggle( menuLeft, 'cbp-spmenu-open' );
			disableOther( 'showLeftPush' );
		};
		
		function disableOther( button ) {
			if( button !== 'showLeftPush' ) {
				classie.toggle( showLeftPush, 'disabled' );
			}
		}
	</script>
<!-- //Classie --><!-- //for toggle left push menu script -->

<!--scrolling js-->
<script src="<?php echo $website->get_assets_folder(); ?>js/jquery.nicescroll.js"></script>
<script src="<?php echo $website->get_assets_folder(); ?>js/scripts.js"></script>
<!--//scrolling js-->

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo $website->get_assets_folder(); ?>js/bootstrap.js"> </script>



<script src="<?php echo $website->get_assets_folder(); ?>js/Chart.bundle.js"></script>
<script src="<?php echo $website->get_assets_folder(); ?>js/utils.js"></script>
<!-- for index page weekly sales java script -->
<script src="<?php echo $website->get_assets_folder(); ?>js/SimpleChart.js"></script>


<!-- for amcharts js -->
<script src="<?php echo $website->get_assets_folder(); ?>js/amcharts.js"></script>
<script src="<?php echo $website->get_assets_folder(); ?>js/serial.js"></script>
<script src="<?php echo $website->get_assets_folder(); ?>js/export.min.js"></script>
<link rel="stylesheet" href="<?php echo $website->get_assets_folder(); ?>css/export.css" type="text/css" media="all">
<script src="<?php echo $website->get_assets_folder(); ?>js/light.js"></script>
<script src="<?php echo $website->get_assets_folder(); ?>js/index1.js"></script>