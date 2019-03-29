<?php
global $website, $page_info;

?>

<div class="main-page">
	<h2 class="title1"><?php echo ($page_info->title); ?></h2>
	<div class="blank-page widget-shadow scroll" id="style-2 div1">
		<div id="gjs" class=""><?php echo ($page_info->content); ?></div>
	</div>
    <style scope="gjs">
    <?php echo ($page_info->style); ?>
    </style>
    <a href="<?php echo $website->options->admin_path."pages/"; ?>" class="btn btn-sm btn-secondary"> Regresar</a>
</div>

