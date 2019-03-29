<!-- Bootstrap-Core-CSS -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap-theme.min.css">
<!-- <link href="<?php echo $website->get_assets_global(); ?>../libs/bootstrap/v3/css/bootstrap.css" rel="stylesheet"/> -->

<!-- Style-CSS -->
<link rel="stylesheet" href="<?php echo $website->get_assets_folder(); ?>css/style.css" type="text/css" media="all" />

<!-- Icons -->
<link href="<?php echo $website->get_assets_global(); ?>css/font-awesome.min.css" rel="stylesheet">

<!-- js-->
<script src="<?php echo $website->get_assets_global(); ?>js/jquery-1.11.1.min.js"></script>
<!--<script src="<?php echo $website->get_assets_global(); ?>../libs/bootstrap/v3/js/bootstrap.min.js"></script> -->

<!-- //  GrapesJS -->
<link href="<?php echo $website->get_assets_global(); ?>../libs/grapesjs-dev/dist/css/grapes.min.css" rel="stylesheet"/>
<!-- <link rel="stylesheet" href="https://grapesjs.com/stylesheets/demos.css"> -->
<script src="<?php echo $website->get_assets_global(); ?>../libs/grapesjs-dev/dist/grapes.min.js"></script>

<!-- // Blocks Bootstrap4 -->
<script src="<?php echo $website->get_assets_global(); ?>../libs/grapesjs-dev/plugins/grapesjs-blocks-bootstrap3/dist/grapesjs-blocks-bootstrap4.min.js"></script>

<!-- // Webpage -->
<link href="<?php echo $website->get_assets_global(); ?>../libs/grapesjs-dev/plugins/grapesjs-preset-webpage/dist/grapesjs-preset-webpage.min.css" rel="stylesheet"/>
<script src="<?php echo $website->get_assets_global(); ?>../libs/grapesjs-dev/plugins/grapesjs-preset-webpage/dist/grapesjs-preset-webpage.min.js"></script>

<!-- // Lory Slider -->
<script src="<?php echo $website->get_assets_global(); ?>../libs/grapesjs-dev/plugins/grapesjs-lory-slider/dist/grapesjs-lory-slider.min.js"></script>

<!-- Tabs -->
<script src="<?php echo $website->get_assets_global(); ?>../libs/grapesjs-dev/plugins/grapesjs-tabs/dist/grapesjs-tabs.min.js"></script>

<!-- Custom Code -->
<script src="<?php echo $website->get_assets_global(); ?>../libs/grapesjs-dev/plugins/grapesjs-custom-code/dist/grapesjs-custom-code.min.js"></script>

<!-- Touch -->
<script src="<?php echo $website->get_assets_global(); ?>../libs/grapesjs-dev/plugins/grapesjs-touch/dist/grapesjs-touch.min.js"></script>

<!-- Parser PostCSS -->
<script src="<?php echo $website->get_assets_global(); ?>../libs/grapesjs-dev/plugins/grapesjs-parser-postcss/dist/grapesjs-parser-postcss.min.js"></script>

<!-- Tooltip -->
<link rel="stylesheet" href="https://grapesjs.com/stylesheets/tooltip.css">
<script src="<?php echo $website->get_assets_global(); ?>../libs/grapesjs-dev/plugins/grapesjs-tooltip/dist/grapesjs-tooltip.min.js"></script>

<!-- tUI Image Editor -->
<script src="<?php echo $website->get_assets_global(); ?>../libs/grapesjs-dev/plugins/grapesjs-tui-image-editor/dist/grapesjs-tui-image-editor.min.js"></script>

<!-- Image Editor -->
<script src="https://grapesjs.com/js/grapesjs-tui-image-editor.min.js?0.1.2"></script>
<!-- Toastr -->
<link rel="stylesheet" href="https://grapesjs.com/stylesheets/toastr.min.css">
<script src="https://grapesjs.com/js/toastr.min.js"></script>

<!-- // Metis Menu -->
<script src="<?php echo $website->get_assets_global(); ?>js/metisMenu.min.js"></script>
<script src="<?php echo $website->get_assets_global(); ?>js/custom.js"></script>
<link href="<?php echo $website->get_assets_global(); ?>css/custom.css" rel="stylesheet">

<!-- // Vue -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-router/2.2.1/vue-router.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.15.3/axios.js"></script>

<style>
/*
	article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary { display: contents; }

*/
.gjs-editor { background: transparent !important; }
.gjs-dashed { background: transparent !important; }
.gjs-cv-canvas { background: transparent !important; }

