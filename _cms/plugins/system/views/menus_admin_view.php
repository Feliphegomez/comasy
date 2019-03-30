<?php 
global $menus;

$info_menus = $menus->data;

# echo json_encode($info_menus);

?>
<div class="main-page">
	<h2 class="title1">Menus</h2>
	<div class="blank-page widget-shadow scroll" id="style-2 div1">
		<ul class="nav nav-tabs">
			<?php 
			$i = 0;
			foreach($info_menus as $menu)
				{
					$class_text = ''; if($i == 0) { $class_text = 'active'; }
					
					echo "<li class=\"{$class_text}\">";
						echo "<a data-toggle=\"tab\" href=\"#menu{$i}\">";
						
							echo " {$menu->title}";
						echo "</a>";
					echo "</li>";
					$i++;
				}
			
				echo "<li class=\"\">";
					echo "<a href=\"javascript:COMASY.menus.create();\">";
						echo "<button class=\"btn btn-xs btn-success\"> <i class=\"fa fa-plus-circle\"></i> </button> ";

						echo " Agregar";
					echo "</a>";
				echo "</li>";
			
			?>
		</ul>

		<div class="tab-content">
			<?php 
			$i = 0;
			foreach($info_menus as $menu)
				{
					$class_text = ''; if($i == 0) { $class_text = 'active'; }
					
					echo "<div id=\"menu{$i}\" class=\"tab-pane fade in {$class_text}\">";
						echo "<br>";
							echo "<button class=\"btn btn-sm btn-success\" onclick=\"javascript:COMASY.menus.new_item('{$menu->id}');\"> <i class=\"fa fa-plus-circle\"></i> Agregar</button> ";
							echo "<button class=\"btn btn-sm btn-danger\" onclick=\"javascript:COMASY.menus.menu_delete('{$menu->id}');\"> <i class=\"fa fa-trash\"></i> Eliminar</button> ";
						echo "<hr>";
						$render = menu_admin_edit($menu);
						echo "<ul class=\"nav nav-pills nav-stacked\">";
							echo ($render);
						echo "</ul>";
					echo "</div>";
					$i++;
				}
			?>
		</div>
		
	</div>
</div>

