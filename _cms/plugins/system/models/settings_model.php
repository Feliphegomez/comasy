<?php 

class Options 
{
	var $themes = array();
	var $options_themes = array();
	
	public function __construct()
		{
			$conexion = Conectar::conexion();
			$sql = "SELECT * FROM `".TABLE_OPTIONS."` ";
			
			foreach(Conectar::get_data($conexion->query($sql)) as $r)
			{
				$this->{$r->option_name} = $r->option_value;
			}
			$this->include_themes();
		}
	
	private function include_themes()
		{
			$tempa = new stdClass();
			$tempa->text = 'None';
			$tempa->value = 'none';
			$this->options_themes[] = $tempa;
			
			$g = @opendir("_cms/themes/");
			while (false !== ($n = readdir($g))) {
				if($n !== '.' && $n !== '..')
				{
					$this->themes[] = (string) $n;
					$tempa = new stdClass();
					$tempa->text = (string) $n;
					$tempa->value = (string) $n;
					$this->options_themes[] = $tempa;
				}
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
			$this->set_data($resultOne);
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