#gjs {
	border: none;
}
.gjs-one-bg {
	background-color: rgba(10, 95, 155, 0.7);
}

.gjs-two-color {
	color: rgba(255, 255, 255, 0.7);
}

.gjs-three-bg {
	background-color: rgba(10, 95, 155, 0.7);
	color: white;
}


.gjs-four-color,
.gjs-four-color-h:hover {
	color: rgba(255, 255, 255, 0.7);
}
</style>


<script src="<?php echo $website->get_assets_global(); ?>../libs/bootbox/bootbox.min.js"></script>
<script src="<?php echo $website->get_assets_global(); ?>../libs/bootbox/bootbox.locales.min.js"></script>

<script src="<?php echo $website->get_assets_global(); ?>../libs/notifyjs/notify.js"></script>

<script>
$.notify.defaults({
	autoHide: false
});

var api = axios.create({
	baseURL: '/api'
});

var COMASY = {};
COMASY.pages = {};
COMASY.Modal = bootbox;
COMASY.Modal.addLocale('custom', {
	OK: 'Supongo',
	CONFIRM: 'Adelante',
	CANCEL: 'Tal vez no'
});

COMASY.pages.changeAttr = function(page_id, attribute, current_value) 
	{
		COMASY.Modal.prompt({
			size: "small",
			title: "Vas a modificar una campo " + attribute + ", deja esto quieto sino sabes que estas haciendo.", 
			locale: 'custom',
			value: current_value,
			callback: function (result) 
				{
					if(result != '' && result != null)
						{
							if(result == current_value)
								{
									$.notify("La informacion es la misma y no se va a modificar.", "warn");
								}
							else 
								{
									var temp = {};
									temp.id = page_id;
									temp[attribute] = result;

									api.put('/contents/' + temp.id, temp).then(function (response) {
										$.notify("El campo a sido cambiado con éxito.", "success");
										window.location.reload();
									}).catch(function (error) {
										console.log(error);
										$.notify("ocurrio un error al intentar modificar el campo.", "success");
									});
								}
						}
				}
		});
	};

COMASY.pages.changeOpenClosed = function(page_id, attribute, current) 
	{
		COMASY.Modal.confirm({
			message: "Debes confirmar que deseas cambiar este estado.",
			buttons: {
				confirm: {
					label: 'Adelante',
					className: 'btn-success'
				},
				cancel: {
					label: 'Tal vez no',
					className: 'btn-danger'
				}
			},
			callback: function (result) {
				if(result == true)
					{
						insert = 'none';
						if(current=='open' || current=='closed')
							{
								if(current=='open'){ current='closed'; } else if(current=='closed'){ current='open'; }
								insert=current;
								var temp = {};
								temp.id = page_id;
								temp[attribute] = insert;

								api.put('/contents/' + temp.id, temp).then(function (response) {
									$.notify("El estado a sido cambiado con éxito.", "success");
									window.location.reload();
								}).catch(function (error) {
									console.log(error);
									$.notify("ocurrio un error al intentar cmabiar el estado.", "success");
								});

							}
					}
			}
		});
	};
	
COMASY.pages.changeRouteText = function(route_id, current_text) 
	{
		COMASY.Modal.prompt({
			size: "small",
			title: "Vas a modificar una URL de acceso a la pagina, deja esto quieto sino sabes que estas haciendo.", 
			locale: 'custom',
			value: current_text,
			callback: function (result) 
				{
					if(result != '' && result != null)
						{
							if(result == current_text)
								{
									$.notify("La URL es la misma y no se va a modificar.", "warn");
								}
							else 
								{
									api.put('/routes/' + route_id, {
										id: route_id,
										url: result
									}).then(function (response) {
										$.notify("La URL fue cambiado con éxito.", "success");
										window.location.reload();
									}).catch(function (error) {
										console.log(error);
									});
								}
						}
				}
		});
	};

COMASY.createRoute = function(data_info, callback) 
	{
		if(
			data_info.plugin != null 
			&& data_info.module != null 
			&& data_info.section != null 
			&& data_info.id_route != null 
			&& data_info.theme != null 
			&& data_info.url != null
		)
			{
				api.post('/routes/', data_info).then(function (response) {
					$.notify("La URL fue creada con éxito.", "success");
					return callback(response);
				}).catch(function (error) {
					$.notify("Ocurrio un error al crear la URL.", "error");
					console.log(error);
					return callback(error.response);
				});
			}
	}

