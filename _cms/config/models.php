<?php
// ---- ALL ----
class BaseClass 
	{
	   function set_data($data)
		   {
				foreach($data as $k=>$v)
					{
						$this->{$k} = $v;
					}
		   }
	}

class Conectar
	{
		public static function conexion()
			{
				$coneccion = null;
				if(DRIVER_DB == 'PDO')
					{
						$coneccion = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
						$coneccion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set Errorhandling to Exception
						$coneccion->query("SET NAMES 'utf8'");
					}
				else if (DRIVER_DB == 'MySQLi')
					{
						$coneccion = new mysqli(HOST_DB, USER_DB, PASS_DB, NAME_DB);
						$coneccion->query("SET NAMES 'utf8'");
					}
				else
					{
						exit('DRIVER_DB No valido.');
					}
				return $coneccion;
			}
			
		public static function get_data($db_query_result)
			{
				
				$temp = array();
				
				if(DRIVER_DB == 'PDO')
					{
						while($filas = $db_query_result->fetch(PDO::FETCH_OBJ))
						{
							$temp[] = $filas;
						}
					}
				else if (DRIVER_DB == 'MySQLi')
					{
						while($filas = $db_query_result->fetch_assoc())
						{
							$temp[] = $filas;
						}
					}
				return $temp;
			}
	}

