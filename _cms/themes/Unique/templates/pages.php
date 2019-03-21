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
				<router-view></router-view>
				<?php $website->get_includes('footer.php'); ?>
			</div>
		</div>
		
		<div style="display: none">
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

<template id="post-list">
	<div>
		<div class="container">
		
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
			<div class="row">
				<div class="col-md-4" v-if="posts===null">
					<h2>Cargando...</h2>
					<div class="product-item">
					  <div class="pi-img-wrapper">
						<img src="" class="img-responsive" alt="cargando...">
						<div>
						  <a href="#" class="btn">Zoom</a>
						  <a href="#" class="btn">View</a>
						</div>
					  </div>
					  <h3><a href="#">Cargando...</a></h3>
					  <div class="pi-price">$29.00</div>
					  <a href="#" class="btn add2cart">Add to cart</a>
					  <div class="sticker sticker-new"></div>
					</div>
				</div>				
				<div class="col-md-4" v-else v-for="post in filteredposts">
					<div class="product-item">
					  <div class="pi-img-wrapper">
						<!-- <img src="http://keenthemes.com/assets/bootsnipp/k2.jpg" class="img-responsive" alt=""> -->
						<div>
						  <!-- // <a href="#" class="btn">Zoom</a> -->
						  <a href="#" class="btn">View</a>
						</div>
					  </div>
					  <h3>
						<router-link tag="a" v-bind:to="{name: 'post', params: {post_id: post.id}}">
							{{ post.title }}
						</router-link>
					  </h3>
					  <div class="pi-price">{{ post.date }}</div>
					  
						<router-link class="btn add2cart" tag="a" v-bind:to="{name: 'post', params: {post_id: post.id}}">
							Leer Mas
						</router-link>
						
						<?php if($website->permissionIs('page_edit') == true){ ?>
							<router-link class="btn btn-warning btn-xs" v-bind:to="{name: 'post-edit', params: {post_id: post.id}}">Edit</router-link>
							<router-link class="btn btn-danger btn-xs" v-bind:to="{name: 'post-delete', params: {post_id: post.id}}">Delete</router-link>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<br>
		
	</div>
</template>

<template id="add-post">
	<div>
		<h2>Add new post</h2>
		<form v-on:submit="createpost">
			<div class="form-group">
				<label for="add-content">Content</label>
				<textarea class="form-control" id="add-content" rows="10" v-model="post.content"></textarea>
			</div>
			<button type="submit" class="btn btn-primary">Create</button>
			<router-link class="btn btn-default" v-bind:to="'/'">Cancel</router-link>
		</form>
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
		
		<div class="" v-html="post.content">
			{{ post.content }}
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


<style lang="css" scope="post-list" id="style-post-list">
body {
    background: #f1f1f1;
}

.product-item {
    padding: 15px;
    background: #fff;
    margin-top: 20px;
    position: relative;
}
.product-item:hover {
    box-shadow: 5px 5px rgba(234, 234, 234, 0.9);
}
.product-item:after {
    content: ".";
    display: block;
    height: 0;
    clear: both;
    visibility: hidden;
    font-size: 0;
    line-height:0;
}
.sticker {
    position: absolute;
    top: 0;
    left: 0;
    width: 63px;
    height: 63px;
}
.sticker-new {
    background: url(http://keenthemes.com/assets/bootsnipp/new.png) no-repeat;
    left: auto;
    right: 0;
}
.pi-img-wrapper {
    position: relative;
}
.pi-img-wrapper div {
    background: rgba(0,0,0,0.3);
    position: absolute;
    left: 0;
    top: 0;
    display: none;
    width: 100%;
    height: 100%;
    text-align: center;
}
.product-item:hover>.pi-img-wrapper>div {
    display: block;
}
.pi-img-wrapper div .btn {
    padding: 3px 10px;
    color: #fff;
    border: 1px #fff solid;
    margin: -13px 5px 0;
    background: transparent;
    text-transform: uppercase;
    position: relative;
    top: 50%;
    line-height: 1.4;
    font-size: 12px;
}
.product-item .btn:hover {
    background: #e84d1c;
    border-color: #c8c8c8;
}

.product-item h3 {
    font-size: 14px;
    font-weight: 300;
    padding-bottom: 4px;
    text-transform: uppercase;
}
.product-item h3 a {
    color: #3e4d5c;
}
.product-item h3 a:hover {
    color: #E02222;
}
.pi-price {
    color: #e84d1c;
    font-size: 18px;
    float: left;
    padding-top: 1px;
}
.product-item .add2cart {
    float: right;
    color: #a8aeb3;
    border: 1px #ededed solid;
    padding: 3px 6px;
    text-transform: uppercase;
}
.product-item .add2cart:hover {
	color: #fff;
	background: #e84d1c;
	border-color: #e84d1c;
}
</style>

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

function findpostKey(postId) {
	for (var key = 0; key < posts.length; key++) {
		if (posts[key].id == postId) {
			return key;
		}
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
		self.filterdata('publish');
	},
	computed: {
		filteredposts: function () {
			return this.posts.filter(function (post) {
				return this.searchKey=='' || post[options_api.list_search_field].indexOf(this.searchKey) !== -1;
			},this);
		}
	},
	methods: {
		filterdata: function(type_publish){
			var self = this;
			
			api.get(options_api.record, {
				params: {
					filter: [
						'type,eq,page',
						'status,eq,' + type_publish,
						'ping_status,eq,open'
					]
				}
			}).then(function (response) {
				self.posts = response.data.records;
				
			}).catch(function (error) {
				console.log(error);
			});
		}
	}
});

var post = Vue.extend({
	template: '#post',
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
		findpost: function(){
			var self = this;
			
			api.get(options_api.record, {
				params: {
					filter: [
						'id,eq,' + self.post.id,
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

var postEdit = Vue.extend({
	template: '#post-edit',
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
			
			api.get(options_api.record + '/' + self.post.id, {
				params: {
					filter: options_api.list_filters
				}
			}).then(function (response) {
				self.post = response.data;

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
				height: 'calc(85vw)',
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

			cmdm.add('canvas-clear', function() {
				if(confirm('¿Estás seguro de limpiar el lienzo?')) {
					var comps = editor.DomComponents.clear();
					setTimeout(function(){ localStorage.clear()}, 0)
				}
			});

			cmdm.add('set-device-desktop', {
				run: ed => ed.setDevice('Desktop'),
				stop() {},
			});
			  
			cmdm.add('set-device-tablet', {
				run: ed => ed.setDevice('Tablet'),
				stop() {},
			});

			cmdm.add('set-device-mobile', {
				run: ed => ed.setDevice('Mobile portrait'),
				stop() {},
			});

			// Add info command
			var mdlClass = 'gjs-mdl-dialog-sm';
			var infoContainer = document.getElementById('info-panel-editor');

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
			  
			pn.addButton('options', {
				id: 'open-info',
				className: 'fa fa-question-circle',
				command: function() { editor.runCommand('open-info') },
				attributes: {
					'title': 'Acerca de',
					'data-tooltip-pos': 'bottom',
				},
			});

			// ----------- buttom save
			cmdm.add('save-content', function() {
				console.log("Guardando contenido, por favor espere...");
			
				self.post.content = editor.getHtml();
				self.post.style = editor.getCss();
				
				self.updatepost();
			});
			
			pn.addButton('options', {
				id: 'save-content',
				className: 'fa fa-floppy-o',
				command: function() { editor.runCommand('save-content') },
				attributes: {
					'title': 'Guardar',
					'data-tooltip-pos': 'bottom',
				},
			});


			// Crear boton cerrar editor
			cmdm.add('close-editor', function() {
				window.location.hash = '#/' + self.post.id;
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
			// Simple warn notifier
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

			// Add and beautify tooltips
			[
				['sw-visibility', 'Mostrar las fronteras'], 
				['preview', 'Avance'], 
				['fullscreen', 'Pantalla completa'],
				['export-template', 'Exportar'], 
				['undo', 'Deshacer'], 
				['redo', 'Rehacer'],
				['gjs-open-import-webpage', 'Importar'], 
				['canvas-clear', 'Limpiar Lienzo']
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
		$("#style-post").html('');
		next();
	}
});

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

var Addpost = Vue.extend({
	template: '#add-post',
	data: function () {
		return {post: {content: '', user_id: 1, category_id: 1}}
	},
	methods: {
		createpost: function() {
			var post = this.post;
			api.post(options_api.record, post).then(function (response) {
				post.id = response.data;
			}).catch(function (error) {
				console.log(error);
			});
			router.push('/');
		}
	}
});

var router = new VueRouter({routes:[
	{ path: '/:post_id', component: post, name: 'post'},
	{ path: '/add-post', component: Addpost},
	{ path: '/post/:post_id/edit', component: postEdit, name: 'post-edit'},
	{ path: '/post/:post_id/delete', component: postDelete, name: 'post-delete'},
	
	{ path: '/alls', component: List},	
	{ path: '/', component: List},	
]});

app = new Vue({
	router:router
}).$mount('#app');
</script>