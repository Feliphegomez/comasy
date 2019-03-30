<?php 

function errorsJson($string) {
	@json_decode($string);
	return (json_last_error() == JSON_ERROR_NONE);
}

function foreach_tree($array = null)
	{
		$r = array();
		foreach($array As $key1 => $val1)
			{
				if(errorsJson($val1) === 0 && $val1 !== '' && $val1 !== null)
				{
					$val1 = json_decode($val1);
				}
			
				$i = new stdClass();
				$i->name = $key1;
				$i->type = 'none';
				$i->value = $val1;
				$i->nodes = array();
				
				if(is_array($val1) == true)
					{
						$i->type = 'list';
						$i->nodes = foreach_tree($val1);
					}
				else if(is_object($val1) == true)
					{
						$i->type = 'details';
						$i->nodes = foreach_tree($val1);
					}
				else 
					{
						$i->type = 'item';
						
						if(errorsJson($val1) === 0 && $val1 !== '' && $val1 !== null)
						{
							$i->nodes = foreach_tree($val1);
						}
					}
				$r[] = $i;
			}
		return $r;
	}

function render_tree_table_html($array = null, $class = 'table table-responsive table-bordered')
	{
		$html = "<table class=\"{$class}\">";
		
		foreach($array as $k=>$v)
			{
				$k++;
				if(is_array($v) == true)
					{
						#$html .= "<td>";
								$html .= render_tree_table_html($v);
						#$html .= "</td>";
					}
				else 
					{
							$html .= "<td><b>{$v}</b></td>";
					}
			}
		$html .= "</table>";
		
		return $html;
	}

function tree_table($array = null)
	{
		$table = array();
		foreach($array as $k => $i_a)
			{
				$tr = array();
				if($i_a->type == 'item')
					{
						$tr[] = $i_a->name;
						$tr[] = $i_a->value;
					}
				else if($i_a->type == 'list' || $i_a->type == 'details')
					{
						if(count($i_a->nodes) > 0)
						{
							$tr[] = $i_a->name;
							$tr[] = tree_table($i_a->nodes);
						}
					}
				$tr = array_filter($tr);
				$table[] = $tr;
			}
				$table = array_filter($table);
		return render_tree_table_html($table);
	}

function strip_tags_content($text, $tags = '', $invert = FALSE)
	{
		preg_match_all('/<(.+?)[\s]*\/?[\s]*>/si', trim($tags), $tags);
		$tags = array_unique($tags[1]);
		if(is_array($tags) AND count($tags) > 0) 
			{ 
				if($invert == FALSE) 
					{ 
						return preg_replace('@<(?!(?:'. implode('|', $tags) .')\b)(\w+)\b.*?>.*?</\1>@si', '', $text); 
					} 
				else 
				{ 
					return preg_replace('@<('. implode('|', $tags) .')\b.*?>.*?</\1>@si', '', $text); 
				} 
			} 
		elseif($invert == FALSE) 
			  { 
					return preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $text); 
			  } 
		return $text; 
	}

function rip_tags($string) 
	{
		// ----- remove HTML TAGs ----- 
		$string = preg_replace ('/<[^>]*>/', ' ', $string); 
		
		// ----- remove control characters ----- 
		$string = str_replace("\r", '', $string);    // --- replace with empty space
		$string = str_replace("\n", ' ', $string);   // --- replace with space
		$string = str_replace("\t", ' ', $string);   // --- replace with space
		
		// ----- remove multiple spaces ----- 
		$string = trim(preg_replace('/ {2,}/', ' ', $string));
		
		return $string;
	}

