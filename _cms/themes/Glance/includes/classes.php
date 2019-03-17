<?php 
class Route 
{
	private $basepath;
	private $uri;
	private $base_url;
	private $routes;
	private $route;
	private $params;
	private $get_params;
	var $method, $path;
	var $module = 'dashboard';
	var $section = 'index';
	var $id = 0;
	var $id_detect = 0;
	var $action = null;
	var $id_route = 0;
	var $enable = false;
	var $fields = null;
	var $page_tite = null;
	 
	function __construct($get_params = false)
	{
		$this->get_params = $get_params;
		
		$method = $_SERVER['REQUEST_METHOD'];
		$path = $_SERVER['REQUEST_URI'];
		$this->path = $path;
		
		switch($method){
			case 'POST':
				$this->method = $method;
				$this->action = 'change';
				$this->fields = $this->repairFields();
				break;
			case 'PUT':
				$this->method = $method;
				$this->action = 'create';
				$this->fields = $this->repairFields();
				break;
			case 'DELETE':
				$this->method = $method;
				$this->fields = $this->repairFields();
				$this->action = 'delete';
				break;
			case 'GET':
				$this->method = $method;
				$this->fields = $this->repairFields();
				$this->action = 'view';
				break;
			default:
				header('HTTP/1.1 405 Method not allowed');
				header('Allow: GET, PUT, POST, DELETE');
				break;
		}
	}
	
	public function repairFields()
	{
		$r = array();
		switch($this->method){
			case 'POST':
				if(isset($_POST['url'])){ unset($_POST['url']); }
				$r = ($_POST);
				$_POST = null;
				return $r;
				break;
			case 'PUT':
				if(isset($_PUT['url'])){ unset($_PUT['url']); }
				$r = ($_PUT);
				$_PUT = null;
				return $r;
				break;
			case 'DELETE':
				if(isset($_DELETE['url'])){ unset($_DELETE['url']); }
				$r = ($_DELETE);
				$_DELETE = null;
				return $r;
				break;
			case 'GET':
				if(isset($_GET['url'])){ unset($_GET['url']); }
				$r = ($_GET);
				$_GET = null;
				return $r;
				break;
			default:
				return $r;
				break;
		}
	}
	 
	public function getRoutes()
	{
		$this->base_url = $this->getCurrentUri();
		$this->routes = explode('/', $this->base_url);
		 
		$this->getParams(); //invocamos el neuvo método
		if(isset($this->routes[1]) && $this->routes[1] !== ''){ $this->module = $this->routes[1];
		};
		if(isset($this->routes[2])){ $this->section = $this->routes[2]; };
		if(isset($this->routes[3])){
			$temp = array_reverse($this->routes);
			$this->id = $temp[0];
			
			if($temp[0] != ''){
				$this->id_detect = $temp[0];
			}else if($temp[1] != ''){
				$this->id_detect = $temp[1];
			}
		};
		
		$temp = array();
		foreach($this->routes as $k=>$v){ if($v !== ''){ $temp[$k] = $v; } };
		if(isset($temp[1]) && $temp[1] == $this->module){ unset($temp[1]); };
		if(isset($temp[2]) && $temp[2] == $this->section){ unset($temp[2]); };
		$temp = array_values($temp);
		
		$arrayTotal = count($temp) - 1;
		if(count($temp) > 0 && $this->id > 0){ unset($temp[$arrayTotal]); }
		
		$this->routes = $temp;
		$this->validateRoute();
		$this->createTitlePage();
		
		return $this->routes;
	}
	 
	private function getCurrentUri()
	{
		$this->basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
		$this->uri = substr($_SERVER['REQUEST_URI'], strlen($this->basepath));
		 
		if($this->get_params)
		{
		$this->getParams();
		}else{
		if (strstr($this->uri, '?')) $this->uri = substr($this->uri, 0, strpos($this->uri, '?'));
		}
		 
		$this->uri = '/' . trim($this->uri, '/');
		return $this->uri;
	}
	 
