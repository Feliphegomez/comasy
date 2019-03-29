<?php 

$list = new Users();

?>
<div class="main-page">
	<div class="tables">
		<h2 class="title1">Usuarios</h2>
		<div class="bs-example widget-shadow table-responsive" data-example-id="hoverable-table"> 
			<a class="btn btn-lg btn-primary" href="<?php echo $website->options->admin_path; ?>user/create/">
				<i class="fa fa-plus-circle fa-1x" aria-hidden="true"></i>
				Nuevo 
			</a>
			<hr>
			
			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Usuario</th>
						<th>Nombres</th>
						<th>Primer Apellido</th>
						<th>Segundo Apellido</th>
						<th>Mail</th>
						<th>Telefono</th>
						<th>Movil</th>
						<th>registered</th>
						<th>Editar</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($list as $item) { ?>
						<tr>
							<th scope="row"><?php echo $item->id; ?></th>
							<td><?php echo $item->username; ?></td>
							<td><?php echo $item->names; ?></td>
							<td><?php echo $item->surname; ?></td>
							<td><?php echo $item->second_surname; ?></td>
							<td><?php echo $item->mail; ?></td>
							<td><?php echo $item->phone; ?></td>
							<td><?php echo $item->mobile; ?></td>
							<td><?php echo $item->registered; ?></td>
							<td>
								<a href="<?php echo "{$website->options->admin_path}user/?user_id={$item->id}"; ?>" class="btn">
									<i class="fa fa-edit"></i>
								</a>
							</td>
							<td></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>