class Route 
	{
		private $base_url;
		private $routes;
		
		private $basepath;
		private $uri;
		private $route;
		private $params;
		private $get_params;
		
		var $error = true;
		var $page = null;
		
		private $theme;
		private $session_required = true;
		var $method, 
			$path, 
			$fullpath, 
			$site_url, 
			$action, 
			$fields,
			$scheme,
			$server_name,
			$server_port,
			$plugin,
			$module,
			$section,
			$id_detect,
			$id;
		
		function __construct($get_params = false)
		{
			$this->get_params = $get_params;
			$method = $_SERVER['REQUEST_METHOD'];
			
			$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
			if(isset($uri_parts[0]))
				{
					$this->path = $uri_parts[0];
				}
			else
				{
					$this->path = $_SERVER['REQUEST_URI'];
				}
			
			$this->scheme = $_SERVER['REQUEST_SCHEME'];
			$this->server_name = $_SERVER['SERVER_NAME'];
			$this->server_port = $_SERVER['SERVER_PORT'];
			$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
			if(isset($uri_parts[1]))
				{
					$this->fullpath = $this->scheme.'://' . $this->server_name . ':' . $this->server_port.$this->path . '?' . $uri_parts[1];
				}
			else 
				{
					$this->fullpath = $this->scheme.'://'.$this->server_name.':'.$this->server_port.$this->path;
				}
			
			$this->site_url = $this->scheme.'://'.$this->server_name;
			
			$this->method = $method;
			$this->fields = $this->repairFields();
			$this->action = $this->get_action();
			$this->getRoutes();
			$this->validateRoute();
		}
		
		function get_action()
		{
			switch($this->method){
				case 'POST':
					return 'change';
					break;
				case 'PUT':
					return 'create';
					break;
				case 'DELETE':
					return 'delete';
					break;
				case 'GET':
					return 'view';
					break;
				default:
					header('HTTP/1.1 405 Method not allowed');
					header('Allow: GET, PUT, POST, DELETE');
					return null;
					break;
			}
		}
		
		function repairFields()
		{
			$r = array();
			switch($this->method){
				case 'POST':
					if(isset($_POST)){
						if(isset($_POST['url'])){
							unset($_POST['url']);
							# $_POST = null;
						}
						$r = ($_POST);
					}
					return $r;
					break;
				case 'PUT':
					if(isset($_PUT)){
						if(isset($_PUT['url'])){
							unset($_PUT['url']);
							# $_PUT = null;
						}
						$r = ($_PUT);
					}
					return $r;
					break;
				case 'DELETE':
					if(isset($_DELETE)){
						if(isset($_DELETE['url'])){
							unset($_DELETE['url']);
							# $_DELETE = null;
						}
						$r = ($_DELETE);
					}
					return $r;
					break;
				case 'GET':
					if(isset($_GET)){
						if(isset($_GET['url'])){
							unset($_GET['url']);
							# $_GET = null;
						}
						$r = ($_GET);
					}
					return $r;
					break;
				default:
					return $r;
					break;
			}
		}

		function getRoutes()
		{
			$this->base_url = $this->getCurrentUri();
			$this->routes = explode('/', $this->base_url);
			 
			$this->getParams(); //invocamos el neuvo método
			if(isset($this->routes[1]) && $this->routes[1] !== ''){ $this->plugin = $this->routes[1];
			};
			if(isset($this->routes[2])){ $this->module = $this->routes[2]; };
			if(isset($this->routes[3])){ $this->section = $this->routes[3]; };
			if(isset($this->routes[4])){
				$temp = array_reverse($this->routes);
				$this->id = (int) $temp[0];
				
				if($temp[0] != ''){
					$this->id_detect = $temp[0];
				}else if($temp[1] != ''){
					$this->id_detect = $temp[1];
				}
			};
			
			$temp = array();
			foreach($this->routes as $k=>$v){ if($v !== ''){ $temp[$k] = $v; } };
			if(isset($temp[1]) && $temp[1] == $this->plugin){ unset($temp[1]); };
			if(isset($temp[2]) && $temp[2] == $this->module){ unset($temp[2]); };
			if(isset($temp[3]) && $temp[3] == $this->section){ unset($temp[3]); };
			$temp = array_values($temp);
			
			$arrayTotal = count($temp) - 1;
			if(count($temp) > 0 && $this->id > 0){ unset($temp[$arrayTotal]); }
			
			$this->routes = $temp;
			return $this->routes;
		}
		
		function getCurrentUri()
		{
			$this->basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
			$this->uri = substr($_SERVER['REQUEST_URI'], strlen($this->basepath));
			 
			if($this->get_params)
			{
				$this->getParams();
			}
			else
			{
				if (strstr($this->uri, '?')) $this->uri = substr($this->uri, 0, strpos($this->uri, '?'));
			}
			 
			$this->uri = '/' . trim($this->uri, '/');
			return $this->uri;
		}
		 
		function getParams()
		{
			if (strstr($this->uri, '?'))
			{
				$params = explode("?", $this->uri);
				$params = $params[1];
				parse_str($params, $this->params);
				$this->routes[0] = $this->params;
				array_pop($this->routes);
			}
		}

		function validateRoute()
		{
			try {
				$conexion = Conectar::conexion();
				$sql = "SELECT * FROM `".TABLE_ROUTE."` 
					WHERE `url` IN ('{$this->path}') 
					LIMIT 1";
				$result = Conectar::get_data($conexion->query($sql));
				
				if(isset($result[0])){
					$resultOne = (object) $result[0];
					$this->error = false;
					$this->page = new Router($resultOne);
					$this->theme = $this->page->theme;
					$this->session_required = (boolean) $this->page->session_required;
					define('THEME_ACTIVE', $this->page->theme);
					define('LOGGIN_REQ', $this->session_required);
				}
				else
				{
					$conexion = Conectar::conexion();
					$sql = "SELECT * FROM `".TABLE_ROUTE."` 
							WHERE `plugin` IN ('{$this->plugin}') 
							AND `module` IN ('{$this->module}') 
							AND `section` IN ('{$this->section}') 
							AND `id_route` IN ('{$this->id_detect}') 
							LIMIT 1";
					$result = Conectar::get_data($conexion->query($sql));
					
					if(isset($result[0])){
						$resultOne = (object) $result[0];
						$this->error = false;
						$this->page = new Router($resultOne);
						$this->theme = $this->page->theme;
						$this->session_required = (boolean) $this->page->session_required;
						define('THEME_ACTIVE', $this->page->theme);
						define('LOGGIN_REQ', $this->session_required);
					}
				}
			}
			catch(PDOException $e) {
				exit("Error: " . $e->getMessage());
			}
			$conexion = null;
		}
	}

