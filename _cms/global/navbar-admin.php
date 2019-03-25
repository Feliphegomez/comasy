<style>
@import url(https://fonts.googleapis.com/css?family=Montserrat);

#navbar-adminpanel svg {
    display: block;
    font: 13.5em 'Montserrat';
    width: 175px;
    height: 40px;
    /* margin: 0 auto; */
    margin: -13.5px auto -10px 10px;
}

#navbar-adminpanel address {
    margin: -15px -110px 3.5px -40px;
    font-style: normal;
    line-height: 1.42857143;
}

.text-copy {
    fill: none;
    stroke: white;
    stroke-dasharray: 6% 29%;
    stroke-width: 5px;
    stroke-dashoffset: 0%;
    animation: stroke-offset 5.5s infinite linear;
}

.text-copy:nth-child(1){
    stroke: #4D163D;
	animation-delay: -1;
}

.text-copy:nth-child(2){
	stroke: #840037;
	animation-delay: -2s;
}

.text-copy:nth-child(3){
	stroke: #BD0034;
	animation-delay: -3s;
}

.text-copy:nth-child(4){
	stroke: #BD0034;
	animation-delay: -4s;
}

.text-copy:nth-child(5){
	stroke: #FDB731;
	animation-delay: -5s;
}

@keyframes stroke-offset{
	100% {stroke-dashoffset: -35%;}
}

/* Style the navbar */
#navbar-adminpanel {
  overflow: hidden;
  background-color: #333;
  z-index: 99999;
}

/* Navbar links */
#navbar-adminpanel a {
  float: left;
  display: block;
  color: #ccc;
  text-align: center;
  padding: 5px;
  text-decoration: none;
  height: 35px;
}

/* Page content */
.content {
  padding: 16px;
}

/* The sticky class is added to the navbar with JS when it reaches its scroll position */
.sticky {
  position: fixed;
  top: 0;
  width: 100%;
}

/* Add some top padding to the page content to prevent sudden quick movement (as the navigation bar gets a new position at the top of the page (position:fixed and top:0) */
.sticky + .content {
  padding-top: 60px;
}
</style>

<div id="navbar-adminpanel">
	<a href="#">
		<svg viewBox="0 0 960 300">
			<symbol id="s-text">
				<text text-anchor="middle" x="50%" y="80%">COMASY </text>
			</symbol>
			
			<g class = "g-ants">
				<use xlink:href="#s-text" class="text-copy"></use>
				<use xlink:href="#s-text" class="text-copy"></use>
				<use xlink:href="#s-text" class="text-copy"></use>
				<use xlink:href="#s-text" class="text-copy"></use>
				<use xlink:href="#s-text" class="text-copy"></use>
			</g>
		</svg>
		<!--<address>By FelipheGomez</address>-->
	</a>
	<a href="<?php echo $this->options->admin_path; ?>">Admin Panel</a>
	<?php
		if($this->page->plugin == 'pages' && $this->page->module == 'single' && $this->page->section == 'view' && (int) $this->page->id_route > 0)
			{
				echo "<a href=\"".HOME_PATH."pages/edit/?page_id={$this->page->id_route}\">Editar página</a>";
			}
	?>
</div>