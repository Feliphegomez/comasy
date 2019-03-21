<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html lang="es">
	<head>
		<?php $website->get_includes('head.php'); ?>
	</head>
	<body class="cbp-spmenu-push">
		<div class="main-content">
			<!--left-fixed -navigation-->
				<?php $website->get_includes('navigation.php'); ?>
			<!--left-fixed -navigation-->
			
			<!-- header-starts -->
				<?php $website->get_includes('header.php'); ?>
			<!-- //header-ends -->
			<!-- main content start-->
			<div id="page-wrapper">
				<?php $website->get_section_active(); ?>
			</div>
			<!--footer-->
				<?php $website->get_includes('footer.php'); ?>
			<!--//footer-->
		</div>
		<?php $website->get_includes('scripts.php'); ?>
	</body>
</html>