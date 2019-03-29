<?php 

$id = (int) $website->page->id_route;
global $info;

if($id > 0) 
	{
		$user_temp = new stdClass();
		$user_temp->id = $id;
		
		$info = new User($id);
	}
else if(isset($website->fields['user_id'])) 
	{
		$user_temp = new stdClass();
		$user_temp->id = (int) $website->fields['user_id'];
		if($user_temp->id > 0) 
			{
				$info = new User($user_temp);
			}
	}
else if(isset($website->fields['userData-id'])) 
	{		
		$user_temp = new stdClass();
		$user_temp->id = (int) $website->fields['userData-id'];
		if($user_temp->id > 0) 
			{
				$info = new User($user_temp);
				$info->update_by_form($website->fields);
				
			}
	}
else 
	{
		$info = new User($id);
		echo "<hr>";
		echo "Usuario No Reconocido.";
		echo "<hr>";
	}