COMASY.pages.createRoute = function(page_id) 
	{
		COMASY.Modal.prompt({ 
			size: "small",
			title: "Vas a crear una URL de acceso a la pagina, deja esto quieto sino sabes que estas haciendo.", 
			locale: 'custom',
			callback: function (result) 
				{
					if(result != '' && result != null)
						{
							COMASY.createRoute({
								plugin: 'pages',
								module: 'single',
								section: 'view',
								id_route: page_id,
								theme: 'none',
								url: result
							}, function(r){
								console.log(r);
								if(r.data > 0)
									{
										window.location.reload();
									}
							});
						}
				}
		});
	};

COMASY.pages.changeTheme = function(route_id, current_theme) 
	{
		COMASY.Modal.prompt({
			title: "Estos son los temas disponibles.",
			message: '<p>Por favor, seleccione una opción a continuación:</p>',
			inputType: 'radio',
			value: current_theme,
			locale: 'custom',
			inputOptions: <?php echo json_encode($website->options->options_themes); ?>,
			callback: function (result) {
				console.log(result);
				
				if(result != '' && result != null)
					{
						if(result != current_theme)
							{
								api.put('/routes/' + route_id, {
									id: route_id,
									theme: result
								}).then(function (response) {
									$.notify("Se cambio el tema en la URL.", "success");
									
									window.location.reload();
								}).catch(function (error) {
									console.log(error);
									$.notify("Error actualizando el tema, intente nuevamente.", "error");
								});
							}
						else 
							{
								$.notify("Para actualizar se debe seleccionar un tema diferente.", "error");
							}
					}
				else 
					{
						$.notify("Debes seleccionar un tema.", "error");
					}
			}
		});
	};


COMASY.pages.changeStatus = function(page_id, current_status) 
	{
		COMASY.Modal.prompt({
			title: "Estos son los estados disponibles.",
			message: '<p>Por favor, seleccione una opción a continuación:</p>',
			inputType: 'radio',
			value: current_status,
			locale: 'custom',
			inputOptions: [
				{
					text: 'Publicado',
					value: 'publish'
				},
				{
					text: 'Borrador',
					value: 'draft'
				},
				{
					text: 'Papelera',
					value: 'trash'
				},
				{
					text: 'Otros',
					value: 'other'
				}
			],
			callback: function (result) {
				console.log(result);
				
				if(result != '' && result != null)
					{
						if(result != current_status)
							{
								api.put('/contents/' + page_id, {
									id: page_id,
									status: result
								}).then(function (response) {
									$.notify("Se cambio el estado de la pagina.", "success");
									
									window.location.reload();
								}).catch(function (error) {
									console.log(error);
									$.notify("Error actualizando el tema, intente nuevamente.", "error");
								});
							}
						else 
							{
								$.notify("Para actualizar se debe seleccionar un tema diferente.", "error");
							}
					}
				else 
					{
						$.notify("Debes seleccionar un tema.", "error");
					}
			}
		});
	};

COMASY.pages.delete = function(page_id) 
	{
		COMASY.Modal.confirm({
			message: "vas a eliminar la pagina de manera permanente.",
			buttons: {
				confirm: {
					label: 'Adelante',
					className: 'btn-success'
				},
				cancel: {
					label: 'Tal vez no',
					className: 'btn-danger'
				}
			},
			callback: function (result) {
				if(result == true)
					{
						api.put('/contents/' + page_id, {
							id: page_id,
							type: 'page_delete',
							status: 'delete'
						}).then(function (response) {
							$.notify("Se elimino la página por completo.", "success");
							
							window.location.reload();
						}).catch(function (error) {
							console.log(error);
							$.notify("Error eliminando la pagina, intente nuevamente.", "error");
						});
					}
			}
		});
	};

COMASY.pages.create = function(data_info) 
	{
		COMASY.Modal.confirm({
			message: "vas a crear un borrador, deseas continuar.",
			buttons: {
				confirm: {
					label: 'Adelante',
					className: 'btn-success'
				},
				cancel: {
					label: 'Tal vez no',
					className: 'btn-danger'
				}
			},
			callback: function (result) {
				if(result == true)
					{
						var mydate = new Date();
						api.post('/contents', {
							author: '<?php echo $website->session->id; ?>',
							title: 'Borrador ' + mydate.toDateString(),
							status: 'draft',
							type: 'page',
							parent: 0,
						}).then(function (response) {
							console.log(response);
							$.notify("Se creo el borrador correctamente.", "success");
							window.location.replace('<?php echo $website->options->admin_path; ?>page/edit/?page_id=' + response.data);
							// window.location.reload();
						}).catch(function (error) {
							console.log(error);
							$.notify("Ocurrio un problema al crear la nueva pagina.", "success");
						});
					}
			}
		});
	};
</script>



<!-- Extras -->
