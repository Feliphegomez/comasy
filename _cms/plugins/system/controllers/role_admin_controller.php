<?php 

$id = (int) $website->page->id_route;
global $info;

if($id > 0) 
	{
		$temp = new stdClass();
		$temp->id = $id;
		
		$info = new Permission($id);
	}
else if(isset($website->fields['role_id'])) 
	{
		$temp = new stdClass();
		$temp->id = (int) $website->fields['role_id'];
		if($temp->id > 0) 
			{
				$info = new Permission($temp);
			}
	}
else if(isset($website->fields['permissionData-id'])) 
	{		
		$temp = new stdClass();
		$temp->id = (int) $website->fields['permissionData-id'];
		if($temp->id > 0) 
			{
				$info = new Permission($temp);
				$info->update_by_form($website->fields);
			}
	}
else 
	{
		echo "<hr>";
		echo "Rol No Reconocido.";
		echo "<hr>";
		echo json_encode($website);
	}


