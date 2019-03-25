<?php 
global $website;
$pages_list = new Pages();
?>
<style>
a.list-group-item {
    height:auto;
    min-height:220px;
}
a.list-group-item.active small {
    color:#fff;
}
.stars {
    margin:20px auto 1px;    
}
</style>

<div class="team he-codes">
<br>
<br>
<div class="container">
    <div class="row">
		<div class="well">
        <div class="list-group">
			<?php foreach($pages_list->list() as $page){ ?>
				<a href="<?php echo $page->url; ?>" class="list-group-item ">
					<div class="media col-md-3">
						<figure class="pull-left">
							<img class="media-object img-rounded img-responsive"  src="http://placehold.it/350x250" alt="placehold.it/350x250" >
						</figure>
					</div>
					<div class="col-md-6">
						<h4 class="list-group-item-heading"> <?php echo $page->title; ?> </h4>
						<p class="list-group-item-text"> <?php echo rip_tags($page->content); ?></p>
					</div>
					<div class="col-md-3 text-center">
						<h2> Categoria <small> SubCategoria </small></h2>
						<button type="button" class="btn btn-default btn-lg btn-block"> Seguir Leyendo! </button>
                        <!-- //						
                        <div class="stars">
							<span class="glyphicon glyphicon-star"></span>
							<span class="glyphicon glyphicon-star"></span>
							<span class="glyphicon glyphicon-star"></span>
							<span class="glyphicon glyphicon-star"></span>
							<span class="glyphicon glyphicon-star-empty"></span>
						</div>
						<p> Average 4.5 <small> / </small> 5 </p>
                        -->
					</div>
				</a>
			<?php } ?>
        </div>
        </div>
	</div>
</div>

</div>
