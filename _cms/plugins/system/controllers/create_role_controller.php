<?php 

global $info;
$info = new Permission();

if(isset($website->fields['form-permissionData-create'])) 
	{
		$info->create_by_form($website->fields);
	}
else if(count($website->fields) > 0)
	{
		echo "<hr>";
		echo "No Reconocido.";
		echo "<hr>";
	}


