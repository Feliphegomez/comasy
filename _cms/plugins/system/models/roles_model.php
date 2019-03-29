<?php 

class Permission extends BaseClass
	{
		public $id, $name, $data;
		private $array_healthy = array("permissionData-id", "permissionData-name", "permissionData-data");
		private $array_yummy = array("id", "name", "data");
		private $array_forms =  array(
				"id" => array(
					"active" => true
					, "readonly" => "readonly=\"\""
					, "disabled" => ""
					, "label" => "ID"
					, "type" => "text"
					, "name" => "permissionData-id"
					, "key" => "id"
				)
				, "name" => array(
					"label" => "Nombre del Rol"
					, "type" => "text"
					, "name" => "permissionData-name"
					, "key" => "name"
				)
				, "data" => array(
					"label" => "Permisos (Formato JSON)"
					, "type" => "textarea"
					, "name" => "permissionData-data"
					, "key" => "data"
				)
			);
			
		private $array_forms_create =  array(
				"id" => array(
					"active" => false
					, "readonly" => "readonly=\"\""
					, "disabled" => ""
					, "label" => "ID"
					, "type" => "text"
					, "name" => "permissionData-id"
					, "key" => "id"
				)
				, "name" => array(
					"label" => "Nombre del Rol"
					, "type" => "text"
					, "name" => "permissionData-name"
					, "key" => "name"
				)
				, "data" => array(
					"label" => "Permisos (Formato JSON)"
					, "type" => "textarea"
					, "name" => "permissionData-data"
					, "key" => "data"
				)
			);
	   
	   function __construct($params=null)
	   {
			if(isset($params->id) && $params->id > 0){ $this->load_by_id($params->id); }
			
			foreach($this->array_forms as $k => $v)
				{
					if(is_array($v))
						{
							if(isset($this->{$k}))
								{
									$this->array_forms[$k]['value'] = $this->{$k};
								}
						}
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
				$this->set_data($resultOne);
				$this->data = json_decode($this->data);
			}
	   }
		
		function form()
			{
				return $this->array_forms;
					
			}
		
		function form_create()
			{
				return $this->array_forms_create;
			}

		function update_by_form($fields = null)
			{
				if(isset($fields['form-permissionData']) && $fields['form-permissionData'] == true)
					{
						foreach($this->array_forms as $k => $v)
							{
								if(is_array($v))
									{
										if(isset($this->{$k}))
											{
												$f_t = "permissionData-{$k}";
												if(isset($fields[$f_t]))
													{
														$this->{$k} = $fields[$f_t];
														$this->array_forms[$k]['value'] = $fields[$f_t];
													}
												
											}
									}
							}
						$this->update_by_id($fields);
					}
			}
		
		function create_by_form($fields = null)
			{
				if(isset($fields['form-permissionData-create']) && $fields['form-permissionData-create'] == true)
					{
						foreach($this->array_forms_create as $k => $v)
							{
								if(is_array($v))
									{
										if(isset($this->{$k}))
											{
												$f_t = "permissionData-{$k}";
												if(isset($fields[$f_t]))
													{
														$this->{$k} = $fields[$f_t];
														$this->array_forms_create[$k]['value'] = $fields[$f_t];
													}
												
											}
									}
							}
						
						$this->create($fields);						
					}
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
						$sql = "INSERT INTO `".TABLE_ROLES."` (".implode(',', $dataFields).")
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
						
						$sql = "UPDATE `".TABLE_ROLES."` SET ".implode(',', $dataArray)." WHERE `id`='{$dataRet->id}'";
									
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
