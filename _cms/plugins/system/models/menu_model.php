<?php 

class Menu extends BaseClass
{
	public $id, $title;
	public $nodes = array();
	
	public function __construct($menu_id_or_slug = 0)
		{
			$id_temp = (int) $menu_id_or_slug;
			$slug_temp = (string) $menu_id_or_slug;
			
			$this->load_by_slug($slug_temp);
		
			if($id_temp > 0 && $this->id == null)
				{
					$this->load_by_id($id_temp);
				}
			else 
				{
					$this->load_by_slug($slug_temp);
				}
		}
	
	public function load_by_slug($menu_slug = 'default')
		{
			try {
				$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$stmt = $pdo->prepare("SELECT `".TABLE_MENUS."`.*
					FROM `".TABLE_MENUS."` 
					WHERE `".TABLE_MENUS."`.`slug` IN ('{$menu_slug}')");			
				$pdo->exec("SET CHARACTER SET utf8; SET COLLATION SET utf8_unicode_ci");
				$stmt->execute([$menu_slug]);
				$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
				if(isset($result[0])) 
					{
						$this->set_data($result[0]);
						$this->id = (int) $this->id;
						$this->slug = (string) $this->slug;
						$nodes = new MenuNodes($this->id);
						$this->nodes = $nodes->nodes;
					}
				$pdo = null;
			}
			catch(PDOException $e) {
				# echo $e->getMessage();
				return false;
			}
		}

	public function load_by_id($menu_id = 0)
		{
			try {
				$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$stmt = $pdo->prepare("SELECT `".TABLE_MENUS."`.*
					FROM `".TABLE_MENUS."` 
					WHERE `".TABLE_MENUS."`.`id` IN ('{$menu_id}')");			
				$pdo->exec("SET CHARACTER SET utf8; SET COLLATION SET utf8_unicode_ci");
				$stmt->execute([$menu_id]);
				$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
				if(isset($result[0])) 
					{
						$this->set_data($result[0]);
						$nodes = new MenuNodes($this->id);
						$this->nodes = $nodes->nodes;
					}
				$pdo = null;
			}
			catch(PDOException $e) {
				# echo $e->getMessage();
				return false;
			}
		}
}

class ContentNode extends BaseClass 
{
	public $link = '';
	public $icon = '';
	public $class = '';
	public $style = '';
	public $target = '';
	
	public function __construct($data = null)
		{
			$data = (object) $data;
			foreach($data as $k => $v)
				{
					if(array_key_exists($k, $this) == true)
						{
							$this->{$k} = $v;
						}
				}
		}
}

class MenuNodes extends BaseClass 
{
	public $nodes = array();
	
	public function __construct($menu_id = 0)
		{
			$this->load_by_id($menu_id);
		}

	public function load_by_id($parent_id)
		{
			try {
				$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$stmt = $pdo->prepare("
					SELECT `contents`.`id`, `contents`.`title`, `contents`.`content`, `contents`.`parent` 
					FROM `contents` 
					WHERE `contents`.`status` IN ('item') 
						AND `contents`.`type` IN ('menu') 
						AND `contents`.`parent` IN (?) ");

				$stmt->execute([$parent_id]);
				$result = $stmt->fetchAll(PDO::FETCH_OBJ);
				
				foreach($result as $item)
					{
						$parent = new stdClass();
						$parent->id = $item->id;
						$parent->title = $item->title;
						$parent->content = new ContentNode(json_decode($item->content));
						$parent->parent = (int) $item->parent;
						$nodes = new MenuNodes($item->id);
						$parent->nodes = $nodes->nodes;
						
						$this->nodes[] = $parent;
					}
				
				$pdo = null; 
			}
			catch(PDOException $e) {
				# echo $e->getMessage();
				return false;
			}
		}
}

class Menus
	{
		public $data;
				
		function __construct()
			{
				try 
					{
						$sql = "SELECT `".TABLE_MENUS."`.* 
							FROM `".TABLE_MENUS."` ";
								
						$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
						$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$stmt = $pdo->prepare($sql);
						$pdo->exec("SET CHARACTER SET utf8; SET COLLATION SET utf8_unicode_ci");
						$stmt->execute();
						$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
						
						foreach($result as $item)
							{
								$this_menu = new Menu($item->slug);
								
								if(isset($this_menu->slug) && $this_menu->slug != null)
									{
										$this->data[] = $this_menu;
									}
							}
						$pdo = null;
					}
				catch(PDOException $e) 
					{
						echo $e->getMessage();
						return false;
					}
			}
	}