function menu_render_sidebar($nodes = null, $child = false)
	{
		global $website;
		$h = '';
		
		if($child == true) { $tree_class = "treeview"; } else { $tree_class = ''; };
		
		foreach($nodes->nodes as $item)
		{
			if(count($item->nodes) == 0)
				{
					$h .= "<li class=\"{$tree_class}\">
						<a href=\"{$website->site_url}{$item->content->link}\">
							<i class=\"{$item->content->icon}\"></i> 
							<span>{$item->title}</span>
						</a>
					</li>";
				}
			else 
				{
					$h .= "<li class=\"{$tree_class}\">
						<a href=\"{$item->content->link}\">
							<span>{$item->title}</span>
							<i class=\"{$item->content->icon} pull-right\"></i>
						</a>
						<ul class=\"treeview-menu\">";
							$h .= menu_render_sidebar($item, true);
							$h .= "
						</ul>
					</li>";
				}
		}
		return $h;
	};

function menu_render_simple($nodes = null)
	{
		global $website;
		$h = '';
		
		foreach($nodes->nodes as $item)
		{
			if(count($item->nodes) == 0)
				{
					$h .= "<li><a href=\"{$website->site_url}{$item->content->link}\">{$item->title}</a></li>";
				}
			else 
				{
					$h .= "<li><a href=\"{$website->site_url}{$item->content->link}\">{$item->title}</a></li>";
					
					#$h .= menu_render_simple($item);
				}
		}
		return $h;
	};

function isJSON($string){
	$rr = false;
	# return is_string($string) && is_array(json_decode($string, true)) ? true : false;
	# return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
	#$string = (object) $string;
	# $dd_1 = @json_decode(@json_encode(@json_decode($string, true), true), true);
	# $dd_2 = @json_decode($string, true);
	$dd_1 = json_encode(is_string($string) && is_array(json_decode($string, true)) ? true : false);
	$dd_2 = json_encode((json_last_error() == JSON_ERROR_NONE) ? true : false);
	
	$is_string = (is_string($string));
	$is_array = (is_array(@json_decode($string, true)));
	$is_json = ((json_last_error() == JSON_ERROR_NONE) ? true : false);
	
	if(
		$is_string == false
		&& $is_array == false
		&& $is_json == true
	)
		{
			$rr = true;
		}
		# echo json_encode($string)."<br>";
		# echo "is_string: {$is_string}<br>";
		# echo "is_array: {$is_array}<br>";
		# echo "is_json: {$is_json}<br>";
	return $rr;
}

function menu_admin_edit($nodes = null, $child = false, $margin = 0)
	{
		global $website;
		$h = '';
		
		if($child == true) { $tree_class = "nav nav-pills nav-stacked"; } else { $tree_class = 'dropdown'; };
		
		$i = 0;
		foreach($nodes->nodes as $item)
			{
				$h .= "<li class=\"{$tree_class}\">";
					$h .= "<button class=\"btn btn-success\" onclick=\"javascript:COMASY.menus.new_item('{$item->id}');\"> <i class=\"fa fa-plus-circle\"></i> </button>";
					$h .= "<button class=\"btn  dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\"> <i class=\"{$item->content->icon}\"></i> {$item->title} <span class=\"caret\"></span></button>";
					$h .= "<ul class=\"dropdown-menu\">";
						$h .= "<li><a href=\"javascript:COMASY.menus.edit_item({$item->id});\"> <i class=\"fa fa-edit\"></i> Editar </a></li>";
						$h .= "<li><a href=\"javascript:COMASY.menus.delete_item({$item->id});\"> <i class=\"fa fa-trash\"></i> Eliminar</a></li>";
							
					$h .= "</ul>";
				$h .= "</li>";
					
						if(count($item->nodes) > 0)
							{
								$margin = $margin + 15;
								$h .= "<li style=\"margin-left: {$margin}px;\">";
									$h .= "<ul class=\"nav nav-pills nav-stacked\">";
										$h .= menu_admin_edit($item, true, $margin);
									$h .= "</ul>";
								$h .= "</li>";
							}
				$i++;
			}
					
					
					/*$h .= "<li class=\"\"><a href=\"javascript:COMASY.menus.new_item('{$item->parent}');\">
							<i class=\"fa fa-plus-circle\"></i> 
							<span>
								Agregar 
							</span>
						</a></li>";*/
			
			
		return $h;
	};
