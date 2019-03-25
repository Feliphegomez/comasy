<?php
global $website, $page_info;

?>

<div id="body-page" class="">
	<div class="">
		<div id="gjs" class="">
			<?php echo ($page_info->content); ?>
		</div>
<style>
<?php echo ($page_info->style); ?>
</style>
		<?php $website->get_includes('footer.php'); ?>
	</div>
</div>