<?php 
global $website;
$pages_list = new Pages();
?>
<div>
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation">
			<a class="btn btn-secondary" href="javascript:COMASY.pages.create();">
				<i class="fa fa-plus-circle fa-lg" aria-hidden="true" title="Agregar nueva pagina"></i>
			</a>
		</li>
		<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Publicadas</a></li>
		<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Borradores</a></li>
		<li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Papelera</a></li>
		<li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Otras</a></li>
	</ul>
	
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="home">
			<div class="bs-example widget-shadow table-responsive" data-example-id="hoverable-table">
				<table class="table table-hover">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">Ver original</th>
							<th class="text-center">Cambiar Titulo</th>
							<th class="text-center">Titulo</th>
							<th class="text-center">Url</th>
							<th class="text-center">Tema del URL</th>
							<th class="text-center">Estado</th>
							<th class="text-center">E. Comentarios</th>
							<th class="text-center">T. Comentarios</th>
							<th class="text-center">Última modificación</th>
							<th class="text-center">Editor</th>
							<th class="text-center">Mover</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($pages_list->list('publish') as $page){ ?>
							<tr>
								<td><?php echo $page->id; ?></td>
								<td class="">
									<a class="btn btn-secondary" href="<?php echo $page->get_url(); ?>" target="_new">
										<i class="fa fa-eye" aria-hidden="true"></i>
									</a>
								</td>
								<td>
									<a class="btn btn-secondary" href="javascript:COMASY.pages.changeAttr(<?php echo $page->id; ?>, 'title', '<?php echo $page->title; ?>');">
										<i class="fa fa-exchange" aria-hidden="true"></i>
									</a>
								</td>
								<td>
									<a href="<?php echo $website->options->admin_path."page/?page_id={$page->id}"; ?>" target="_new">
										<?php echo $page->title; ?>
									</a>
								</td>
								<td>
									<?php 
										if($page->route_id != null)
											{
												echo "<a href=\"javascript:COMASY.pages.changeRouteText({$page->route_id}, '{$page->url}');\" class=\"btn\" aria-hidden=\"true\" title=\"Cambiar URL\"><i class=\"fa fa-exchange\"></i></a>";
												echo $page->get_url();
											}
										else 
											{
												echo "<a href=\"javascript:COMASY.pages.createRoute({$page->id});\" class=\"btn\"><i class=\"fa fa-plus-circle\" aria-hidden=\"true\" title=\"Crear URL\"></i></a>";
												echo "<b>Error</b>: No se encuentra URL de acceso o Route.<br>";
											}
									?>
								</td>
								<td>
									<?php 
										if($page->route_id != null)
											{
												echo "<a href=\"javascript:COMASY.pages.changeTheme({$page->route_id}, '{$page->route_theme}');\" class=\"btn\" title=\"Cambiar estado Abierto/Cerrado\"><i class=\"fa fa-exchange\" aria-hidden=\"true\"></i></a>";
											}
										echo $page->route_theme;
									?>
								</td>
								<td>
									<a href="javascript:COMASY.pages.changeOpenClosed(<?php echo $page->id; ?>, 'ping_status', '<?php echo $page->ping_status; ?>');" class="btn" title="Cambiar estado Abierto/Cerrado">
										<i class="fa fa-exchange" aria-hidden="true"></i>
									</a>
									<?php echo $page->ping_status; ?>
								</td>
								<td>
									<a href="javascript:COMASY.pages.changeOpenClosed(<?php echo $page->id; ?>, 'comment_status', '<?php echo $page->comment_status; ?>');" class="btn" title="Cambiar estado comentarios">
										<i class="fa fa-exchange" aria-hidden="true"></i>
									</a>
									<?php echo $page->comment_status; ?>
								</td>
								<td><?php echo $page->comment_count; ?></td>
								<td><?php echo $page->modified; ?></td>
								<td>
									<a href="<?php echo $website->options->admin_path."page/edit/?page_id={$page->id}"; ?>" class="btn" title="Editar pagina">
										<i class="fa fa-edit"></i>
									</a>
								</td>
								<td>
									<a href="javascript:COMASY.pages.changeStatus(<?php echo $page->id; ?>, '<?php echo $page->status; ?>');" class="btn" title="Cambiar estado">
										<i class="fa fa-exchange" aria-hidden="true"></i>
									</a>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane" id="profile">
			<div class="bs-example widget-shadow table-responsive" data-example-id="hoverable-table">
				<table class="table table-hover">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">Ver original</th>
							<th class="text-center">Cambiar Titulo</th>
							<th class="text-center">Titulo</th>
							<th class="text-center">Url</th>
							<th class="text-center">Tema del URL</th>
							<th class="text-center">Estado</th>
							<th class="text-center">E. Comentarios</th>
							<th class="text-center">T. Comentarios</th>
							<th class="text-center">Última modificación</th>
							<th class="text-center">Editor</th>
							<th class="text-center">Mover</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($pages_list->list('draft') as $page){ ?>
							<tr>
								<td><?php echo $page->id; ?></td>
								<td>
									<a class="btn btn-secondary" href="<?php echo $page->get_url(); ?>" target="_new">
										<i class="fa fa-eye" aria-hidden="true"></i>
									</a>
								</td>
								<td>
									<a class="btn btn-secondary" href="javascript:COMASY.pages.changeAttr(<?php echo $page->id; ?>, 'title', '<?php echo $page->title; ?>');">
										<i class="fa fa-exchange" aria-hidden="true"></i>
									</a>
								</td>
								<td>
									<a href="<?php echo $website->options->admin_path."page/?page_id={$page->id}"; ?>" target="_new">
										<?php echo $page->title; ?>
									</a>
								</td>
								<td>
									<?php 
										if($page->route_id != null)
											{
												echo "<a href=\"javascript:COMASY.pages.changeRouteText({$page->route_id}, '{$page->url}');\" class=\"btn\" aria-hidden=\"true\" title=\"Cambiar URL\"><i class=\"fa fa-exchange\"></i></a>";
												echo $page->get_url();
											}
										else 
											{
												echo "<a href=\"javascript:COMASY.pages.createRoute({$page->id});\" class=\"btn\"><i class=\"fa fa-plus-circle\" aria-hidden=\"true\" title=\"Crear URL\"></i></a>";
												echo "<b>Error</b>: No se encuentra URL de acceso o Route.<br>";
											}
									?>
								</td>
								<td>
									<?php 
										if($page->route_id != null)
											{
												echo "<a href=\"javascript:COMASY.pages.changeTheme({$page->route_id}, '{$page->route_theme}');\" class=\"btn\" title=\"Cambiar estado Abierto/Cerrado\"><i class=\"fa fa-exchange\" aria-hidden=\"true\"></i></a>";
											}
										echo $page->route_theme;
									?>
								</td>
								<td>
									<a href="javascript:COMASY.pages.changeOpenClosed(<?php echo $page->id; ?>, 'ping_status', '<?php echo $page->ping_status; ?>');" class="btn" title="Cambiar estado Abierto/Cerrado">
										<i class="fa fa-exchange" aria-hidden="true"></i>
									</a>
									<?php echo $page->ping_status; ?>
								</td>
								<td>
									<a href="javascript:COMASY.pages.changeOpenClosed(<?php echo $page->id; ?>, 'comment_status', '<?php echo $page->comment_status; ?>');" class="btn" title="Cambiar estado comentarios">
										<i class="fa fa-exchange" aria-hidden="true"></i>
									</a>
									<?php echo $page->comment_status; ?>
								</td>
								<td><?php echo $page->comment_count; ?></td>
								<td><?php echo $page->modified; ?></td>
								<td>
									<a href="<?php echo $website->options->admin_path."page/edit/?page_id={$page->id}"; ?>" class="btn" title="Editar pagina">
										<i class="fa fa-edit"></i>
									</a>
								</td>
								<td>
									<a href="javascript:COMASY.pages.changeStatus(<?php echo $page->id; ?>, '<?php echo $page->status; ?>');" class="btn" title="Cambiar estado">
										<i class="fa fa-exchange" aria-hidden="true"></i>
									</a>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane" id="messages">
			<div class="bs-example widget-shadow table-responsive" data-example-id="hoverable-table">
				<table class="table table-hover">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">Ver original</th>
							<th class="text-center">Cambiar Titulo</th>
							<th class="text-center">Titulo</th>
							<th class="text-center">Url</th>
							<th class="text-center">Tema del URL</th>
							<th class="text-center">Estado</th>
							<th class="text-center">E. Comentarios</th>
							<th class="text-center">T. Comentarios</th>
							<th class="text-center">Última modificación</th>
							<th class="text-center">Editor</th>
							<th class="text-center">Mover</th>
							<th class="text-center">Eliminar</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($pages_list->list('trash') as $page){ ?>
							<tr>
								<td><?php echo $page->id; ?></td>
								<td>
									<a class="btn btn-secondary" href="<?php echo $page->get_url(); ?>" target="_new">
										<i class="fa fa-eye" aria-hidden="true"></i>
									</a>
								</td>
								<td>
									<a class="btn btn-secondary" href="javascript:COMASY.pages.changeAttr(<?php echo $page->id; ?>, 'title', '<?php echo $page->title; ?>');">
										<i class="fa fa-exchange" aria-hidden="true"></i>
									</a>
								</td>
								<td>
									<a href="<?php echo $website->options->admin_path."page/?page_id={$page->id}"; ?>" target="_new">
										<?php echo $page->title; ?>
									</a>
								</td>
								<td>
									<?php 
										if($page->route_id != null)
											{
												echo "<a href=\"javascript:COMASY.pages.changeRouteText({$page->route_id}, '{$page->url}');\" class=\"btn\" aria-hidden=\"true\" title=\"Cambiar URL\"><i class=\"fa fa-exchange\"></i></a>";
												echo $page->get_url();
											}
										else 
											{
												echo "<a href=\"javascript:COMASY.pages.createRoute({$page->id});\" class=\"btn\"><i class=\"fa fa-plus-circle\" aria-hidden=\"true\" title=\"Crear URL\"></i></a>";
												echo "<b>Error</b>: No se encuentra URL de acceso o Route.<br>";
											}
									?>
								</td>
								<td>
									<?php 
										if($page->route_id != null)
											{
												echo "<a href=\"javascript:COMASY.pages.changeTheme({$page->route_id}, '{$page->route_theme}');\" class=\"btn\" title=\"Cambiar estado Abierto/Cerrado\"><i class=\"fa fa-exchange\" aria-hidden=\"true\"></i></a>";
											}
										echo $page->route_theme;
									?>
								</td>
								<td>
									<a href="javascript:COMASY.pages.changeOpenClosed(<?php echo $page->id; ?>, 'ping_status', '<?php echo $page->ping_status; ?>');" class="btn" title="Cambiar estado Abierto/Cerrado">
										<i class="fa fa-exchange" aria-hidden="true"></i>
									</a>
									<?php echo $page->ping_status; ?>
								</td>
								<td>
									<a href="javascript:COMASY.pages.changeOpenClosed(<?php echo $page->id; ?>, 'comment_status', '<?php echo $page->comment_status; ?>');" class="btn" title="Cambiar estado comentarios">
										<i class="fa fa-exchange" aria-hidden="true"></i>
									</a>
									<?php echo $page->comment_status; ?>
								</td>
								<td><?php echo $page->comment_count; ?></td>
								<td><?php echo $page->modified; ?></td>
								<td>
									<a href="<?php echo $website->options->admin_path."page/edit/?page_id={$page->id}"; ?>" class="btn" title="Editar pagina">
										<i class="fa fa-edit"></i>
									</a>
								</td>
								<td>
									<a href="javascript:COMASY.pages.changeStatus(<?php echo $page->id; ?>, '<?php echo $page->status; ?>');" class="btn" title="Cambiar estado">
										<i class="fa fa-exchange" aria-hidden="true"></i>
									</a>
								</td>
								<td>
									<a href="javascript:COMASY.pages.delete(<?php echo $page->id; ?>);" class="btn" title="Eliminar Pagina">
										<i class="fa fa-times-circle" aria-hidden="true"></i>
									</a>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane" id="settings">
			<div class="bs-example widget-shadow table-responsive" data-example-id="hoverable-table">
				<table class="table table-hover">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">Ver original</th>
							<th class="text-center">Cambiar Titulo</th>
							<th class="text-center">Titulo</th>
							<th class="text-center">Url</th>
							<th class="text-center">Tema del URL</th>
							<th class="text-center">Estado</th>
							<th class="text-center">E. Comentarios</th>
							<th class="text-center">T. Comentarios</th>
							<th class="text-center">Última modificación</th>
							<th class="text-center">Editor</th>
							<th class="text-center">Mover</th>
							<th class="text-center">Eliminar</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($pages_list->list('other') as $page){ ?>
							<tr>
								<td><?php echo $page->id; ?></td>
								<td>
									<a class="btn btn-secondary" href="<?php echo $page->get_url(); ?>" target="_new">
										<i class="fa fa-eye" aria-hidden="true"></i>
									</a>
								</td>
								<td>
									<a class="btn btn-secondary" href="javascript:COMASY.pages.changeAttr(<?php echo $page->id; ?>, 'title', '<?php echo $page->title; ?>');">
										<i class="fa fa-exchange" aria-hidden="true"></i>
									</a>
								</td>
								<td>
									<a href="<?php echo $website->options->admin_path."page/?page_id={$page->id}"; ?>" target="_new">
										<?php echo $page->title; ?>
									</a>
								</td>
								<td>
									<?php 
										if($page->route_id != null)
											{
												echo "<a href=\"javascript:COMASY.pages.changeRouteText({$page->route_id}, '{$page->url}');\" class=\"btn\" aria-hidden=\"true\" title=\"Cambiar URL\"><i class=\"fa fa-exchange\"></i></a>";
												echo $page->get_url();
											}
										else 
											{
												echo "<a href=\"javascript:COMASY.pages.createRoute({$page->id});\" class=\"btn\"><i class=\"fa fa-plus-circle\" aria-hidden=\"true\" title=\"Crear URL\"></i></a>";
												echo "<b>Error</b>: No se encuentra URL de acceso o Route.<br>";
											}
									?>
								</td>
								<td>
									<?php 
										if($page->route_id != null)
											{
												echo "<a href=\"javascript:COMASY.pages.changeTheme({$page->route_id}, '{$page->route_theme}');\" class=\"btn\" title=\"Cambiar estado Abierto/Cerrado\"><i class=\"fa fa-exchange\" aria-hidden=\"true\"></i></a>";
											}
										echo $page->route_theme;
									?>
								</td>
								<td>
									<a href="javascript:COMASY.pages.changeOpenClosed(<?php echo $page->id; ?>, 'ping_status', '<?php echo $page->ping_status; ?>');" class="btn" title="Cambiar estado Abierto/Cerrado">
										<i class="fa fa-exchange" aria-hidden="true"></i>
									</a>
									<?php echo $page->ping_status; ?>
								</td>
								<td>
									<a href="javascript:COMASY.pages.changeOpenClosed(<?php echo $page->id; ?>, 'comment_status', '<?php echo $page->comment_status; ?>');" class="btn" title="Cambiar estado comentarios">
										<i class="fa fa-exchange" aria-hidden="true"></i>
									</a>
									<?php echo $page->comment_status; ?>
								</td>
								<td><?php echo $page->comment_count; ?></td>
								<td><?php echo $page->modified; ?></td>
								<td>
									<a href="<?php echo $website->options->admin_path."page/edit/?page_id={$page->id}"; ?>" class="btn" title="Editar pagina">
										<i class="fa fa-edit"></i>
									</a>
								</td>
								<td>
									<a href="javascript:COMASY.pages.changeStatus(<?php echo $page->id; ?>, '<?php echo $page->status; ?>');" class="btn" title="Cambiar estado">
										<i class="fa fa-exchange" aria-hidden="true"></i>
									</a>
								</td>
								<td>
									<a href="javascript:COMASY.pages.delete(<?php echo $page->id; ?>);" class="btn" title="Eliminar Pagina">
										<i class="fa fa-times-circle" aria-hidden="true"></i>
									</a>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


