<header>
	<ul id="menu">
		<li>
			<input id="check02" type="checkbox" name="menu" />
			<label for="check02"><span class="fa fa-bars" aria-hidden="true"></span></label>
			<ul class="submenu">
				<?php 
					$menu = new Menu('sitemenu');
					$html_sidebar = menu_render_simple($menu);
					echo $html_sidebar;
				?>
			</ul>
		</li>
	</ul>
</header>