<?php
global $sessions;

$alls = $sessions->data;


?>
<div class="main-page">
	<div class="tables">
		<h2 class="title1">Usuarios</h2>
		<div class="bs-example widget-shadow table-responsive" data-example-id="hoverable-table"> 
			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>username</th>
						<th>last_accessed</th>
						<th>real_ip</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($alls as $item) { ?>
						<tr>
							<th scope="row"><?php echo $item->id; ?></th>
							<td><?php echo $item->username; ?></td>
							<td><?php echo $item->last_accessed; ?></td>
							<td><?php echo $item->real_ip; ?></td>
							<td>
								<button class="btn btn-lg btn-danger" onclick="javascript:COMASY._sessions.close('<?php echo $item->id; ?>');" >
									<i class="fa fa-plus-circle fa-1x" aria-hidden="true"></i>
									Cerrar 
								</button>
							</td>
							<td></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>