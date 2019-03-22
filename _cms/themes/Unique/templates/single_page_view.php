<?php
global $website, $page_info;

$url = $website->page->url;

$classesHome = array(
	'/about.html' => 'about',
	'/blog.html' => 'blog',
	'/contact.html' => 'contact',
	'/gallery.html' => 'gallery',
	'/' => 'banner_w3lspvt',
	'/index.html' => 'banner_w3lspvt',
	'/services.html' => 'services',
	'/team.html' => 'team',
);
$classActive = 'banner_w3lspvt';

if(isset($classesHome[$url]))
	{
		$classActive = $classesHome[$url];
	}
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



<?php if($website->permissionIs('page_edit') == true){ ?>
	<nav class="navbar sticky-top navbar-dark bg-dark text-white" style="position: fixed; right: 35px; bottom: 35px; top: auto;">
		<a class="navbar-brand" href="<?php echo HOME_PATH; ?>pages/edit/?page_id=<?php echo ($page_info->id); ?>">
			<i class="fa fa-edit"></i>
			Editar Página
			
		</a>
	</nav>
<?php } ?>