class Site extends Route
	{
		var $session;
		var $session_server;
		var $options;
		
		public function __construct()
		{
			parent::__construct();
			#define('LOGGIN_REQ', true);
			global $website;
			$website = $this;
			$this->get_model_plugin('system', 'settings');
			$this->options = new Options();
			$this->active_options();
			$this->include_models_system();
			$this->get_session();
			$this->include_models_plugins();
			
			
			if($this->plugin !== 'api')
				{
					if($this->error == false)
						{
							$this->get_html();
						}
					else
						{
							echo $this->path;
							echo '<br>';
							exit('Route/URL No encontrad@ en la BD.<br>');
						};
				}
			else {
				# define('LOGGIN_REQ', true);
			}
		}
		
		private function include_models_system()
			{
				foreach (glob("_cms/plugins/system/models/*.php") as $f)
				{
					include_once($f);
				}
			}
		
		public function active_options()
			{
				date_default_timezone_set($this->options->timezone_string);
				// Informacion de la aplicacion para titulos.
				define('title_sm', $this->options->site_name_sm);
				define('title_md', $this->options->site_name_md);
				define('title_lg', $this->options->site_name_lg);
				define('pageDescription', $this->options->site_description);
				define('HOME_PATH', $this->options->home_path);
				define('LOGGIN_PATH', $this->options->login_path);
			}
		
		public function get_session()
			{
				$this->session = new Session();
				if(isset($this->fields['inputNickLogin']) && isset($this->fields['inputPasswordLogin']) && isset($this->fields['submit_login']))
					{
						$this->session->login($this->fields);
					}
				
				if(!isset($_SESSION['id']))
					{
						if(LOGGIN_REQ === true)
							{
								if($this->path !== LOGGIN_PATH)
								{
									header("Location: ".LOGGIN_PATH."?redirect=".base64_encode($this->fullpath));
									#header("Location: ".LOGGIN_PATH."?redirect=".$this->fullpath);
								}
								
								/*
								global $website;
								$website = $this;
								$this->path = LOGGIN_PATH;
								$this->validateRoute();*/
								// exit("No existe la session.");
							}
						else
							{
							}
					}
				else 
					{
						if($this->path == LOGGIN_PATH)
						{
							header("Location: ".HOME_PATH);
						}
					}
				
				#$this->session = new Session();
				$this->session_server = $_SESSION;
			}
		
		public function get_view_plugin($plugin = null, $view = null)
			{
				$this->include_file("_cms/plugins/{$plugin}/views/{$view}_view.php");
			}
		
		public function get_template_theme($template = null)
			{
				$this->include_file("_cms/themes/".THEME_ACTIVE."/templates/{$template}.php");
				
			}
		
		public function get_controller_plugin($plugin = null, $controller = null)
			{
				$this->include_file("_cms/plugins/{$plugin}/controllers/{$controller}_controller.php");
			}
		
		public function get_model_plugin($plugin = null, $model = null)
			{
				$this->include_file("_cms/plugins/{$plugin}/models/{$model}_model.php");
			}
		
		// ---- Buscar modelos de los plugins ----
		public function include_models_plugins()
		{
			$d = "_cms/plugins/";
			$g = opendir($d);
			while (false !== ($n = readdir($g))) {
				if($n !== '.' && $n !== '..')
				{
					foreach (glob("_cms/plugins/{$n}/models/*.php") as $f)
					{
						global $website;
						$website = $this;
						include_once($f);
					}
				}
			}

		}
		
		public function include_file($fullpath_file = null)
		{
			if($fullpath_file !== null)
			{
				if(file_exists($fullpath_file))
					{
						global $website;
						$website = $this;
						include_once($fullpath_file);
						# require_once($fullpath_file);
					}
				else 
					{ if(MODE_DEBUG == true){ echo "No existe el archivo.  =>  {$fullpath_file}"; } }
			}
		}
		
		public function get_includes($filename=null)
		{ if($filename !== null){ $this->include_file("_cms/themes/".THEME_ACTIVE."/includes/{$filename}"); } }
		
		public function get_section_file($sectionfile)
		{ $this->include_file("_cms/plugins/{$this->page->plugin}/modules/{$this->page->module}/sections/{$sectionfile}.php"); }
		
		public function get_assets_folder()
		{ 
			return $this->scheme.'://'.$this->server_name.':'.$this->server_port."/"."_cms/themes/".THEME_ACTIVE."/";
		}
		
		public function get_assets_global()
		{ 
			return $this->scheme.'://'.$this->server_name.':'.$this->server_port."/"."_cms/global/";
		}
		
		public function get_section_active()
		{
			if($this->isAdmin() == true)
			{
				if($this->plugin !== 'system' && $this->plugin !== 'admin')
					$this->include_file("_cms/global/navbar-admin.php");
			}
			
			$this->include_file("_cms/plugins/{$this->page->plugin}/modules/{$this->page->module}/sections/{$this->page->section}.php");
			if(MODE_DEBUG == true && $this->permissionIs('page_edit') == true)
			{
				$this->get_view_plugin('system', 'debug');
			}	
		}
		
		public function get_html()
		{
			
			$this->get_includes('template.php');
		}
		
		public function isUser()
		{
			if(!isset($_SESSION['id'])) 
				{
					return false;
				}
			else 
				{
					return true;
				}
		}
		
		public function permissionIs($permission = null)
		{
			$session_server = (object) $this->session_server;
			
			if(isset($session_server->permissions))
				{
					$permissions = (object) json_decode(json_encode(json_decode($session_server->permissions)));
					
					if(isset($permissions->$permission))
						{
							return $permissions->$permission;
						}
					else 
						{
							return false;
						}
				}
		}
		
		public function get_global($filename = null) {
			$this->include_file("_cms/global/{$filename}.php");
		}
		
		public function isAdmin()
			{
				return $this->permissionIs('admin');
			}
	}

