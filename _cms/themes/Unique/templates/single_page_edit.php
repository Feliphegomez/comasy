<?php 
global $website, $page_info;

if($website->permissionIs('page_edit') == true){
	
?>

<div id="body-page" class="">
	<div class="">
		<div id="gjs" class=""><?php echo ($page_info->content); ?></div>
		<?php $website->get_includes('footer.php'); ?>
	</div>
</div>

<div class="ad-cont" style="display: nones">
	URL: <?php echo $page_info->get_url(); ?>
	<br>
</div>

<div id="info-panel-editor" style = "display: none">
	<div class = "info-panel-label">
		<h2>COMASY</h2>
		<br>
		<p>
			Comasy trae un editor llamado, <b> GrapesJS Webpage Builder </b> el cual es un editor por bloqeues simple. <br/> <br/>
			Para cualquier pista sobre la demostración, compruebe la <a class="info-panel-link gjs-four-color" target="_blank" href="https://github.com/artf/grapesjs-preset-webpage"> Repositorio de presets de páginas web </a> y abrir un problema. Para problemas con el propio constructor, abra un problema en la página principal <a class="info-panel-link gjs-four-color" target="_blank" href="https://github.com/artf/grapesjs"> repositorio de GrapesJS </a> <br/> <br/>
			Ser un colaborador y colaborador de proyectos de código abierto y gratuito son muy bienvenidos.
			Si le gusta el proyecto, puede apoyarlo con una donación de su elección o convertirse en patrocinador / patrocinador a través de <a class="info-panel-link gjs-four-color" target="_blank" href="https://opencollective.com/grapesjs"> Colectivo abierto </a>
		</p>
	</div>
</div>

<template id="html-origin">
	<?php echo ($page_info->content); ?>
</template>

<script>

var lp = '//grapesjs.com/img/';
var plp = '//placehold.it/350x250/';
var html_original = $("#html-origin").html();
var style_original = $("#style-origin").html();

var images = [
	lp+'team1.jpg',
	lp+'team2.jpg',
	lp+'team3.jpg',
	plp+'78c5d6/fff/image1.jpg',
	plp+'459ba8/fff/image2.jpg',
	plp+'79c267/fff/image3.jpg',
	plp+'c5d647/fff/image4.jpg',
	plp+'f28c33/fff/image5.jpg',
	plp+'e868a2/fff/image6.jpg',
	plp+'cc4360/fff/image7.jpg',
	lp+'work-desk.jpg',
	lp+'phone-app.png',
	lp+'bg-gr-v.png'
];

var options_api = {
	record: '/contents',
	list_search_field: 'title',
	list_filters: [
		'type,eq,page',
		'status,eq,publish',
		'ping_status,eq,open'
	],
	editor: {
		plugins: [
			'grapesjs-blocks-bootstrap4',
			'gjs-preset-webpage',
			'grapesjs-lory-slider',
			'grapesjs-tabs',
			'grapesjs-custom-code',
			'grapesjs-touch',
			'grapesjs-parser-postcss',
			'grapesjs-tooltip',
			'grapesjs-tui-image-editor',
		],
		pluginsOpts: {
			'grapesjs-blocks-bootstrap4': {
				blocks: {
					default: false,
					text: true,
					link: true,
					image: false,
					container: true,
					row: true,
					column: true,
					column_break: true,
					media_object: true,
					alert: true,
					badge: true,
					button: false,
					button_group: false,
					button_toolbar: false,
					card: false,
					card_container: false,
					collapse: false,
					dropdown: false,
					header: true,
					paragraph: true,
				},
				blockCategories: {
				},
				labels: {
					text: 'Texto Bootstrap',
					link: 'Link Bootstrap',
					image: 'Imagen Bootstrap',
					container: 'Capa Principal',
					row: 'Subcapa Bootstrap',
					column: 'Columna Bootstrap',
					column_break: 'Salto de columna Bootstrap',
					media_object: 'Objeto Bootstrap',
					alert: 'Alerta Bootstrap',
					badge: 'Placa Bootstrap',
					button: 'Boton Bootstrap',
					button_group: 'Botonera Bootstrap',
					button_toolbar: 'Toolbar Botones Bootstrap',
					card: 'Ficha Bootstrap',
					card_container: 'Contenedor de Fichas Bootstrap',
					collapse: 'colapso Bootstrap',
					dropdown: 'desplegable Bootstrap',
					header: 'Encabezado Bootstrap',
					paragraph: 'Parrafo Bootstrap',
				},
			},
			'gjs-preset-webpage': {
				modalImportTitle: 'Plantilla de importación',
				modalImportLabel: '<div style="margin-bottom: 10px; font-size: 13px;">Pegue aquí su HTML / CSS y haga clic en Importar</div>',
				modalImportContent: function(editor) {
					return editor.getHtml(); editor.style = editor.getCss();
				},
				filestackOpts: null,
				aviaryOpts: false,
				blocksBasicOpts: {
					flexGrid: 0
				},
				customStyleManager: [
					{
						name: 'General',
						buildProps: ['float', 'display', 'position', 'top', 'right', 'left', 'bottom'],
						properties:[
							{
								name: 'Alineación',
								property: 'float',
								type: 'radio',
								defaults: 'none',
								list: [
									{ value: 'none', className: 'fa fa-times'},
									{ value: 'left', className: 'fa fa-align-left'},
									{ value: 'center', className: 'fa fa-align-center'},
									{ value: 'right', className: 'fa fa-align-right'},
									{ value: 'justify', className: 'fa fa-align-justify'},
								],
							},
							{ property: 'position', type: 'select'}
						],
					},{
						name: 'Dimensión',
						open: false,
						buildProps: ['width', 'flex-width', 'height', 'max-width', 'min-height', 'margin', 'padding'],
						properties: [
							{
								id: 'flex-width',
								type: 'integer',
								name: 'Ancho',
								units: ['px', '%'],
								property: 'flex-basis',
								toRequire: 1,
							},{
								property: 'margin',
								properties:[
									{ name: 'Superior', property: 'margin-top'},
									{ name: 'Derecha', property: 'margin-right'},
									{ name: 'Inferior', property: 'margin-bottom'},
									{ name: 'Izquierda', property: 'margin-left'}
								],
							},{
								property  : 'padding',
								properties:[
									{ name: 'Superior', property: 'padding-top'},
									{ name: 'Derecha', property: 'padding-right'},
									{ name: 'Inferior', property: 'padding-bottom'},
									{ name: 'Izquierda', property: 'padding-left'}
								],
							}
						],
					},{
						name: 'Tipografía',
						open: false,
						buildProps: ['font-family', 'font-size', 'font-weight', 'letter-spacing', 'color', 'line-height', 'text-align', 'text-decoration', 'text-shadow'],
						properties:[
							{ name: 'Fuente', property: 'font-family'},
							{ name: 'Grosor', property: 'font-weight'},
							{ name:  'Color de fuente', property: 'color'},
							{
								property: 'text-align',
								type: 'radio',
								defaults: 'left',
								list: [
									{ value : 'left',  name : 'Izquierda',    className: 'fa fa-align-left'},
									{ value : 'center',  name : 'Centrar',  className: 'fa fa-align-center' },
									{ value : 'right',   name : 'Derecha',   className: 'fa fa-align-right'},
									{ value : 'justify', name : 'Justificar',   className: 'fa fa-align-justify'}
								],
							},{
								property: 'text-decoration',
								type: 'radio',
								defaults: 'none',
								list: [
									{ value: 'none', name: 'Ninguno', className: 'fa fa-times'},
									{ value: 'underline', name: 'subrayar', className: 'fa fa-underline' },
									{ value: 'line-through', name: 'Línea de paso', className: 'fa fa-strikethrough'}
								],
							},{
								property: 'text-shadow',
								properties: [
									{ name: 'Posición X', property: 'text-shadow-h'},
									{ name: 'Posición Y', property: 'text-shadow-v'},
									{ name: 'Difuminar', property: 'text-shadow-blur'},
									{ name: 'Color', property: 'text-shadow-color'}
								],
							}
						],
					},{
						name: 'Decoraciones',
						open: false,
						buildProps: ['opacity', 'background-color', 'border-radius', 'border', 'box-shadow', 'background'],
						properties: [
							{
								type: 'slider',
								property: 'opacity',
								defaults: 1,
								step: 0.01,
								max: 1,
								min:0,
							},{
								property: 'border-radius',
								properties  : [
									{ name: 'Superior', property: 'border-top-left-radius'},
									{ name: 'Derecha', property: 'border-top-right-radius'},
									{ name: 'Inferior', property: 'border-bottom-left-radius'},
									{ name: 'Izquierda', property: 'border-bottom-right-radius'}
								],
							},{
								property: 'box-shadow',
								properties: [
									{ name: 'Posición X', property: 'box-shadow-h'},
									{ name: 'Posición Y', property: 'box-shadow-v'},
									{ name: 'Difuminar', property: 'box-shadow-blur'},
									{ name: 'Untada', property: 'box-shadow-spread'},
									{ name: 'Color', property: 'box-shadow-color'},
									{ name: 'Tipo de sombra', property: 'box-shadow-type'}
								],
							},{
								property: 'background',
								properties: [
									{ name: 'Imagen', property: 'background-image'},
									{ name: 'Repetir', property:   'background-repeat'},
									{ name: 'Posición', property: 'background-position'},
									{ name: 'Archivo Adjunto', property: 'background-attachment'},
									{ name: 'Tamaño', property: 'background-size'}
								],
							},
						],
					},{
						name: 'Extra',
						open: false,
						buildProps: ['transition', 'perspective', 'transform'],
						properties: [{
							property: 'transition',
							properties:[
								{ name: 'Propiedad', property: 'transition-property'},
								{ name: 'Duración', property: 'transition-duration'},
								{ name: 'Facilitando', property: 'transition-timing-function'}
							],
						},{
							property: 'transform',
							properties:[
								{ name: 'Girar X', property: 'transform-rotate-x'},
								{ name: 'Girar Y', property: 'transform-rotate-y'},
								{ name: 'Girar Z', property: 'transform-rotate-z'},
								{ name: 'Escalar X', property: 'transform-scale-x'},
								{ name: 'Escalar Y', property: 'transform-scale-y'},
								{ name: 'Escalar Z', property: 'transform-scale-z'}
							],
						}]
					},{
						name: 'Flexionar',
						open: false,
						properties: [
							{
								name: 'Contenedor flexible',
								property: 'display',
								type: 'select',
								defaults: 'block',
								list: [
									{ value: 'block', name: 'Inhabilitar'},
									{ value: 'flex', name: 'Habilitar'}
								],
							},{
								name: 'Flex Padre',
								property: 'label-parent-flex',
								type: 'integer',
							},{
								name      : 'Dirección',
								property  : 'flex-direction',
								type    : 'radio',
								defaults  : 'row',
								list    : [
									{
										value   : 'row',
										name    : 'Fila',
										className : 'icons-flex icon-dir-row',
										title   : 'Row',
									},{
										value   : 'row-reverse',
										name    : 'Fila inversa',
										className : 'icons-flex icon-dir-row-rev',
										title   : 'Row reverse',
									},{
										value   : 'column',
										name    : 'Columna',
										title   : 'Column',
										className : 'icons-flex icon-dir-col',
									},{
										value   : 'column-reverse',
										name    : 'Columna inversa',
										title   : 'Column reverse',
										className : 'icons-flex icon-dir-col-rev',
									}
								],
							},{
								name      : 'Justificar',
								property  : 'justify-content',
								type    : 'radio',
								defaults  : 'flex-start',
								list    : [
									{
										value   : 'flex-start',
										className : 'icons-flex icon-just-start',
										title   : 'Start',
									},{
										value   : 'flex-end',
										title    : 'End',
										className : 'icons-flex icon-just-end',
									},{
										value   : 'space-between',
										title    : 'Space between',
										className : 'icons-flex icon-just-sp-bet',
									},{
										value   : 'space-around',
										title    : 'Space around',
										className : 'icons-flex icon-just-sp-ar',
									},{
										value   : 'center',
										title    : 'Center',
										className : 'icons-flex icon-just-sp-cent',
									}
								],
							},{
								name      : 'Alinear',
								property  : 'align-items',
								type    : 'radio',
								defaults  : 'center',
								list    : [
									{
										value   : 'flex-start',
										title    : 'Start',
										className : 'icons-flex icon-al-start',
									},{
										value   : 'flex-end',
										title    : 'End',
										className : 'icons-flex icon-al-end',
									},{
										value   : 'stretch',
										title    : 'Stretch',
										className : 'icons-flex icon-al-str',
									},{
										value   : 'center',
										title    : 'Center',
										className : 'icons-flex icon-al-center',
									}
								],
							},{
								name: 'Flex Hijos',
								property: 'label-parent-flex',
								type: 'integer',
							},{
								name:     'Orden',
								property:   'order',
								type:     'integer',
								defaults :  0,
								min: 0
							},{
								name    : 'Flexionar',
								property  : 'flex',
								type    : 'composite',
								properties  : [{
									  name:     'Crecer',
									  property:   'flex-grow',
									  type:     'integer',
									  defaults :  0,
									  min: 0
									},{
									  name:     'Encogimiento',
									  property:   'flex-shrink',
									  type:     'integer',
									  defaults :  0,
									  min: 0
									},{
									  name:     'Base',
									  property:   'flex-basis',
									  type:     'integer',
									  units:    ['px','%',''],
									  unit: '',
									  defaults :  'auto',
									}],
							},{
								name      : 'Alinear',
								property  : 'align-self',
								type      : 'radio',
								defaults  : 'auto',
								list    : [
									{
										value   : 'auto',
										name    : 'Auto',
									},{
										value   : 'flex-start',
										title    : 'Start',
										className : 'icons-flex icon-al-start',
									},{
										value   : 'flex-end',
										title    : 'End',
										className : 'icons-flex icon-al-end',
									},{
										value   : 'stretch',
										title    : 'Stretch',
										className : 'icons-flex icon-al-str',
									},{
										value   : 'center',
										title    : 'Center',
										className : 'icons-flex icon-al-center',
									}
								],
							}
						]
					}
				],
			},
			'grapesjs-lory-slider': {
				sliderBlock: {
					category: 'Extra'
				}
			},
			'grapesjs-tabs': {
				tabsBlock: {
					category: 'Extra'
				}
			},
			'grapesjs-navbar': {
				tabsBlock: {
					category: 'Extra'
				}
			},
		},
	}
};

const editor = grapesjs.init({
	container : '#gjs',
	components: html_original,
	style: `<?php echo ($page_info->style); ?>`,
	fromElement: true,
	plugins: options_api.editor.plugins,
	pluginsOpts: options_api.editor.pluginsOpts,
	canvas: {
		styles: [
			'<?php echo $website->get_assets_global(); ?>css/font-awesome.min.css',
			'<?php echo $website->get_assets_global(); ?>../libs/bootstrap/v3/css/bootstrap.css',
			'<?php echo $website->get_assets_folder(); ?>css/style.css'
		],
		scripts: [
			'<?php echo $website->get_assets_global(); ?>js/jquery-1.11.1.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js',
			'<?php echo $website->get_assets_global(); ?>../libs/bootstrap/v3/js/bootstrap.min.js'
		],
	},
	height: 'calc(100vw)',
	width: 'auto',
	storageManager: { type: null },
	panels: { defaults: [] },
	assetManager: {
		embedAsBase64: 1,
		assets: images
	},
	styleManager: { clearProperties: 0 },
	showOffsets: 0,
	noticeOnUnload: 0,
});

/*
storageManager: {
	type: 'remote',
	urlStore: 'http://store/endpoint',
	urlLoad: 'http://load/endpoint',
	params: {
		content: editor.getCss(),
		style: 'Estilo CSS'
	},
}
	
const storageManager = editor.StorageManager;

storageManager.add('local2', {
  load: function(keys, clb, clbErr) {
	var res = {};
	for (var i = 0, len = keys.length; i < len; i++){
	  var v = localStorage.getItem(keys[i]);
	  if(v) res[keys[i]] = v;
	}
	clb(res); // might be called inside some async method
	// In case of errors...
	// clbErr('Went something wrong');
  },
  store: function(data, clb, clbErr) {
	for(var key in data)
	  localStorage.setItem(key, data[key]);
	clb(); // might be called inside some async method
  }
});
*/

var pn = editor.Panels;
var modal = editor.Modal;
var cmdm = editor.Commands;

// Crear comando editar codigo
cmdm.add('html-edit', {
	run: function(editor, sender) {
		sender && sender.set('active', 0);
		var viewer = codeViewer.editor;
		modal.setTitle('Editar codigo');
		if (!viewer) {
			var txtarea = document.createElement('textarea');
			container.appendChild(txtarea);
			container.appendChild(btnEdit);
			codeViewer.init(txtarea);
			viewer = codeViewer.editor;
		}
		var InnerHtml = editor.getHtml();
		var Css = editor.getCss();
		modal.setContent('');
		modal.setContent(container);
		codeViewer.setContent(InnerHtml + "<style>" + Css + '</style>');
		modal.open();
		viewer.refresh();
	}
});

// Crear comando limpiar lienzo
cmdm.add('canvas-clear', function() {
	if(confirm('¿Estás seguro de limpiar el lienzo?')) {
		var comps = editor.DomComponents.clear();
		setTimeout(function(){ localStorage.clear()}, 0)
	}
});

// Crear comando vista ordenador
cmdm.add('set-device-desktop', {
	run: ed => ed.setDevice('Desktop'),
	stop() {},
});

// Crear comando vista tablet
cmdm.add('set-device-tablet', {
	run: ed => ed.setDevice('Tablet'),
	stop() {},
});

// Crear comando vista movil
cmdm.add('set-device-mobile', {
	run: ed => ed.setDevice('Mobile portrait'),
	stop() {},
});

// Informacion sobre grapesjs
var mdlClass = 'gjs-mdl-dialog-sm';
var infoContainer = document.getElementById('info-panel-editor');

// Crear comando sobre grapesjs
cmdm.add('open-info', function() {
	var mdlDialog = document.querySelector('.gjs-mdl-dialog');
	mdlDialog.className += ' ' + mdlClass;
	infoContainer.style.display = 'block';
	modal.setTitle('Acerca de COMASY');
	modal.setContent(infoContainer);
	modal.open();
	modal.getModel().once('change:open', function() {
		mdlDialog.className = mdlDialog.className.replace(mdlClass, '');
	})
});

// Crear boton Acerca de grapesjs
/*
pn.addButton('options', {
	id: 'open-info',
	className: 'fa fa-question-circle',
	command: function() { editor.runCommand('open-info') },
	attributes: {
		'title': 'Acerca de',
		'data-tooltip-pos': 'bottom',
	},
});
*/

// Crear boton guardado
cmdm.add('save-content', function() {
	console.log("Guardando contenido, por favor espere...");
	
	var temp_origin_html = `<?php echo ($page_info->content); ?>`;
	var temp_origin_style = `<?php echo ($page_info->style); ?>`;
	var temp_new_html = editor.getHtml();
	var temp_new_style = editor.getCss();
	
	api.put(options_api.record + '/<?php echo ($page_info->id); ?>', {
		id: <?php echo ($page_info->id); ?>,
		content: temp_new_html,
		style: temp_new_style
	}).then(function (response) {
		console.log(response.data);
		
		/// PENDIENTE
		api.post(options_api.record, {
			author: <?php echo ($website->session->id); ?>,
			title: '<?php echo ($page_info->title); ?>',
			type: 'revision',
			status: '',
			content: temp_new_html,
			style: temp_new_style
		}).then(function (response) {
			console.log(response.data);
			$.notify("La pagina se guardo con éxito.", "success");
		}).catch(function (error) {
			console.log(error);
			$.notify("Error guardando la revision de la pagina.", "error");
		});
		
	}).catch(function (error) {
		console.log(error);
		$.notify("Error guardando el contenido.", "error");
	});
});

// Crear boton guardado
pn.addButton('options', {
	id: 'save-content',
	className: 'fa fa-floppy-o',
	command: function() { editor.runCommand('save-content') },
	attributes: {
		'title': 'Guardar',
		'data-tooltip-pos': 'bottom',
	},
});

// Crear boton editar Codigo
var pfx = editor.getConfig().stylePrefix;
var codeViewer = editor.CodeManager.getViewer('CodeMirror').clone();
var container = document.createElement('div');
var btnEdit = document.createElement('button');
codeViewer.set({
	codeName: 'htmlmixed',
	readOnly: 0,
	theme: 'hopscotch',
	autoBeautify: true,
	autoCloseTags: true,
	autoCloseBrackets: true,
	lineWrapping: true,
	styleActiveLine: true,
	smartIndent: true,
	indentWithTabs: true
});
btnEdit.innerHTML = 'Edit';
btnEdit.className = pfx + 'btn-prim ' + pfx + 'btn-import';
btnEdit.onclick = function() {
	var code = codeViewer.editor.getValue();
	editor.DomComponents.getWrapper().set('content', '');
	editor.setComponents(code.trim());
	modal.close();
};

// Crear boton editar codigo
pn.addButton('options', [{
	id: 'edit',
	className: 'fa fa-edit',
	command: 'html-edit',
	attributes: {
		title: 'Editar Codigo',
		'data-tooltip-pos': 'bottom'
	}
}]);

// Crear boton cerrar editor
cmdm.add('close-editor', function() {
	window.location.replace('<?php echo $page_info->get_url(); ?>');
});

// Crear boton cerrar editor
pn.addButton('options', [{
	id: 'close-editor',
	className: 'fa fa-times',
	command: 'close-editor',
	attributes: {
		title: 'Cerrar',
		'data-tooltip-pos': 'bottom'
	}
}]);

// notificaciones sencillas
var origWarn = console.warn;

toastr.options = {
	closeButton: true,
	preventDuplicates: true,
	showDuration: 250,
	hideDuration: 150
};

console.warn = function (msg) {
	if (msg.indexOf('[undefined]') == -1) {
		toastr.warning(msg);
	}
	origWarn(msg);
};

// Otros botones
[
	['sw-visibility', 'Marcar Capas'], 
	['preview', 'Vista Previa'], 
	['fullscreen', 'Pantalla Completa'],
	['export-template', 'Exportar'], 
	['undo', 'Deshacer'], 
	['redo', 'Rehacer'],
	['gjs-open-import-webpage', 'Importar'], 
	['canvas-clear', 'Borrar Todo']
].forEach(function(item) {
	pn.getButton('options', item[0]).set('attributes', {title: item[1], 'data-tooltip-pos': 'bottom'});
});

[
	['open-sm', 'Estilo'], 
	['open-layers', 'Capas'], 
	['open-blocks', 'Componentes']
].forEach(function(item) {
	pn.getButton('views', item[0]).set('attributes', {title: item[1], 'data-tooltip-pos': 'bottom'});
});

var titles = document.querySelectorAll('*[title]');
for (var i = 0; i < titles.length; i++) {
	var el = titles[i];
	var title = el.getAttribute('title');
	title = title ? title.trim(): '';
	if(!title)
	  break;
	el.setAttribute('data-tooltip', title);
	el.setAttribute('title', '');
}

// Show borders by default
pn.getButton('options', 'sw-visibility').set('active', 1);
/*
  // Store and load events
  editor.on('storage:load', function(e) { console.log('Loaded ', e) });
  editor.on('storage:store', function(e) { console.log('Stored ', e) });
*/

// Crear comando editar codigo
editor.on('load', function() {
	var $ = grapesjs.$;
	
	// Load and show settings and style manager
	var openTmBtn = pn.getButton('views', 'open-tm');
	openTmBtn && openTmBtn.set('active', 1);
	var openSm = pn.getButton('views', 'open-sm');
	openSm && openSm.set('active', 1);

	// Add Settings Sector
	var traitsSector = $('<div class="gjs-sm-sector no-select">' + 
		'<div class="gjs-sm-title"><span class="icon-settings fa fa-cog"></span> Elemento Activo</div>' + 
	'<div class="gjs-sm-properties" style="display: none;"></div></div>');
	
	var traitsProps = traitsSector.find('.gjs-sm-properties');
	traitsProps.append($('.gjs-trt-traits'));
	$('.gjs-sm-sectors').before(traitsSector);
	
	traitsSector.find('.gjs-sm-title').on('click', function(){
		var traitStyle = traitsProps.get(0).style;
		var hidden = traitStyle.display == 'none';
		if (hidden) { traitStyle.display = 'block'; } 
		else { traitStyle.display = 'none'; }
	});
	
	// Open block manager
	var openBlocksBtn = editor.Panels.getButton('views', 'open-blocks');
	openBlocksBtn && openBlocksBtn.set('active', 1);
	// Move Ad
	$('#gjs').append($('.ad-cont'));
});






</script>

<?php 

 } ?>

