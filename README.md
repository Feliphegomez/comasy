# comasy
# ¿Como funciona el MVC?

El funcionamiento básico del patrón MVC, puede resumirse en:

1. El usuario realiza una petición.
2. El controlador captura la petición.
3. Hace la llamada al modelo correspondiente.
4. El modelo sera el encargado de interactuar con la base de datos.
5. El controlador recibe la información y la enviá a la vista.
6. La vista muestra la información.

Esquema muy claro del funcionamiento del MVC en PHP de http://www.phpzag.com/php-model-view-controller-mvc/

## Estructura
~~~sh
	.
	├── _cms
	│   ├── config
	│   ├── global
	│   │   ├── css
	│   │   ├── fonts
	│   │   └── js
	│   ├── plugins
	│   │   ├── pages
	│   │   │   ├── controllers
	│   │   │   ├── models
	│   │   │   ├── modules
	│   │   │   │   ├── list
	│   │   │   │   │   └── sections
	│   │   │   │   └── single
	│   │   │   │       └── sections
	│   │   │   └── views
	│   │   └── system
	│   │       ├── controllers
	│   │       ├── models
	│   │       ├── modules
	│   │       │   ├── dashboard
	│   │       │   │   └── sections
	│   │       │   ├── login
	│   │       │   │   └── sections
	│   │       │   ├── roles
	│   │       │   │   └── sections
	│   │       │   └── users
	│   │       │       └── sections
	│   │       └── views
	│   └── themes
	└── docs
~~~



### Variables

#### ´$website´ (Object)
##### Respuesta: 
~~~json
	{
	  "session": {
		"alive": true,
		"dbc": {
		  "affected_rows": null,
		  "client_info": null,
		  "client_version": null,
		  "connect_errno": null,
		  "connect_error": null,
		  "errno": null,
		  "error": null,
		  "error_list": null,
		  "field_count": null,
		  "host_info": null,
		  "info": null,
		  "insert_id": null,
		  "server_info": null,
		  "server_version": null,
		  "stat": null,
		  "sqlstate": null,
		  "protocol_version": null,
		  "thread_id": null,
		  "warning_count": null
		},
		"id": "1",
		"username": "admin",
		"permissions": "{ ... }",
		"names": "Administrador",
		"surname": "System",
		"second_surname": "COMASY",
		"hash": "admin",
		"user_ip": "0.0.0.0"
	  },
	  "session_server": {
		"id": "1",
		"username": "admin",
		"permissions": " ... ",
		"names": "Administrador",
		"surname": "System",
		"second_surname": "COMASY",
		"hash": "admin",
		"user_ip": "0.0.0.0"
	  },
	  "options": {
		"themes": [
		  "Glance",
		  "Unique"
		],
		"options_themes": [
		  {
			"text": "None",
			"value": "none"
		  },
		  ...
		],
		"site_url": "http:\/\/comasy.demo\/",
		"site_name_sm": "CMS",
		"site_name_md": "Sistema de gesti\u00f3n de contenidos",
		"site_name_lg": "Sistema de gesti\u00f3n de contenidos by FelipheGomez",
		"site_description": "Sistema de gesti\u00f3n de contenidos creado por Andres Felipe Gomez Maya o FelipheGomez.",
		"home_path": "http:\/\/comasy.demo\/",
		"admin_path": "http:\/\/comasy.demo\/ingresemos.html",
		"use_smilies": "1",
		"admin_email": "webmaster@comasy.demo",
		"mailserver_url": "mail.example.com",
		"mailserver_login": "login@example.com",
		"mailserver_pass": "password",
		"mailserver_port": "110",
		"default_category": "1",
		"posts_per_page": "10",
		"date_format": "j F, Y",
		"time_format": "g:i a",
		"links_updated_date_format": "j F, Y g:i a",
		"comment_moderation": "0",
		"active_plugins": "{\"name\":\"demo\",\"config\":\"demo.php\"}",
		"default_email_category": "1",
		"comment_registration": "0",
		"upload_url_path": "",
		"image_default_link_type": "none",
		"image_default_size": "",
		"image_default_align": "",
		"page_comments": "0",
		"comments_per_page": "50",
		"comment_order": "asc",
		"timezone_string": "America\/Bogota",
		"default_post_format": "0",
		"site_icon": "444",
		"current_theme": "Unique",
		"admin_theme": "Glace"
	  },
	  "error": false,
	  "page": {
		"id": "1",
		"url": "\/admin\/",
		"plugin": "system",
		"module": "dashboard",
		"section": "dashboard",
		"id_route": "none",
		"created_at": "2019-02-06 19:34:21",
		"update_at": "2019-03-26 16:48:53",
		"theme": "Glance",
		"session_required": "1"
	  },
	  "method": "GET",
	  "path": "\/admin\/",
	  "fullpath": "http:\/\/comasy.demo:80\/admin\/",
	  "site_url": "http:\/\/comasy.demo",
	  "action": "view",
	  "fields": [

	  ],
	  "scheme": "http",
	  "server_name": "comasy.demo",
	  "server_port": "80",
	  "plugin": "admin",
	  "module": null,
	  "section": null,
	  "id_detect": null,
	  "id": null
	}
~~~

### Session
Eso es todo listo. Todo lo que tienes que hacer ahora es llamarlo en una línea.

~~~php
<?php 
	require_once("_cms/autoload.php");
	$website = new Site();
~~~

La ID de usuario anterior se almacenará dentro del campo "datos" en su base de datos, en un formato serializado que la clase podrá analizar.

Así que ahí lo tienen, una CMS simple que puede usar para cualquier proyecto web CRM.

Además, si usa esto en sus aplicaciones, tenga la amabilidad de dejar los texto adicionales de autores y colaboradores.
