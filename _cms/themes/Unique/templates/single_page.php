<?php global $website, $page_info; ?>
<style lang="css" scope="post" id="style-post"></style>
<style lang="css" scope="post-edit" id="style-post-edit"></style>

<?php 
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
<div>
	<div id="app">
		<div>
			<div id="" class="<?php echo $classActive; ?> he-codes">
				<router-view class=""></router-view>
				<?php $website->get_includes('footer.php'); ?>
			</div>
		</div>
		
		<div style="display: nones">
			<div class="gjs-logo-cont">
				<a href="//grapesjs.com">
					<!-- // <img class="gjs-logo" src="https://grapesjs.com/img/grapesjs-logo-cl.png"> -->
				</a>
				<div class="gjs-logo-version"></div>
			</div>
		</div>
		
		
		<div class="ad-cont">ADS</div>

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
	</div>
</div>


<style lang="css" scope="post-list" id="style-post-list">

</style>
<template id="post-list">
	<div>	
		<div class="blank-page widget-shadow scroll" id="style-2 div1">
			<h2 class="title1">Todas las página</h2>
			<div class="filters row">
				<div class="form-group col-sm-9">
					<label for="search-element">Filter</label>
					<input v-model="searchKey" class="form-control" id="search-element" required/>
				</div>
				<div class="form-group col-sm-3">
					<br>
					<router-link class="btn btn-default" v-bind:to="{path: '/add-post'}">
						<span class="glyphicon glyphicon-plus"></span>
					</router-link>
				</div>
			</div>
			<hr>
			
			<!-- Nav pills -->
			<ul class="nav nav-pills" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" data-toggle="pill" href="#home">Publicados</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="pill" href="#menu1">Menu 1</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="pill" href="#menu2">Menu 2</a>
				</li>
			</ul>
			
			<!-- Tab panes -->
			<div class="tab-content">
				<div id="home" class="tab-pane active">
					<div class="bs-example widget-shadow table-responsive" data-example-id="dataTable">
						<table class="table table-hover" id="dataTable">
							<thead>
								<tr>
									<th>Titulo</th>
									<th>Estado</th>
									<th>Ping Estado</th>
									<th>F. Creación</th>
									<th>U. Modificación</th>
									<th>E. Comentarios</th>
									<th>#. Comentarios</th>
									<th class="col-sm-2">Actions</th>
								</tr>
							</thead>
							<tbody>
								<tr v-if="posts===null">
									<td colspan="4">Loading...</td>
								</tr>
								<tr v-else v-for="post in filteredposts">
									<td>
										<router-link v-bind:to="{name: 'post', params: {post_id: post.id}}">
											{{ post.title }}
										</router-link>
									</td>
									<td>{{ post.status }}</td>
									<td>{{ post.ping_status }}</td>
									<td>{{ post.date }}</td>
									<td>{{ post.modified }}</td>
									<td>{{ post.comment_status }}</td>
									<td>{{ post.comment_count }}</td>
									<td>
										<router-link class="btn btn-warning btn-xs" v-bind:to="{name: 'post-edit', params: {post_id: post.id}}">Edit</router-link>
										<router-link class="btn btn-danger btn-xs" v-bind:to="{name: 'post-delete', params: {post_id: post.id}}">Delete</router-link>
									</td>
								</tr>
							</tbody>
						</table>
					</div>

				</div>
				<div id="menu1" class="container tab-pane fade"><br>
					<h3>Menu 1</h3>
					<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				</div>
				<div id="menu2" class="container tab-pane fade"><br>
					<h3>Menu 2</h3>
					<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
				</div>
			</div>
		</div>
	</div>
</template>

<template id="post" class="">
	<div>
		
		<?php if($website->permissionIs('page_edit') == true){ ?>
			<nav class="navbar sticky-top navbar-dark bg-dark text-white" style="position: fixed; right: 35px; bottom: 35px; top: auto;">
				<router-link class="navbar-brand" v-bind:to="{name: 'post-edit', params: {post_id: post.id}}">
					<i class="fa fa-edit"></i>
					Editar Página
				</router-link>
			</nav>
		<?php } ?>

		<div class="row">
			<div class="col-sm-12">			
				<div class="" v-html="post.content">
					{{ post.content }}
				</div>
			</div>
		</div>
	</div>
</template>

<template id="post-edit">
	<div>
		<div class="" id="gjs">
			<div class="" v-html="post.content">
				{{ post.content }}
			</div>
		</div>
		
		
		<!-- //
		<router-link tag="button" v-bind:to="'/'" class="btn btn-lg btn-secondary btn-float">
			<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
			Volver
		</router-link>
		
		<h2>Edit post</h2>
		<form v-on:submit="updatepost">
			<div class="form-group">
				<label for="edit-content">Content</label>
				<textarea class="form-control" id="edit-content" rows="3" v-model="post.content"></textarea>
			</div>
			<button type="submit" class="btn btn-primary">Save</button>
			<router-link class="btn btn-default" v-bind:to="'/'">Cancel</router-link>
		</form>
		-->
	</div>