	private function getParams()
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
			$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $pdo->prepare("SELECT * FROM `url_redirects` 
			WHERE `url` IN ('{$this->path}') 
			AND `module` IN ('{$this->module}') 
			AND `section` IN ('{$this->section}') 
			LIMIT 1");
			$stmt->execute();
			$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
			if(isset($result[0])){
				$resultOne = (object) $result[0];
				$this->enable = true;
				$this->id_route = $resultOne->id;
				# ($resultOne);
				# echo json_encode($resultOne);
			}else{
				try {
					$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
					$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $pdo->prepare("SELECT * FROM `url_redirects` 
					WHERE `url` IN ('{$this->path}') 
					LIMIT 1");
					$stmt->execute();
					$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
					if(isset($result[0])){
						$resultOne = (object) $result[0];
						$this->enable = true;
						$this->id_route = $resultOne->id;
						$this->module = $resultOne->module;
						$this->section = $resultOne->section;
						# ($resultOne);
						# echo json_encode($resultOne);
					}else{
						try {
							$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
							$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$stmt = $pdo->prepare("SELECT * FROM `url_redirects` 
							WHERE `module` IN ('{$this->module}') 
							AND `section` IN ('{$this->section}') 
							LIMIT 1");
							$stmt->execute();
							$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
							if(isset($result[0])){
								$resultOne = (object) $result[0];
								$this->enable = true;
								$this->id_route = $resultOne->id;
								$this->module = $resultOne->module;
								$this->section = $resultOne->section;
								# ($resultOne);
								# echo json_encode($resultOne);
							}
						}
						catch(PDOException $e) {
							// $this->result = "Error: " . $e->getMessage();
						}
					}
				}
				catch(PDOException $e) {
					// $this->result = "Error: " . $e->getMessage();
					
				}
			}
		}
		catch(PDOException $e) {
			// $this->result = "Error: " . $e->getMessage();
		}
		$this->conn = null;
	}
	
	function createTitlePage()
	{
		$this->page_tite = "{$this->section} - {$this->module}";
	}
		
	function getHeadGlobal()
	{
		require('cmr/includes/global/head.php');
	}
	
	function getScriptsGlobal()
	{
		require('cmr/includes/global/scripts.php');
	}
	
}

class BaseClass 
{
	var $id;

   function setData($data)
   {
		foreach($data as $k=>$v)
		{
			$this->{$k} = $v;
		}
   }
}

# ----------------- LOGS ROUTES -----------------
class LogRoutes extends BaseClass 
{
	var $host, $real_ip, $forwarded_for, $user_agent, $accept, $referer, $cookie, $server_address, $server_name, $server_port, $remote_address, $script_filename, $redirect_url, $request_method, $request_uri, $time, $time_float;
	private $array_healthy = array("host", "real_ip", "forwarded_for", "user_agent", "accept", "referer", "cookie", "server_address", "server_name", "server_port", "remote_address", "script_filename", "redirect_url", "request_method", "request_uri", "time", "time_float");
	private $array_yummy = array("host", "real_ip", "forwarded_for", "user_agent", "accept", "referer", "cookie", "server_address", "server_name", "server_port", "remote_address", "script_filename", "redirect_url", "request_method", "request_uri", "time", "time_float");
   
