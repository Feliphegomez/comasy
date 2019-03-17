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
- _cms
	- controllers
	- db
	- models
	- views

### Variables

#### ´$website´ (Object)

##### Respuesta: 

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
	$ session  =  new Session ( ) ;
~~~
Y configura nuestros datos de sesión con la $_SESSIONvariable como de costumbre.

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

Además, si usa esto en sus aplicaciones, tenga la amabilidad de dejar el texto del encabezado adicional en la parte superior.# comasy
