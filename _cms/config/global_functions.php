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