	function __construct()
	{
		if(isset($_SERVER['HTTP_HOST'])){ $this->host = $_SERVER['HTTP_HOST']; }
		if(isset($_SERVER['HTTP_X_REAL_IP'])){ $this->real_ip = $_SERVER['HTTP_X_REAL_IP']; }
		if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){ $this->forwarded_for = $_SERVER['HTTP_X_FORWARDED_FOR']; }
		if(isset($_SERVER['HTTP_USER_AGENT'])){ $this->user_agent = $_SERVER['HTTP_USER_AGENT']; }
		if(isset($_SERVER['HTTP_ACCEPT'])){ $this->accept = $_SERVER['HTTP_ACCEPT']; }
		if(isset($_SERVER['HTTP_REFERER'])){ $this->referer = $_SERVER['HTTP_REFERER']; }
		if(isset($_SERVER['HTTP_COOKIE'])){ $this->cookie = $_SERVER['HTTP_COOKIE']; }
		if(isset($_SERVER['SERVER_ADDR'])){ $this->server_address = $_SERVER['SERVER_ADDR']; }
		if(isset($_SERVER['SERVER_NAME'])){ $this->server_name = $_SERVER['SERVER_NAME']; }
		if(isset($_SERVER['SERVER_PORT'])){ $this->server_port = $_SERVER['SERVER_PORT']; }
		if(isset($_SERVER['REMOTE_ADDR'])){ $this->remote_address = $_SERVER['REMOTE_ADDR']; }
		if(isset($_SERVER['SCRIPT_FILENAME'])){ $this->script_filename = $_SERVER['SCRIPT_FILENAME']; }
		if(isset($_SERVER['REDIRECT_URL'])){ $this->redirect_url = $_SERVER['REDIRECT_URL']; }
		if(isset($_SERVER['REQUEST_METHOD'])){ $this->request_method = $_SERVER['REQUEST_METHOD']; }
		if(isset($_SERVER['REQUEST_URI'])){ $this->request_uri = $_SERVER['REQUEST_URI']; }
		if(isset($_SERVER['REQUEST_TIME'])){ $this->time = $_SERVER['REQUEST_TIME']; }
		if(isset($_SERVER['REQUEST_TIME_FLOAT'])){ $this->time_float = $_SERVER['REQUEST_TIME_FLOAT']; }
		
		$this->create($this);
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
				$sql = "INSERT INTO `log_auth` (".implode(',', $dataFields).")
				VALUES (".implode(',', $dataArray).")";
				$pdo->exec($sql);
				#echo "Nuevo registro creado exitosamente";
			}
		catch(PDOException $e)
			{
				#echo $sql . "<br>" . $e->getMessage();
				echo "<br>" . json_encode($e);
			}

		$pdo = null;
	}

}

# ----------------- SESSION -----------------
class Session extends User 
{
	var $server = null;
	var $countRefresh = null;
	var $Route = null;
	var $id = 0;
	var $Routes2 = null;
	var $user_ip = null;
	
	function __construct()
	{
		if (!isset($_SESSION['countRefresh'])) { $_SESSION['countRefresh'] = 0; } else { $_SESSION['countRefresh']++; }
		if (isset($_SESSION['id']) && $_SESSION['id'] > 0) { $_SESSION['id'] = (int) $_SESSION['id']; } else { $_SESSION['id'] = 0; }
		$this->countRefresh = $_SESSION['countRefresh'];
		$this->id = $_SESSION['id'];
		$this->Route = new Route();
		$this->Routes2 = $this->Route->getRoutes();
		
		if($this->id > 0){
			$this->load_by_id($this->id);
		}else{
			if(isset($this->Route->fields['inputNickLogin']) && isset($this->Route->fields['inputPasswordLogin']))
			{
				$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$stmt = $pdo->prepare('SELECT `users`.*, `permissions`.`data` as `permissions` 
				FROM `users` 
				LEFT JOIN `permissions` ON `permissions`.`id` = `users`.`permissions`
				WHERE `users`.`username`=? AND `users`.`hash`=?');
								
				$stmt->execute([$this->Route->fields['inputNickLogin'],$this->Route->fields['inputPasswordLogin']]);
				$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
				if(isset($result[0])){
					$resultOne = (object) $result[0];
					$this->setData($resultOne);
					$this->saveSession();
				}
			}
		}
		
				
		$this->user_ip = $this->getUserIP();
		$tempServ = new LogRoutes();
		$this->server = $tempServ;
	}
	
	function getUserIP()
	{
		// Get real visitor IP behind CloudFlare network
		if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
				  $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
				  $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
		}
		$client  = @$_SERVER['HTTP_CLIENT_IP'];
		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote  = $_SERVER['REMOTE_ADDR'];

		if(filter_var($client, FILTER_VALIDATE_IP))
		{
			$ip = $client;
		}
		elseif(filter_var($forward, FILTER_VALIDATE_IP))
		{
			$ip = $forward;
		}
		else
		{
			$ip = $remote;
		}

		return $ip;
	}


