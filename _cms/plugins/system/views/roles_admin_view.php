<?php 

$permissions = new Permissions();
$list = $permissions->list;

?>
<div class="main-page">
	<div class="tables">
		<h2 class="title1">Roles</h2>
		<div class="bs-example widget-shadow table-responsive" data-example-id="hoverable-table">
			<a class="btn btn-lg btn-primary" href="<?php echo $website->options->admin_path; ?>role/create/">
				<i class="fa fa-plus-circle fa-1x" aria-hidden="true"></i>
				Nuevo 
			</a>
			<hr>
			
			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Nombre</th>
						<th>Permisos</th>
						<th>Editar</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($list as $item) { ?>
						<tr>
							<th scope="row"><?php echo $item->id; ?></th>
							<td><?php echo $item->name; ?></td>
							<td>
								<table class="table table-responsive">
									<tr>
										<th>Nombre</th>
										<th>Habilitado / No Habilitado</th>
									</tr>
								<?php 
									# echo json_encode($item->data);
									foreach($item->data as $k => $v)
										{
											echo "<tr>";
												echo "<td>{$k}</td>";
												echo "<td>";
												if($v == true)
													{
														echo "<i class=\"fa fa-check-circle fa-2x\" aria-hidden=\"true\"></i> Habilitado";
													}
												else 
													{
														echo "<i class=\"fa fa-times-circle fa-2x\" aria-hidden=\"true\"></i> No Habilitado";
													}
												echo "</td>";
											echo "</tr>";
										}
								?>
								</table>
							</td>
							<td>
								<a href="<?php echo "{$website->options->admin_path}role/?role_id={$item->id}"; ?>" class="btn">
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