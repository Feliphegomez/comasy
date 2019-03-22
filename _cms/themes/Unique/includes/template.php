<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php $website->get_includes('head.php'); ?>
	</head>
	<body>
		<?php $website->get_includes('navigation.php'); ?>
		<!-- banner -->
			<?php $website->get_includes('header.php'); ?>
			<?php $website->get_section_active(); ?>
		<!-- //banner -->
		<?php $website->get_includes('scripts.php'); ?>
	</body>
</html>