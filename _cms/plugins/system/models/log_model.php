<?php 
# ----------------- LOGS ROUTES -----------------
class LogRoutes extends BaseClass 
{
	var $host, $real_ip, $forwarded_for, $user_agent, $accept, $referer, $cookie, $server_address, $server_name, $server_port, $remote_address, $script_filename, $redirect_url, $request_method, $request_uri, $time, $time_float;
	private $array_healthy = array("host", "real_ip", "forwarded_for", "user_agent", "accept", "referer", "cookie", "server_address", "server_name", "server_port", "remote_address", "script_filename", "redirect_url", "request_method", "request_uri", "time", "time_float");
	private $array_yummy = array("host", "real_ip", "forwarded_for", "user_agent", "accept", "referer", "cookie", "server_address", "server_name", "server_port", "remote_address", "script_filename", "redirect_url", "request_method", "request_uri", "time", "time_float");
   /*
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
	*/
}

# ----------------- LOGS -----------------
class LogsAuth
{
	var $list = array();
	var $total = 0;
	/*
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
	*/
}

class LogAuth extends BaseClass
{
  var $name, $data;
   
   /*
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
			$this->set_data($resultOne);
		}
   }
   */
}