// ---- Routers ----
class Router extends BaseClass
	{
		
		var $id = 0;
		var $url, $plugin, $module, $section, $id_route, $created_at, $update_at, $theme = '';
		private $array_healthy = array(
			"routeData-id"
			, "routeData-url"
			, "routeData-plugin"
			, "routeData-module"
			, "routeData-section"
			, "routeData-id_route"
			, "routeData-created_at"
			, "routeData-update_at"
			, "routeData-theme"
			, "routeData-session_required"
		);
		private $array_yummy = array(
			"id"
			, "url"
			, "plugin"
			, "module"
			, "section"
			, "id_route"
			, "created_at"
			, "update_at"
			, "theme"
			, "session_required"
		);
	   
	   function __construct($params=null)
	   {
			if(isset($params->id) && $params->id > 0){ $this->load_by_id($params->id); }
	   }
	   
	   function __toString()
	   {
		   return "{$this->url}";
	   }

	   function load_by_id($id)
	   {
			$conexion = Conectar::conexion();
			$sql = "SELECT `".TABLE_ROUTE."`.* FROM `".TABLE_ROUTE."` WHERE `".TABLE_ROUTE."`.`id` = '{$id}'";
			$result = Conectar::get_data($conexion->query($sql));
			
			if(isset($result[0])){
				$resultOne = (object) $result[0];
				$this->set_data($resultOne);
			}
	   }
		
		function delete_by_id($id)
		{
			try {
					$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
					$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$sql = "DELETE FROM `".TABLE_ROUTE."` WHERE `".TABLE_ROUTE."`.`id` IN ('{$id}')";
					$pdo->exec($sql);
					return true;
				}
			catch(PDOException $e)
				{
					return false;
				}
			$pdo = null;
		}
		
		function update_by_id($dataInput)
		{
			$dataRet = new stdClass();
			$dataArray = array();
			$healthy   = $this->array_healthy;
			$yummy   = $this->array_yummy;
			
			foreach($dataInput as $k => $v)
			{
				$newKey = str_replace($healthy, $yummy, $k);
				if(in_array($newKey, $yummy) == true)
				{
					$dataRet->{$newKey} = $v;
					$dataArray[] = " `{$newKey}`='{$v}' ";
				}
			}
			
			try 
			{
				if(isset($dataRet->id))
				{
					$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
					$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
					$sql = "UPDATE `".TABLE_ROUTE."` SET ".implode(',', $dataArray)." WHERE `id`='{$dataRet->id}'";
								
					$stmt = $pdo->prepare($sql);
					$stmt->execute();
					echo "".$stmt->rowCount()." campos ACTUALIZADOS satisfactoriamente.";
				}else{
					echo "NO EXISTE ID DEL USUARIO";
				}
			}
			catch(PDOException $e)
			{
				echo $sql . "<br>" . $e->getMessage();
			}

			$conn = null;
		}
		
		function create($dataInput)
		{
			$dataRet = new stdClass();
			$dataArray = array();
			$dataFields = array();
			$healthy   = $this->array_healthy;
			$yummy   = $this->array_yummy;
			
			foreach($dataInput as $k => $v)
			{
				$newKey = str_replace($healthy, $yummy, $k);
				if(in_array($newKey, $yummy) == true)
				{
					$dataRet->{$newKey} = $v;
					$dataFields[] = " `{$newKey}` ";
					$dataArray[] = " '{$v}' ";
				}
			}
					
			try {
					$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
					$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$sql = "INSERT INTO `url_redirects` (".implode(',', $dataFields).")
					VALUES (".implode(',', $dataArray).")";
					$pdo->exec($sql);
					echo "Nuevo registro creado exitosamente";
				}
			catch(PDOException $e)
				{
					#echo $sql . "<br>" . $e->getMessage();
					echo "<br>" . json_encode($e);
				}

			$pdo = null;
		}
	}

