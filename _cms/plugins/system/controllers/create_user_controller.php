<?php 

global $info;
$info = new User();

if(isset($website->fields['form-userData-create'])) 
	{
		$info->create_by_form($website->fields);
	}
else if(count($website->fields) > 0)
	{
		echo "<hr>";
		echo "No Reconocido.";
		echo "<hr>";
	}


