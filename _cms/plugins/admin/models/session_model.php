<?php 
class Session
{
  private $alive = true;
  private $dbc = NULL;
  public $id = 0;
 
	function __construct()
	{
		session_set_save_handler(
			array(&$this, 'open'),
			array(&$this, 'close'),
			array(&$this, 'read'),
			array(&$this, 'write'),
			array(&$this, 'destroy'),
			array(&$this, 'clean'));

			session_start();
			if(isset($_SESSION['id']))
				{
					$this->id = $_SESSION['id'];
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
 
  private function open()
  {    
    $this->dbc = new MYSQLi(HOST_DB, USER_DB, PASS_DB, NAME_DB)
      OR die('Could not connect to database.');
 
    return true;
  }
 
  private function close()
  {
    return $this->dbc->close();
  }
 
  private function read($sid)
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
 
  private function write($sid, $data)
  {
    $q = "REPLACE INTO `sessions` (`id`, `data`) VALUES ('".$this->dbc->real_escape_string($sid)."', '".$this->dbc->real_escape_string($data)."')";
    $this->dbc->query($q);
 
    return $this->dbc->affected_rows;
  }
 
  private function destroy($sid)
  {
    $q = "DELETE FROM `sessions` WHERE `id` = '".$this->dbc->real_escape_string($sid)."'"; 
    $this->dbc->query($q);
 
    $_SESSION = array();
 
    return $this->dbc->affected_rows;
  }
 
  private function clean($expire)
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
				//$this->setData($resultOne);
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

# ----------------- USERS -----------------
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
	
	
	# Se esta validando esta funcion para poder ejecutar la sessio.
	function load_by_id($id)
	{
		$sql = "'SELECT `users`.*
		FROM `users` 
		WHERE `users`.id='{$id}'";
		
		$conexion = Conectar::conexion();
		$result = Conectar::get_data($conexion->query($sql));
		
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
