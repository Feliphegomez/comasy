<?php 
global $website;
define('permissions_page_view', $website->permissionIs('page_view'));
define('permissions_page_edit', $website->permissionIs('page_edit'));


class Page extends BaseClass
{
	public $id, $author, $date, $title, $content, $style, $status, $comment_status, $ping_status, $pinged, $modified, $content_filtered, $parent, $type, $mime_type, $url;
	
	public function __construct($params = null)
		{
			$this->setData((object) $params);
		}

	public function set_data($params = null)
		{
			$this->setData((object) $params);
		}
	
	public function get_url()
		{
			if($this->url !== null && $this->url !== '')
				{
					return $this->url;
				}
			else 
				{
					return "/pages/{$this->id}";
				}
		}
}

class PageSingle extends Page
{
	public function __construct($id = 0)
		{
			$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$stmt = $pdo->prepare($this->get_sql());
			
			$pdo->exec("SET CHARACTER SET utf8; SET COLLATION SET utf8_unicode_ci");
			$stmt->execute([$id]);
			$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
			if(isset($result[0])) 
				{
					$this->set_data($result[0]);
				}
			else 
				{
					$this->content = "El contenido no fue encontrado o no tienes los permisos suficientes para acceder.";
				}
		}
	
	private function get_sql()
		{
			$sql_r = "
					SELECT `contents`.*, `routes`.`url` as `url`
						FROM `contents` 
					LEFT JOIN `routes` ON
						`contents`.`id` = `routes`.`id_route`
					WHERE 
						`contents`.`status` IN ('publish') 
						AND `contents`.`ping_status` IN ('open') 
						AND `contents`.`type` IN ('page') 
						AND `contents`.`id` = ?";
			if(permissions_page_edit == true) 
				{
			$sql_r = "
					SELECT `contents`.*, `routes`.`url` as `url`
						FROM `contents` 
					LEFT JOIN `routes` ON
						`contents`.`id` = `routes`.`id_route`
					WHERE 
						`contents`.`type` IN ('page') AND `contents`.`id` = ?
						";
				}
			return $sql_r;
		}
}

class Pages 
{
	public $list = array();
	public $publish = array();
	public $draft = array();
	public $trash = array();
	public $other = array();
	
	public function list($type = 'publish')
		{
			return $this->{$type};
		}
	
	public function __construct()
		{
			$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $pdo->prepare($this->get_sql());
			$pdo->exec("SET CHARACTER SET utf8; SET COLLATION SET utf8_unicode_ci");
			$stmt->execute();
			$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
			$this->set_data_array($result);
		}
	
	private function set_data_array($array = null)
		{
			foreach($array as $item)
				{
                    if($item->status == 'publish')
                        {
                            $this->publish[] = new Page($item);
                        }
                    else if($item->status == 'draft')
                        {
                            $this->draft[] = new Page($item);
                        }
                    else if($item->status == 'trash')
                        {
                            $this->trash[] = new Page($item);
                        }
                    else 
                        {
                            $this->other[] = new Page($item);
                        }
				}
		}

	private function get_sql()
		{
			$sql_r = "
				SELECT `contents`.*, `routes`.`url` as `url`
					FROM `contents`
				LEFT JOIN `routes` ON
					`contents`.`id` = `routes`.`id_route`
				WHERE 
					`contents`.`status` IN ('publish') 
					AND `contents`.`ping_status` IN ('open') 
					AND `contents`.`type` IN ('page') ";
					
				if(permissions_page_edit == true) 
					{
						$sql_r = "
						SELECT `contents`.*, `routes`.`url` as `url`
							FROM `contents` 
						LEFT JOIN `routes` ON
							`contents`.`id` = `routes`.`id_route` 
						WHERE 
							`contents`.`type` IN ('page') ORDER BY `contents`.`status` ASC";
					}
			return $sql_r;
		}
	
}



#echo json_encode($website->permissionIs('page_edit'));
#exit();
