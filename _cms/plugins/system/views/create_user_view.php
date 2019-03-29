<?php 
global $info;
$form_json = $info->form_create();
$form_d = new FormDesign($form_json);

# echo json_encode($info);
?>
<div class="main-page bootstrap snippet">
	<div class="row">
		<div class="col-sm-3">
		</div>
		<div class="col-sm-5">
			<h3>Crear nuevo usuario</h3>
		</div>
		<div class="col-sm-4">
			<h1 class="pull-right"></h1>
		</div>
	</div>
	<div class="blank-page widget-shadow scroll" id="style-2 div11">
		<div class="row">
			<div class="col-sm-12">
				<form class="form" action="" method="post" id="infocreate-user">
					<?php echo $form_d->get_html(); ?>

					<div class="form-group">
						<div class="col-xs-12">
							<br>
							<a class="btn btn-lg btn-primary" href="<?php echo $website->options->admin_path; ?>users/">
								<i class="fa fa-hand-o-left fa-1x" aria-hidden="true"></i>
								Regresar 
							</a>
							
							<button name="form-userData-create" value="true" class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Crear</button>
							<button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reiniciar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

	
</div>