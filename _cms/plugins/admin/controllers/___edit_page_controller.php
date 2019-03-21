<?php 

$page_id = (int) $website->fields['page_id'];
if($page_id > 0)
{
	global $page_info;
	$page_info = new PageSingle($page_id);
}
