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