</template>

<template id="post-delete">
	<div>
		<router-link tag="button" v-bind:to="'/'" class="btn btn-lg btn-secondary">
			<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
			Volver
		</router-link>
		
		<h2 class="title1">Eliminar Pagina # {{ post.id }}</h2>
		<form v-on:submit="deletepost">
			<p>La acción no se puede deshacer.</p>
			<button type="submit" class="btn btn-danger">Eliminar</button>
			<router-link class="btn btn-default" v-bind:to="'/'">Cancelar</router-link>
		</form>
	</div>
</template>


<!-- popup-->
<div id="gal1" class="pop-overlay animate">
	<div class="popup">
		<img src="http://cms.ltsolucion.com/_cms/themes/Unique/images/g1.jpg" alt="Popup Image" class="img-fluid" />
		<h1 class="mt-4">Nulla viverra pharetra se, eget pulvinar neque pharetra ac int. placerat placerat dolor.</h1>
		<a class="close" href="#gallery">&times;</a>
	</div>
</div>
<!-- //popup -->
<!-- popup-->
<div id="gal2" class="pop-overlay animate">
	<div class="popup">
		<img src="http://cms.ltsolucion.com/_cms/themes/Unique/images/g2.jpg" alt="Popup Image" class="img-fluid" />
		<h2 class="mt-4">Nulla viverra pharetra se, eget pulvinar neque pharetra ac int. placerat placerat dolor.</h2>
		<a class="close" href="#gallery">&times;</a>
	</div>
</div>
<!-- //popup -->
<!-- popup-->
<div id="gal3" class="pop-overlay animate">
	<div class="popup">
		<img src="http://cms.ltsolucion.com/_cms/themes/Unique/images/g3.jpg" alt="Popup Image" class="img-fluid" />
		<p class="mt-4">Nulla viverra pharetra se, eget pulvinar neque pharetra ac int. placerat placerat dolor.</p>
		<a class="close" href="#gallery">&times;</a>
	</div>
</div>
<!-- //popup3 -->
<!-- popup-->
<div id="gal4" class="pop-overlay animate">
	<div class="popup">
		<img src="http://cms.ltsolucion.com/_cms/themes/Unique/images/g4.jpg" alt="Popup Image" class="img-fluid" />
		<p class="mt-4">Nulla viverra pharetra se, eget pulvinar neque pharetra ac int. placerat placerat dolor.</p>
		<a class="close" href="#gallery">&times;</a>
	</div>
</div>
<!-- //popup -->
<!-- popup-->
<div id="gal5" class="pop-overlay animate">
	<div class="popup">
		<img src="http://cms.ltsolucion.com/_cms/themes/Unique/images/g5.jpg" alt="Popup Image" class="img-fluid" />
		<p class="mt-4">Nulla viverra pharetra se, eget pulvinar neque pharetra ac int. placerat placerat dolor.</p>
		<a class="close" href="#gallery">&times;</a>
	</div>
</div>
<!-- //popup -->
<!-- popup-->
<div id="gal6" class="pop-overlay animate">
	<div class="popup">
		<img src="http://cms.ltsolucion.com/_cms/themes/Unique/images/g6.jpg" alt="Popup Image" class="img-fluid" />
		<p class="mt-4">Nulla viverra pharetra se, eget pulvinar neque pharetra ac int. placerat placerat dolor.</p>
		<a class="close" href="#gallery">&times;</a>
	</div>
</div>

<script>
var lp = '//grapesjs.com/img/';
var plp = '//placehold.it/350x250/';

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
			'grapesjs-lory-slider': {
				sliderBlock: {
					category: 'Sliders'
				}
			},
			'grapesjs-tabs': {
				tabsBlock: {
					category: 'Tabs'
				}
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
					//blocks: ['link-block', 'quote', 'image', 'video', 'text', 'column1', 'column2', 'column3'],
					flexGrid: 1
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
			'grapesjs-navbar': {
				tabsBlock: {
					category: 'Barras de navegacion'
				}
			},
		},
		
	}
};

var List = Vue.extend({
	template: '#post-list',
	data: function () {
		return {
			posts: [],
			searchKey: ''
		};
	},
	mounted: function () {
		var self = this;
		
		api.get(options_api.record, {
			params: {
				filter: options_api.list_filters
			}
		}).then(function (response) {
			self.posts = response.data.records;
			
			
		}).catch(function (error) {
			console.log(error);
		});
	},
	computed: {
		filteredposts: function () {
			return this.posts.filter(function (post) {
				return this.searchKey=='' || post[options_api.list_search_field].indexOf(this.searchKey) !== -1;
			},this);
		}
	}
});