	function saveSession()
	{
		$_SESSION['id'] = $this->id;
		$_SESSION['username'] = $this->username;
		$_SESSION['permissions'] = $this->permissions;
		$_SESSION['names'] = $this->names;
		$_SESSION['surname'] = $this->surname;
		$_SESSION['second_surname'] = $this->second_surname;
		$_SESSION['hash'] = $this->hash;
	}
	
	function destroySession($url=null)
	{
		if($url == null){ $url = path_home; }
		session_unset(); // remove all session variables
		session_destroy(); // destroy the session 
		echo "<meta http-equiv=\"refresh\" content=\"0; url={$url}\" />";
	}
	
	function dropdownUserNavbar()
	{
		?>
		<a href="#" id="loginButton"><img src="<?php echo path_homeTheme; ?>images/login.png"><span>Mi Cuenta</span></a>
		<div id="loginBox">                
			<div id="loginForm">
				<fieldset id="body">
					<fieldset>
						<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Cerrar sesión</a>
					</fieldset>
					<!--<fieldset>
						<label for="password">Password</label>
						<input type="password" name="password" id="password">
					</fieldset>
					<input type="submit" id="login" value="Sign in">
					<label for="checkbox"><input type="checkbox" id="checkbox"> <i>Remember me</i></label>-->
				</fieldset>
				<!-- <span><a href="#">Forgot your password?</a></span> -->
			</div>
		</div>
		
		<!--
		<li class="nav-item dropdown no-arrow">
			<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-user-circle fa-fw"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
				<a class="dropdown-item" href="/users/myaccount/"></a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Cerrar sesión</a>
			</div>
		</li>-->
		<?php 
	}
	
	function itemsNavbarTheme()
	{
		if($this->id > 0){ ?>
			<?php 
				if(
					isset($this->permissions->users)
					|| isset($this->permissions->modules)
					|| isset($this->permissions->routes)
				){ 
			?>
				<li class="dropdown">
					<a class="dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-fw fa-cogs"></i>
						<span class="badge badge-danger">Config</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
						<a class="dropdown-item" href="/admin/users/admin.html">Usuarios</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="/admin/modules/admin.html">Modulos</a>
						<a class="dropdown-item" href="/admin/routes/admin.html">Routes</a>
						<a class="dropdown-item" href="/admin/logs/auth.html">Log Ingresos</a>
					</div>
				</li>
			<?php 
				}
				if(MODE_DEBUG == true){ ?>
				<li class="dropdown">
					<a class="dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-fw fa-folder"></i>
						<span class="badge badge-danger">DEMO</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
						<a class="dropdown-item dropdown-menu-right" href="/admin/indexdemo.html"><span>Index</span></a>
						<a class="dropdown-item dropdown-menu-right" href="/admin/404.html"><span>404</span></a>
						<a class="dropdown-item dropdown-menu-right" href="/admin/blank.html"><span>blank</span></a>
						<a class="dropdown-item dropdown-menu-right" href="/admin/charts.html"><span>charts</span></a>
						<a class="dropdown-item dropdown-menu-right" href="/admin/contact.html"><span>contact</span></a>
						<a class="dropdown-item dropdown-menu-right" href="/admin/education.html"><span>education</span></a>
						<a class="dropdown-item dropdown-menu-right" href="/admin/entertain.html"><span>entertain</span></a>
						<a class="dropdown-item dropdown-menu-right" href="/admin/living.html"><span>living</span></a>
						<a class="dropdown-item dropdown-menu-right" href="/admin/tables.html"><span>tables</span></a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Something else here</a>
					</div>
				</li>
			<?php 
			}
		}
	}
	
	function getHeadTheme()
	{
		require('cmr/content/themes/'.theme_active.'/includes/head.php');
	}
	
