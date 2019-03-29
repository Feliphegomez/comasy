<?php 
class Session extends BaseClass 
{
  public $alive = true;
  public $dbc = NULL;
  public $id = 0;
  public $username = 'guest';
  public $permissions = null;
  public $names = '';
  public $surname = '';
  public $second_surname = '';
  public $hash = '';
  public $user_ip = '0.0.0.0';
 
	function __construct()
	{
		session_set_save_handler(
			array(&$this, 'open'),
			array(&$this, 'close'),
			array(&$this, 'read'),
			array(&$this, 'write'),
			array(&$this, 'destroy'),
			array(&$this, 'clean')
		);
		session_start();

		if(isset($_SESSION['id']))
			{
				$this->set_data($_SESSION);
			}
	}
	
	function __destruct()
	{
		if($this->alive)
			{
			  @session_write_close();
			  $this->alive = false;
			}
	}

  function delete()
  {
    if(ini_get('session.use_cookies'))
    {
      $params = session_get_cookie_params();
      @setcookie(session_name(), '', time() - 42000,
        $params['path'], $params['domain'],
        $params['secure'], $params['httponly']
      );
    }
 
    @session_destroy();
 
    $this->alive = false;
	
	echo "<meta http-equiv=\"refresh\" content=\"0; url=".HOME_PATH."\" />";
  }
 
  public function open()
  {    
    $this->dbc = new MYSQLi(HOST_DB, USER_DB, PASS_DB, NAME_DB)
      OR die('Could not connect to database.');
 
    return true;
  }
 
  public function close()
  {
    return $this->dbc->close();
  }
 
  public function read($sid)
  {
    $q = "SELECT `data` FROM `sessions` WHERE `id` = '".$this->dbc->real_escape_string($sid)."' LIMIT 1";
    $r = $this->dbc->query($q);
 
    if($r->num_rows == 1)
    {
      $fields = $r->fetch_assoc();
 
      return $fields['data'];
    }
    else
    {
      return '';
    }
  }

	function write($sid, $data)
		{
			if(!isset($_SESSION['username'])){ $_SESSION['username'] = 'guest'; }
			if(!isset($_SESSION['id'])){ $_SESSION['id'] = '0'; }		  
		  
			$q = "REPLACE INTO `sessions` (`id`, `data`, `real_ip`, `user_id`, `username`) VALUES ('".$this->dbc->real_escape_string($sid)."', '".$this->dbc->real_escape_string($data)."', '".$this->get_user_ip()."', '".$_SESSION['id']."', '".$_SESSION['username']."')";
			$this->dbc->query($q);
	 
			return $this->dbc->affected_rows;
		}
 
  public function destroy($sid)
  {
    $q = "DELETE FROM `sessions` WHERE `id` = '".$this->dbc->real_escape_string($sid)."'"; 
    $this->dbc->query($q);
 
    $_SESSION = array();
 
    return $this->dbc->affected_rows;
  }
 
  public function clean($expire)
  {
    $q = "DELETE FROM `sessions` WHERE DATE_ADD(`last_accessed`, INTERVAL ".(int) $expire." SECOND) < NOW()"; 
    $this->dbc->query($q);
 
    return $this->dbc->affected_rows;
  }

	public function login($fields)
	{
		if(is_array($fields) == true)
		{
			$sql = "SELECT `users`.*, `permissions`.`data` as `permissions` 
			FROM `users` 
			LEFT JOIN `permissions` ON `permissions`.`id` = `users`.`permissions`
			WHERE `users`.`username`='{$fields['inputNickLogin']}' AND `users`.`hash`='{$fields['inputPasswordLogin']}'";
			
			$conexion = Conectar::conexion();
			$result = Conectar::get_data($conexion->query($sql));
			
			if(isset($result[0])){
				$resultOne = (object) $result[0];
				//$this->set_data($resultOne);
				$this->saveSession($resultOne);
				
			if(isset($_GET['redirect'])) 
				{
					#header("Location: ".$_GET['redirect']);
					$url = base64_decode($_GET['redirect']);
					echo "<meta http-equiv=\"refresh\" content=\"0; url=".$url."\" />";
					exit();
				}
			else 
				{
					header("Location: ".HOME_PATH);
				}
			}else{
				
			}
		}
	}

	function saveSession($session)
		{
			if(is_array($session) == true)
			{
				$_SESSION = $session;
			}
			else if(is_object($session) == true)
			{
				$_SESSION['id'] = $session->id;
				$_SESSION['username'] = $session->username;
				$_SESSION['permissions'] = $session->permissions;
				$_SESSION['names'] = $session->names;
				$_SESSION['surname'] = $session->surname;
				$_SESSION['second_surname'] = $session->second_surname;
				$_SESSION['hash'] = $session->hash;
			}
			$_SESSION['user_ip'] = $this->get_user_ip();
		}
	
	function get_user_ip()
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
		
}
# ----------------- SESSION -----------------

class SessionView extends BaseClass 
	{
		public $id, $data, $last_accessed, $real_ip, $user_id, $username;
		
		function __construct($params = null)
			{
				if(isset($params->id) && $params->id > 0){ $this->load_by_id($params->id); }
				
			}
		
		# Se esta validando esta funcion para poder ejecutar la sessio.
		function load_by_id($id)
			{
				$sql = "SELECT `".TABLE_SESSIONS."`.*, `users`.`*`
				FROM `".TABLE_SESSIONS."` 
					LEFT JOIN `users` ON `users`.id = `".TABLE_SESSIONS."`.`user_id` 
				WHERE `".TABLE_SESSIONS."`.id='{$id}'";
				
				$conexion = Conectar::conexion();
				$result = Conectar::get_data($conexion->query($sql));
				
				if(isset($result[0])){
					$resultOne = (object) $result[0];
				
					$this->set_data($resultOne);
				}
			}
			
	}

class Sessions
	{
		public $data;
				
		function __construct()
			{
				try 
					{
						$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
						$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$stmt = $pdo->prepare("SELECT `".TABLE_SESSIONS."`.* FROM `".TABLE_SESSIONS."` ");			
						$pdo->exec("SET CHARACTER SET utf8; SET COLLATION SET utf8_unicode_ci");
						$stmt->execute();
						$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
						foreach($result as $item)
							{
								$this->data[] = new SessionView($item);
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