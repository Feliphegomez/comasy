<?php 

class Users 
	{		
		public function __construct()
			{
				try {
					$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
					$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $pdo->prepare("SELECT `users`.* FROM `users` ");			
					$pdo->exec("SET CHARACTER SET utf8; SET COLLATION SET utf8_unicode_ci");
					$stmt->execute();
					$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
					foreach($result as $user)
						{
							$usuario = new User($user);
							
							$temp = new stdClass();
							$temp->id = $usuario->permissions;
							$usuario->permissions = new Permission($temp);
							
							
							$this->{$user->username} = $usuario;
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

class User
	{
		public $id, $username, $permissions, $names, $surname, $second_surname, $mail, $phone, $mobile, $avatar;
		private $array_healthy = array("userData-id", "userData-username", "userData-names", "userData-surname", "userData-second_surname", "userData-phone", "userData-mobile", "userData-avatar", "userData-mail", "userData-hash", "userData-permissions");
		private $array_yummy = array("id", "username", "names", "surname", "second_surname", "phone", "mobile", "avatar", "mail", "hash", "permissions");
		private $array_labels = array("id", "Usuario", "Nombres", "Primer Apellido", "Segundo Apellido", "Telefono", "Movil", "Avatar", "Correo Electronico", "Contraseña", "Permisos");
		
		private $array_permissions = null;
		private $array_forms =  array(
				"id" => array(
					"active" => true
					, "readonly" => "readonly=\"\""
					, "disabled" => ""
					, "label" => "ID"
					, "type" => "text"
					, "name" => "userData-id"
					, "key" => "id"
				)
				, "username" => array(
					"label" => "Usuario"
					, "type" => "text"
					, "name" => "userData-username"
					, "key" => "username"
				)
				, "names" => array(
					"label" => "Nombres"
					, "type" => "text"
					, "name" => "userData-names"
					, "key" => "names"
				)
				, "surname" => array(
					"label" => "Primer Apellido"
					, "type" => "text"
					, "name" => "userData-surname"
					, "key" => "surname"
				)
				, "second_surname" => array(
					"label" => "Primer Apellido"
					, "type" => "text"
					, "name" => "userData-second_surname"
					, "key" => "second_surname"
				)
				, "phone" => array(
					"label" => "Telefono"
					, "type" => "text"
					, "name" => "userData-phone"
					, "key" => "phone"
				)
				, "mobile" => array(
					"label" => "Movil"
					, "type" => "text"
					, "name" => "userData-mobile"
					, "key" => "mobile"
				)
				, "avatar" => array(
					"active" => false
					, "label" => "Avatar"
					, "type" => "text"
					, "name" => "userData-avatar"
					, "key" => "avatar"
				)
				, "mail" => array(
					"label" => "Correo Electronico"
					, "type" => "mail"
					, "name" => "userData-mail"
					, "key" => "mail"
				)
				, "hash" => array(
					"active" => false
					, "readonly" => "readonly=\"\""
					, "disabled" => "disabled=\"\""
					, "label" => "Contraseña"
					, "type" => "password"
					, "name" => "userData-hash"
					, "key" => "hash"
				)
				, "permissions" => array(
					"label" => "Permisos"
					, "type" => "select"
					, "name" => "userData-permissions"
					, "key" => "permissions"
					, "list" => array()
				)
			);
		private $array_forms_create =  array(
				"id" => array(
					"active" => false
					, "readonly" => "readonly=\"\""
					, "disabled" => ""
					, "label" => "ID"
					, "type" => "text"
					, "name" => "userData-id"
					, "key" => "id"
				)
				, "username" => array(
					"label" => "Usuario"
					, "type" => "text"
					, "name" => "userData-username"
					, "key" => "username"
				)
				, "names" => array(
					"label" => "Nombres"
					, "type" => "text"
					, "name" => "userData-names"
					, "key" => "names"
				)
				, "surname" => array(
					"label" => "Primer Apellido"
					, "type" => "text"
					, "name" => "userData-surname"
					, "key" => "surname"
				)
				, "second_surname" => array(
					"label" => "Primer Apellido"
					, "type" => "text"
					, "name" => "userData-second_surname"
					, "key" => "second_surname"
				)
				, "phone" => array(
					"label" => "Telefono"
					, "type" => "text"
					, "name" => "userData-phone"
					, "key" => "phone"
				)
				, "mobile" => array(
					"label" => "Movil"
					, "type" => "text"
					, "name" => "userData-mobile"
					, "key" => "mobile"
				)
				, "avatar" => array(
					"active" => false
					, "label" => "Avatar"
					, "type" => "text"
					, "name" => "userData-avatar"
					, "key" => "avatar"
				)
				, "mail" => array(
					"label" => "Correo Electronico"
					, "type" => "mail"
					, "name" => "userData-mail"
					, "key" => "mail"
				)
				, "hash" => array(
					"active" => true
					, "readonly" => ""
					, "disabled" => ""
					, "label" => "Contraseña"
					, "type" => "password"
					, "name" => "userData-hash"
					, "key" => "hash"
				)
				, "permissions" => array(
					"label" => "Permisos"
					, "type" => "select"
					, "name" => "userData-permissions"
					, "key" => "permissions"
					, "list" => array()
				)
			);

		function __construct($params=null)
			{
				$this->array_permissions = new Permissions();
				$this->array_forms['permissions']['list'] = $this->array_permissions->list;
				$this->array_forms_create['permissions']['list'] = $this->array_permissions->list;
				
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
			   #return ($this->username);
			   return "{$this->names} {$this->surname} {$this->second_surname}";
		   }
		
		# Se esta validando esta funcion para poder ejecutar la sessio.
		function load_by_id($id)
			{
				$sql = "SELECT `users`.*
				FROM `users` 
				WHERE `users`.id='{$id}'";
				
				$conexion = Conectar::conexion();
				$result = Conectar::get_data($conexion->query($sql));
				
				if(isset($result[0])){
					$resultOne = (object) $result[0];
				
					$this->set_data($resultOne);
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
					$this->set_data($resultOne);
				}
		   }
	   
	   function set_data($data)
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
		
		function form_create()
			{
				return $this->array_forms_create;
			}
			
		function form()
			{
				return $this->array_forms;
			}
		
		function create_by_form($fields = null)
			{
				if(isset($fields['form-userData-create']) && $fields['form-userData-create'] == true)
					{
						foreach($this->array_forms_create as $k => $v)
							{
								if(is_array($v))
									{
										if(isset($this->{$k}))
											{
												$f_t = "userData-{$k}";
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
		
		function update_by_form($fields = null)
			{
				if(isset($fields['form-userData']) && $fields['form-userData'] == true)
					{
						foreach($this->array_forms as $k => $v)
							{
								if(is_array($v))
									{
										if(isset($this->{$k}))
											{
												$f_t = "userData-{$k}";
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
	}