var post = Vue.extend({
	template: '#post',
	data: function () {
		return {
			post: {
				id: 0,
				author: 0,
				date: "",
				content: "",
				style: "",
				title: "",
				status: "",
				comment_status: "",
				ping_status: "",
				modified: "",
				content_filtered: "",
				parent: 0,
				type: "",
				mime_type: "",
				comment_count: 0
			}
		};
	},
	methods: {
		findpost: function(){
			var self = this;
			
			api.get(options_api.record , {
				params: {
					filter: [
						'id,eq,<?php echo ($page_info->id); ?>',
						'type,eq,page',
						'status,eq,publish',
						'ping_status,eq,open'
					]
				}
			}).then(function (response) {
				if(response.data.records[0] != undefined)
					{
						self.post = response.data.records[0];
					}
				else 
					{
						console.log(response);
					}
				
				$("#style-post").html(self.post.style);
			}).catch(function (error) {
				console.log(error);
			});
		}
	},
	mounted: function(){
		var self = this;
		self.findpost();
	},
	beforeRouteLeave(to, from, next) {
		$("#style-post").html('');
		next();
	}
});

<?php if($website->permissionIs('page_edit') == true){ ?>
var postEdit = Vue.extend({
	template: '#post-edit',
	data: function () {
		return {
			post: {
				id: 0,
				author: 0,
				date: "",
				content: "",
				style: "",
				title: "",
				status: "",
				comment_status: "",
				ping_status: "",
				modified: "",
				content_filtered: "",
				parent: 0,
				type: "",
				mime_type: "",
				comment_count: 0
			}
		};
	},
	methods: {
		updatepost: function () {
			var self = this;
			
			api.put(options_api.record + '/' + self.post.id, self.post).then(function (response) {
				console.log(response.data);
				//router.push('/post/' + self.post.id);
				alert('guardado');
			}).catch(function (error) {
				console.log(error);
			});
		},
		findpost: function(){
			var self = this;
			
			api.get(options_api.record + '/<?php echo ($page_info->id); ?>', {
				params: {
					filter: options_api.list_filters
				}
			}).then(function (response) {
				self.post = response.data;
				
				$("#style-post-edit").html(self.post.style);
				// $("#style-post-edit").html('@import url("<?php echo $website->get_assets_folder(); ?>css/style.css"); ' + self.post.style);
				
				self.loadEditor();
			}).catch(function (error) {
				console.log(error);
			});
		},
		loadEditor: function(){
			var self = this;
			
			const editor = grapesjs.init({
				container: '#gjs',
				components: self.post.content,
				fromElement: false,
				height: 'calc(100vw)',
				width: 'auto',
				storageManager: { type: null, autoload: 0 },
				panels: {
					defaults: []
				},
				plugins: options_api.editor.plugins,
				style: self.post.style,
				assetManager: {
					embedAsBase64: 1,
					assets: images
				},
				styleManager: { clearProperties: 1 },
				pluginsOpts: options_api.editor.plugins,
				showOffsets: 1,
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
			
				self.post.content = editor.getHtml();
				self.post.style = editor.getCss();
				
				self.updatepost();
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
				window.location.hash = '#/';
				window.location.reload();
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
					'<div class="gjs-sm-title"><span class="icon-settings fa fa-cog"></span> Settings</div>' + 
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
			
		}
	},
	mounted: function(){
		var self = this;
		self.findpost();
	},
	beforeRouteLeave(to, from, next) {
		$("#style-post-edit").html('');
		next();
	}
});
<?php } ?>
	

var postDelete = Vue.extend({
	template: '#post-delete',
	data: function () {
		return {
			post: {
				id: this.$route.params.post_id,
				author: 0,
				date: "",
				content: "",
				style: "",
				title: "",
				status: "",
				comment_status: "",
				ping_status: "",
				modified: "",
				content_filtered: "",
				parent: 0,
				type: "",
				mime_type: "",
				comment_count: 0
			}
		};
	},
	methods: {
		deletepost: function () {
			var post = this.post;
			api.delete(options_api.record + '/' + post.id).then(function (response) {
				console.log(response.data);
			}).catch(function (error) {
				console.log(error);
			});
			router.push('/');
		}
	}
});

var router = new VueRouter({routes:[
	{ path: '/', component: post, name: 'post'},
	
	<?php if($website->permissionIs('page_edit') == true){ ?>
	{ path: '/edit', component: postEdit, name: 'post-edit'},
	<?php } ?>
	
	// { path: '/:post_id', component: post, name: 'post'},
	// { path: '/post/:post_id/edit', component: postEdit, name: 'post-edit'},
	// { path: '/post/:post_id/delete', component: postDelete, name: 'post-delete'},
	
	// { path: '/alls', component: List},	
	// { path: '/', component: List},	
]});

app = new Vue({
	router:router
}).$mount('#app');
</script>

<?php if($website->permissionIs('page_edit') == true){ ?>
<?php } ?>