	function getScriptsTheme()
	{
		
		require('cmr/content/themes/'.theme_active.'/includes/scripts.php');
		
		$site = new Route();
		$routes = $site->getRoutes();

		$pageActiveScripts = "cmr/content/modules/{$site->module}/scripts/{$site->section}.php";
		if(file_exists($pageActiveScripts)){
			include_once($pageActiveScripts);
		}
	}
	
	function getSidebarTheme()
	{
		if($this->id > 0){
			require('cmr/content/themes/'.theme_active.'/includes/sidebar.php');
		}
	}
	
	function getNavbarTheme()
	{
		if($this->id > 0){
			require('cmr/content/themes/'.theme_active.'/includes/navbar.php');
		}
	}
	
	function getBreadcrumbTheme()
	{
		if($this->id > 0){
			require('cmr/content/themes/'.theme_active.'/includes/breadcrumb.php');
		}
		
	}
	
	function getDebugBlock()
	{
		if(MODE_DEBUG == true){
			require('cmr/includes/global/debug.php');
		}
	}
	
	function getBodyTheme()
	{
		require('cmr/includes/global/body.php');
	}
	
	function getFooterTheme()
	{
		if($this->id > 0){
			require('cmr/content/themes/'.theme_active.'/includes/footer.php');
		}
	}
	
	function getModalsTheme()
	{
		require('cmr/content/themes/'.theme_active.'/includes/modals.php');
	}
	
	function getContentRoute()
	{
		require('cmr/includes/global/content.php');
	}
	
	function validatePermission($module, $permission)
	{
		if(isset($this->permissions->{$module}->$permission))
			{
				return (boolean) $this->permissions->{$module}->$permission;
			}
		else
			{
				return false;
			}
	}
	
}

# ----------------- USERS -----------------
class Users
{
	var $list = array();
	var $total = 0;
	
	function __construct()
	{
		$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare('SELECT `users`.*, `permissions`.`data` as `permissions` 
		FROM `users` 
		LEFT JOIN `permissions` ON `permissions`.id = `users`.`permissions` 
		LIMIT 1000
		');
		$stmt->execute();
		$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
		$temp =  array();
		$this->total = count($result);
		foreach($result as $item)
		{
			$temp[] = new User($item);
		}
		$this->list = $temp;
	}
}

class User
{
  var $id, $username, $permissions, $names, $surname, $second_surname, $mail, $phone, $mobile, $avatar;
  private $array_healthy = array("userData-id", "userData-username", "userData-names", "userData-surname", "userData-second_surname", "userData-phone", "userData-mobile", "userData-avatar", "userData-mail", "userData-hash", "userData-permissions");
  private $array_yummy = array("id", "username", "names", "surname", "second_surname", "phone", "mobile", "avatar", "mail", "hash", "permissions");
   
   function __construct($params=null)
   {
		if(isset($params->id) && $params->id > 0){
			$this->load_by_id($params->id);
		}
   }
   
   function __toString()
   {
	   #return ($this->username);
	   return "{$this->names} {$this->surname} {$this->second_surname}";
   }

