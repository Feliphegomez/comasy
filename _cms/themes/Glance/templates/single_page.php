<?php 
	global $website, $page_info;
?>


<div class="about he-codes">
	<div class="pb-sm-5 pb-4"> <!-- // about-cont pt-5 -->
		<?php echo json_encode($page_info); ?>
	</div>
	
	<style>
		<?php echo ($page_info->style); ?>
	</style>
	<!-- copyright -->
	<?php $website->get_includes('footer.php'); ?>
	<!-- //copyright -->
</div>
