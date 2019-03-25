

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap-theme.min.css">
<!-- Bootstrap-Core-CSS -->
<!-- <link href="<?php echo $website->get_assets_global(); ?>../libs/bootstrap/v3/css/bootstrap.css" rel="stylesheet"/> -->

<!-- Style-CSS -->
<link rel="stylesheet" href="<?php echo $website->get_assets_folder(); ?>css/style.css" type="text/css" media="all" />

<!-- Icons -->
<link href="<?php echo $website->get_assets_global(); ?>css/font-awesome.min.css" rel="stylesheet">

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

<script>
var api = axios.create({
	baseURL: '/api'
});

var COMASY = {};
COMASY.pages = {};
COMASY.pages.changeOpenClosed = function(page_id, attribute, current){
    insert = 'none';
    if(current=='open' || current=='closed')
    {
        if(current=='open'){ current='closed'; } else if(current=='closed'){ current='open'; }
        insert=current;
        var temp = {};
        temp.id = page_id;
        temp[attribute] = insert;

	    api.put('/contents/' + temp.id, temp).then(function (response) {
		    alert('cambiado');
		    window.location.reload();
	    }).catch(function (error) {
		    console.log(error);
	    });

    }
};
</script>

<style>
/*
	article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary { display: contents; }

.gjs-editor { background: transparent !important; }
.gjs-dashed { background: transparent !important; }
.gjs-cv-canvas { background: transparent !important; }

#gjs {
	border: none;
}

.gjs-one-bg {
background-color: #78366a;
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
	color: rgba(255, 255, 255, 0.6);
}
*/
</style>
