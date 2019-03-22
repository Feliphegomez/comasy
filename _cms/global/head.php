
<!-- Bootstrap-Core-CSS -->
<link href="<?php echo $website->get_assets_global(); ?>../libs/bootstrap/v3/css/bootstrap.css" rel="stylesheet"/>

<!-- Icons -->
<link href="<?php echo $website->get_assets_global(); ?>css/font-awesome.min.css" rel="stylesheet">

<!-- Style-CSS -->
<link rel="stylesheet" href="<?php echo $website->get_assets_folder(); ?>css/style.css" type="text/css" media="all" />

<!-- js-->
<script src="<?php echo $website->get_assets_global(); ?>js/jquery-1.11.1.min.js"></script>
<!--<script src="<?php echo $website->get_assets_global(); ?>../libs/bootstrap/v3/js/bootstrap.min.js"></script> -->


<!-- // ----- GrapesJS -------- -->
<!-- // Grapes -->
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
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap-theme.min.css">

<script>
var api = axios.create({
	baseURL: '/api'
});


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


</script>

<style>
	/*
		article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary { display: contents; }
	*/

</style>
<style>
/*

.gjs-editor { background: transparent !important; }
.gjs-dashed { background: transparent !important; }
.gjs-cv-canvas { background: transparent !important; }

#gjs {
	border: none;
}

.gjs-one-bg {
	/* background-color: #78366a; */
}

.gjs-two-color {
	color: rgba(255, 255, 255, 0.6);
}

.gjs-three-bg {
	background-color: #ec5896;
	color: white;
}

.gjs-four-color,
.gjs-four-color-h:hover {
	/* color: #ec5896; */
	color: rgba(255, 255, 255, 0.6);
}
*/
</style>