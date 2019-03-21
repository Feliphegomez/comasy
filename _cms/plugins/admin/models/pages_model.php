<?php 
global $website;

if($website->permissionIs('page_edit') !== true) 
	{
		class PageSingle extends BaseClass
		{
			var $id = 0;
			
		   public function __construct($id = 0)
		   {
				$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $pdo->prepare("SELECT `contents`.*
				FROM `contents` 
				WHERE 
					`contents`.`status` IN ('publish') 
					AND `contents`.`ping_status` IN ('open') 
					AND `contents`.`type` IN ('page') 
					AND `contents`.`id` = ?");
				
				$pdo->exec("SET CHARACTER SET utf8; SET COLLATION SET utf8_unicode_ci");
				$stmt->execute([$id]);
				$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
				if(isset($result[0])){
					$resultOne = (object) $result[0];
					$this->setData($resultOne);
				}
		   }
		}
	}
else 
	{
		
		class PageSingle extends BaseClass
		{
			var $id = 0;
			
		   public function __construct($id = 0)
		   {
				$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$stmt = $pdo->prepare("SELECT `contents`.*
				FROM `contents` 
				WHERE 
					`contents`.`type` IN ('page') 
					AND `contents`.`id` = ?");	
				
				$pdo->exec("SET CHARACTER SET utf8; SET COLLATION SET utf8_unicode_ci");
				$stmt->execute([$id]);
				$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
				if(isset($result[0])){
					$resultOne = (object) $result[0];
					$this->setData($resultOne);
				}
		   }
		}
		
	}