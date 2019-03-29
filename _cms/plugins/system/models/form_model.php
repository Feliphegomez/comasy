<?php 

class FormDesign extends BaseClass
{
	function __construct($params=null)
		{
			$this->set_data($this->repair_data($params));
		}
	

	function get_html($cols = 'col-xs-6')
		{
			$h = '';
			foreach($this as $k => $v)
				{
					if(is_array($v))
						{
							if($v['active'] == true)
								{
									$h .= "<div class=\"form-group\">";
										$h .= "<div class=\"{$cols}\">";
											$h .= "<label for=\"first_name\"><h4>{$v['label']}</h4></label>";
											$h .= $this->create_intro($v);

											# $h .= "<label for=\"first_name\"><h4>{$this->array_labels[$k]}</h4></label>";
											# $h .= "<input value=\"{$this->{$v}}\" type=\"text\" class=\"form-control\" name=\"{$this->array_healthy[$k]}\" placeholder=\"{$this->array_labels[$k]}\">";
										$h .= "</div>";
									$h .= "</div>";
								}
						}
				}
			return $h;
		}
	
	function create_intro($data = null)
		{
			if(is_array($data))
				{
					switch($data['type'])
						{
							case 'text':
								return "<input value=\"{$data['value']}\" {$data['readonly']} {$data['disabled']} type=\"{$data['type']}\" class=\"{$data['class']}\" name=\"{$data['name']}\" id=\"{$data['id']}\" placeholder=\"{$data['placeholder']}\">";;
								break;
							case 'mail':
								return "<input value=\"{$data['value']}\" {$data['readonly']} {$data['disabled']} type=\"{$data['type']}\" class=\"{$data['class']}\" name=\"{$data['name']}\" id=\"{$data['id']}\" placeholder=\"{$data['placeholder']}\">";;
								break;
							case 'number':
								return "<input value=\"{$data['value']}\" {$data['readonly']} {$data['disabled']} type=\"{$data['type']}\" class=\"{$data['class']}\" name=\"{$data['name']}\" id=\"{$data['id']}\" placeholder=\"{$data['placeholder']}\">";;
								break;
							case 'password':
								return "<input value=\"{$data['value']}\" {$data['readonly']} {$data['disabled']} type=\"{$data['type']}\" class=\"{$data['class']}\" name=\"{$data['name']}\" id=\"{$data['id']}\" placeholder=\"{$data['placeholder']}\">";;
								break;
							case 'textarea':
								return "<textarea rows=\"6\" class=\"{$data['class']}\" id=\"{$data['id']}\" name=\"{$data['name']}\" {$data['readonly']} {$data['disabled']}>{$data['value']}</textarea>";;
								break;
							case 'select':
								$options = "";
								foreach($data['list'] as $option) 
									{
										if ((int) $option->id === (int) $data['value'])
											{
												$options .= "<option value=\"{$option->id}\" selected>{$option->name}</option>";
											}
										else 
											{
												$options .= "<option value=\"{$option->id}\" >{$option->name}</option>";
											}
									}
								return "<select class=\"{$data['class']}\" id=\"{$data['id']}\" name=\"{$data['name']}\" {$data['readonly']} {$data['disabled']}>{$options}</select>
								";
								break;
							case 'default':
								break;
						}
				}
		}
	
	function repair_data($data = null)
		{
			
			$data = (array) $data;
			$r =  array();
			
			foreach($data as $k => $v)
				{
					$r[$k] = array();
				
					if(is_array($v))
						{
										
							if(isset($v['value']))
								{
									if(isJSON($v['value']) == true) { $v['value'] = json_encode($v['value']); }
								}
								
							if(!isset($v['active'])){ $v['active'] = true; }
							if(!isset($v['id'])){ $v['id'] = ''; }
							if(!isset($v['label'])){ $v['label'] = ''; }
							if(!isset($v['type'])){ $v['type'] = ''; }
							if(!isset($v['name'])){ $v['name'] = ''; }
							if(!isset($v['key'])){ $v['key'] = ''; }
							if(!isset($v['value'])){ $v['value'] = ''; }
							if(!isset($v['readonly'])){ $v['readonly'] = ''; }
							if(!isset($v['disabled'])){ $v['disabled'] = ''; }
							if(!isset($v['class'])){ $v['class'] = 'form-control'; }
							if(!isset($v['placeholder'])){ $v['placeholder'] = $v['label']; }
							
								
							$r[$k] = $v;
								
						}
				}
			return $r;
		}
}