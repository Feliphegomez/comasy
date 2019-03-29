# .: COMASY :.
### ¿Como funciona COMASY?
**COMASY** funciona con metodos ***MVC*** (*Module-View-Controller*) que en español traduce (*Modulo-Vista-Controlador*), El funcionamiento básico de este metodo o patron, puede resumirse en lo siguiente:

 1. El usuario realiza una petición.
 2. El controlador captura la petición.
 3. Hace la llamada al modelo correspondiente.
 4. El modelo sera el encargado de interactuar con la base de datos.
 5. El controlador recibe la información y la enviá a la vista.
 6. La vista muestra la información.

![alt text][mvc_001]

Si quieres saber más sobre el funcionamiento del MVC en PHP de http://www.phpzag.com/php-model-view-controller-mvc/

## Estructura
~~~ssh
	├── _cms
	│   ├── config
	│   ├── global
	│   │   ├── css
	│   │   ├── fonts
	│   │   └── js
	│   ├── libs
	│   ├── plugins
	│   │   ├── admin
	│   │   │   ├── controllers
	│   │   │   ├── models
	│   │   │   ├── modules
	│   │   │   │   ├── login
	│   │   │   │   │   └── sections
	│   │   │   │   └── pages
	│   │   │   │       └── sections
	│   │   │   └── views
	│   │   ├── pages
	│   │   │   ├── controllers
	│   │   │   ├── models
	│   │   │   ├── modules
	│   │   │   │   ├── list
	│   │   │   │   │   └── sections
	│   │   │   │   └── single
	│   │   │   │       └── sections
	│   │   │   └── views
	│   │   └── site
	│   │       ├── controllers
	│   │       ├── modules
	│   │       │   └── pages
	│   │       │       └── sections
	│   │       └── views
	│   └── themes
	│       ├── Glance
	│       │   ├── css
	│       │   ├── fonts
	│       │   ├── images
	│       │   ├── includes
	│       │   ├── js
	│       │   │   └── images
	│       │   └── templates
	│       └── Unique
	│           ├── css
	│           ├── fonts
	│           ├── images
	│           ├── includes
	│           └── templates
	└── docs
~~~

### Variables
(Object) `$website`

#### Respuesta: 
~~~json
	{
	  "error": false,
	  "page": {
		"id": "3",
		"url": "\/index.html",
		"plugin": "admin",
		"module": "demo",
		"section": "index",
		"id_route": "none",
		"created_at": "2019-03-15 15:45:26",
		"update_at": "2019-03-15 15:45:26"
	  },
	  "method": "GET",
	  "path": "\/index.html",
	  "fullpath": "http:\/\/cms.ltsolucion.com:80\/index.html",
	  "action": "view",
	  "fields": [
		
	  ],
	  "scheme": "http",
	  "server_name": "cms.ltsolucion.com",
	  "server_port": "80",
	  "plugin": "index.html",
	  "module": null,
	  "section": null,
	  "id_detect": null,
	  "id": null
	}
~~~

### Session
Eso es todo listo. Todo lo que tienes que hacer ahora es llamarlo en una línea.
~~~
	$ session  =  new Session();
~~~

Y configura nuestros datos de sesión con la $_SESSION variable como de costumbre.

~~~
	$session = new Session();
	$_SESSION['user_id'] = 1;
~~~
La ID de usuario anterior se almacenará dentro del campo "datos" en su base de datos, en un formato serializado que la clase podrá analizar.

Ya que se maneja desde una clase, la variable también se llamará session_write_close();por sí misma cuando la página termine, por lo que no es necesario que lo llame usted mismo. Sin embargo, si desea finalizarlo antes, siempre puede llamar al destructor manualmente.

~~~
	$session = new Session();
	// ... extra code ...
	$session->__destruct();
~~~

La sesión también se puede eliminar (como cuando se cierra la sesión) y para ello solo llamamos al método de eliminación.

~~~
	$session = new Session();
	// ... extra code ...
	$session->__destruct();
~~~

Así que ahí lo tienen, una clase de manejo de sesión simple que puede usar para cualquier proyecto web.

Además, si usa esto en sus aplicaciones, tenga la amabilidad de dejar el texto del encabezado adicional en la parte superior.

[mvc_001]: https://si.ua.es/es/documentacion/asp-net-mvc-3/imagenes/introduccion/flujo-mvc.png "Grafico MVC"