	function load_by_id($id)
	{
		$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare('SELECT `users`.*, `permissions`.`data` as `permissions`, `pictures`.`data` as `avatar_data`
		FROM `users` 
		LEFT JOIN `permissions` ON `permissions`.`id` = `users`.`permissions` 
		LEFT JOIN `pictures` ON `pictures`.`id` = `users`.`avatar`
		WHERE `users`.id=?');
		$stmt->execute([$id]);
		$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
		if(isset($result[0])){
			$resultOne = (object) $result[0];
		
			$this->setData($resultOne);
		}
	}
	
   function load_by_username($username)
   {
		$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare('SELECT `users`.*, `permissions`.`data` as `permissions`, `pictures`.`data` as `avatar_data`
		FROM `users` 
		LEFT JOIN `permissions` ON `permissions`.id = `users`.`permissions` 
		LEFT JOIN `pictures` ON `pictures`.`id` = `users`.`avatar`
		WHERE `users`.username=?');
		$stmt->execute([$username]);
		$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
		if(isset($result[0])){
			$resultOne = (object) $result[0];
		
				$myBusiness = $this->loadMyBusiness_by_userid($resultOne->id);
				$resultOne->myBusiness = ($myBusiness->myBusiness);
				$resultOne->myBusinessTotal = ($myBusiness->myBusinessTotal);
			$this->setData($resultOne);
		}
   }
   
   function setData($data)
   {
		if(isset($data->permissions)){
			$data->permissions = json_decode($data->permissions);
		}else if(isset($data->myBusiness)){
			$i=0;
			foreach($data->myBusiness As $k=>$v)
			{
				if($k == 'permissions'){
					$data->myBusiness[$i]->{$k} = json_decode($v);
				}
				$i++;
			}
		}
		foreach($data as $k=>$v)
		{
			$this->{$k} = $v;
		}
   }
   
	function getUser(){
	   return ($this);
	}
	
	function delete_by_id($id)
	{
		try {
				$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "DELETE FROM `users` WHERE `users`.`id` IN ('{$id}')";
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
				
				$sql = "UPDATE `users` SET ".implode(',', $dataArray)." WHERE `id`='{$dataRet->id}'";
							
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
				$sql = "INSERT INTO `users` (".implode(',', $dataFields).")
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

# ----------------- PICTURES -----------------
class Picture extends BaseClass
{
  var $id, $name,$size, $data, $url_short, $url_large, $type, $create;
   
   function __construct($params=null)
   {
		if(isset($params->id) && $params->id > 0){
			$this->load_by_id($params->id);
		}
   }
   
   function __toString()
   {
	   return "{$this->url_large}";
   }

   function load_by_id($id)
   {
		$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare('SELECT `pictures`.*
		FROM `pictures` 
		WHERE `pictures`.`id` = ?');
		#$pdo->exec("SET CHARACTER SET utf8; SET COLLATION SET utf8_unicode_ci");
		$stmt->execute([$id]);
		$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
		if(isset($result[0])){
			$resultOne = $result[0];
			$this->setData($resultOne);
		}
   }
   
   function getPicture(){
	   return ($this);
   }
}

# ----------------- PERMISSIONS -----------------
class Permission extends BaseClass
{
  var $name, $data;
   
   function __construct($params=null)
   {
		if(isset($params->id) && $params->id > 0){
			$this->load_by_id($params->id);
		}
   }
   
   function __toString()
   {
	   return "{$this->name}";
   }

   function load_by_id($id)
   {
		$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare('SELECT `permissions`.*
		FROM `permissions` 
		WHERE `permissions`.`id` = ?');
		$stmt->execute([$id]);
		$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
		if(isset($result[0])){
			$resultOne = (object) $result[0];
			$this->setData($resultOne);
		}
   }
}

class Permissions
{
	var $list = array();
	var $total = 0;
	
	function __construct()
	{
		$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare('SELECT `permissions`.* FROM `permissions` LIMIT 1000');
		$stmt->execute();
		$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
		$temp =  array();
		$this->total = count($result);
		foreach($result as $item)
		{
			$temp[] = new Permission($item);
		}
		$this->list = $temp;
	}
	
}

# ----------------- MODULES -----------------
class Modules
{
	var $list = array();
	var $total = 0;
	
	function __construct()
	{
		$dirs = $this->getFileList('cmr/content/modules/');
		$this->list = ($dirs);
	}
	
	
	function getFileList($dir) { 
	   
	   $result = array(); 

	   $cdir = scandir($dir); 
	   foreach ($cdir as $key => $value) 
	   { 
		  if (!in_array($value,array(".",".."))) 
		  { 
			 if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) 
			 { 
				$result[$value] = $this->getFileList($dir . DIRECTORY_SEPARATOR . $value); 
			 } 
			 else 
			 { 
				$result[] = $value; 
			 } 
		  } 
	   } 
	   
	   return $result; 
	} 
	/*
	function getFileList($dir)
	{
		// array to hold return value
		$retval = [];

		// add trailing slash if missing
		if(substr($dir, -1) != "/") {
		  $dir .= "/";
		}

		// open pointer to directory and read list of files
		$d = @dir($dir) or die("getFileList: Failed opening directory {$dir} for reading");
		while(FALSE !== ($entry = $d->read())) {
		  // skip hidden files
		  if($entry{0} == ".") continue;
		  if(is_dir("{$dir}{$entry}")) {
			$retval[] = [
			  'name' => "{$entry}",
			  'path' => "{$dir}{$entry}/",
			  'type' => filetype("{$dir}{$entry}"),
			  'size' => 0,
			  'lastmod' => filemtime("{$dir}{$entry}")
			];
		  } elseif(is_readable("{$dir}{$entry}")) {
			$retval[] = [
			  'name' => "{$entry}",
			  'path' => "{$dir}{$entry}",
			  'type' => mime_content_type("{$dir}{$entry}"),
			  'size' => filesize("{$dir}{$entry}"),
			  'lastmod' => filemtime("{$dir}{$entry}")
			];
		  }
		}
		$d->close();

		return $retval;
	}*/
}

# ----------------- ROUTES -----------------
class Route_S extends BaseClass
{
  var $url, $module, $section, $created_at;
  private $array_healthy = array("routeData-id", "routeData-url", "routeData-module", "routeData-section", "routeData-create_at", "routeData-update_at");
  private $array_yummy = array("id", "url", "module", "section", "create_at", "update_at");
   
   
   function __construct($params=null)
   {
		if(isset($params->id) && $params->id > 0){
			$this->load_by_id($params->id);
		}
   }
   
   function __toString()
   {
	   return "{$this->url}";
   }

   function load_by_id($id)
   {
		$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare('SELECT `url_redirects`.*
		FROM `url_redirects` 
		WHERE `url_redirects`.`id` = ?');
		$stmt->execute([$id]);
		$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
		if(isset($result[0])){
			$resultOne = (object) $result[0];
			$this->setData($resultOne);
		}
   }
	
	function delete_by_id($id)
	{
		try {
				$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "DELETE FROM `url_redirects` WHERE `url_redirects`.`id` IN ('{$id}')";
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
				
				$sql = "UPDATE `url_redirects` SET ".implode(',', $dataArray)." WHERE `id`='{$dataRet->id}'";
							
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

class Routes
{	
	var $list = array();
	var $total = 0;
	
	function __construct()
	{
		$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare('SELECT `url_redirects`.* FROM `url_redirects` LIMIT 1000');
		$stmt->execute();
		$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
		$temp =  array();
		$this->total = count($result);
		foreach($result as $item)
		{
			$temp[] = new Route_S($item);
		}
		$this->list = $temp;
	}
	
}

# ----------------- LOGS -----------------
class LogsAuth
{
	var $list = array();
	var $total = 0;
	
	function __construct($limit=1000)
	{
		$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare('SELECT `log_auth`.* FROM `log_auth` ORDER BY id DESC LIMIT ' . $limit);
		$stmt->execute();
		$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
		$temp =  array();
		$this->total = count($result);
		foreach($result as $item)
		{
			$temp[] = new LogAuth($item);
		}
		$this->list = $temp;
	}
	
	function chartDays($limit=1000)
	{
		$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare("SELECT 
			COUNT(g.id) AS 'totalcount', g.request_method AS 'request_method', g.request_uri AS 'request_uri' 
		FROM log_auth g
		GROUP BY 
			g.request_method, 
			g.request_uri 
		HAVING COUNT(g.id) > 0 
		ORDER BY g.request_uri");
		$stmt->execute();
		$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
		
		$temp = new stdClass();
		$temp->result = $result;
		$temp->fields = array();
		$temp->datasets = array();
		
		foreach($result as $item)
		{
			$temp->fields[] = $item->request_method . ' - ' . $item->request_uri;
			$temp->datasets[] = $item->totalcount;
		}
		return $temp;
	}
}

class LogAuth extends BaseClass
{
  var $name, $data;
   
   function __construct($params=null)
   {
		if(isset($params->id) && $params->id > 0){
			$this->load_by_id($params->id);
		}
		else if(isset($params['id']) && $params['id'] > 0){
			$this->load_by_id($params['id']);
		}
   }
   
   function __toString()
   {
	   return json_encode($this);
   }

   function load_by_id($id)
   {
		$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare('SELECT `log_auth`.*
		FROM `log_auth` 
		WHERE `log_auth`.`id` = ?');
		$stmt->execute([$id]);
		$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
		if(isset($result[0])){
			$resultOne = (object) $result[0];
			$this->setData($resultOne);
		}
   }
}

# ----------------- SETTINGS -----------------
class Setting extends BaseClass
{
	var $url, $name, $result;
	private $array_healthy = array("settingData-id", "settingData-name", "settingData-result");
	private $array_yummy = array("id", "name", "result");

	function __construct($params=null)
	{
		if(isset($params->id) && $params->id > 0){
			$this->load_by_id($params->id);
		}
	}
   
   function __toString()
   {
	   return "{$this->name}";
   }

   function load_by_id($id)
   {
		$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare('SELECT `config_options`.*
		FROM `config_options` 
		WHERE `config_options`.`id` = ?');
		$pdo->exec("SET CHARACTER SET utf8; SET COLLATION SET utf8_unicode_ci");
		$stmt->execute([$id]);
		$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
		if(isset($result[0])){
			$resultOne = (object) $result[0];
			$this->setData($resultOne);
		}
   }
	
	function delete_by_id($id)
	{
		try {
				$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "DELETE FROM `config_options` WHERE `config_options`.`id` IN ('{$id}')";
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
				$dataRet->{$newKey} = ($v);
				$dataArray[] = " `{$newKey}`='{$v}' ";
			}
		}
		
		try 
		{
			if(isset($dataRet->id))
			{
				$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$sql = "UPDATE `config_options` SET ".implode(',', $dataArray)." WHERE `id`='{$dataRet->id}'";
							
				$pdo->exec("SET CHARACTER SET utf8; SET COLLATION SET utf8_unicode_ci");
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
				$sql = "INSERT INTO `config_options` (".implode(',', $dataFields).")
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

class Settings
{	
	var $list = array();
	var $total = 0;
	
	function __construct()
	{
		$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		#$pdo->exec("SET CHARACTER SET utf8; SET COLLATION SET utf8_unicode_ci");
		$stmt = $pdo->prepare('SELECT `config_options`.* FROM `config_options` LIMIT 1000');
		$stmt->execute();
		$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
		$temp =  array();
		$this->total = count($result);
		foreach($result as $item)
		{
			$temp[] = new Setting($item);
		}
		$this->list = $temp;
	}
	
}

# PASAR -----------------------
function transalateLabelPermissions($label)
{
	switch ($label) {
		case 'view':
			return 'Ver';
			break;
		case 'change':
			return 'Modificar';
			break;
		case 'create':
			return 'Crear';
			break;
		case 'delete':
			return 'Eliminar';
			break;
		case 'users':
			return 'Usuarios';
		case 'routes':
			return 'Routes';
		case 'modules':
			return 'Modulos';
		case 'dashboard':
			return 'Dashboard';
			break;
	}

}
# PASAR -----------------------
function convertBooleanToIcon($valueBoolean)
{
	switch ($valueBoolean) {
		case '1':
			return '<i class="fa fa-check"></i>';
			break;
		case true:
			return '<i class="fa fa-check"></i>';
			break;
		case 'true':
			return '<i class="fa fa-check"></i>';
			break;
		case 'enabled':
			return '<i class="fa fa-check"></i>';
			break;
		case 'enable':
			return '<i class="fa fa-check"></i>';
			break;
			
		case '0':
			return '<i class="fa fa-ban"></i>';
			break;
		case 0:
			return '<i class="fa fa-ban"></i>';
			break;
		case false:
			return '<i class="fa fa-ban"></i>';
			break;
		case 'false':
			return '<i class="fa fa-ban"></i>';
			break;
		case 'disabled':
			return '<i class="fa fa-ban"></i>';
			break;
		case 'disable':
			return '<i class="fa fa-ban"></i>';
			break;
	}

}

