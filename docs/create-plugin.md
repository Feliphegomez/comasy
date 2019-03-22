# Crear Plugin

## Caracteres no permitidos en el nombre
- Los caracteres # % & * { } \ : < > ? / + son prohibidos de utilizar en cualquier elemento del plugin.
- Es prohibido iniciar o terminar con un espacio o un línea inferior ( _ ).
- Es prohibido terminar con un punto.
- Comas no son ilegales, pero cuando se utilizan programáticamente pueden producir problemas pues en métodos con diferentes parámetros, el separador es una coma.

## Estructura
	- _cms
		- plugins
			- {nombre_plugin}
				- controllers
					- {nombre_controlador}
				- models
				- modules
					- {nombre_modulo}
						- sections
							- {nombre_section}
				- views
					- {nombre_visor}
		- themes
			- {nombre_tema} (donde se va a crear la ejecucion.)
				- templates
					- {nombre_modelo}

## Route - parametros
- URL
- nombre_plugin
- nombre_modulo
- nombre_section
- ID o Selector adicional para mejor filtrado o crear archivos dinamicos.

## Ejemplos de archivos

### Section - _cms/plugins/{nombre_plugin}/modules/{nombre_modulo}/views/{nombre_section}.php
```php
<?php 
	$website->get_controller_plugin('nombre_plugin', 'nombre_controlador'); // 
	$website->get_view_plugin('nombre_plugin', 'nombre_visor');
```

### Controller - _cms/plugins/{nombre_plugin}/controllers/{nombre_controlador}_controller.php
#### Ejemplo 1
```php
<?php 
	$id = (int) $website->page->id_route;
	global $info;

	if($id > 0) 
		{
			$info = new Model($id);
		}
	else if(isset($website->fields['id'])) 
		{
			$id_field = (int) $website->fields['id'];
			if($id_field > 0)
				{
					$id_field = (int) $website->fields['id'];
					$info = new Model($id_field);
				}
		}
```

### View - _cms/plugins/{nombre_plugin}/views/{nombre_visor}_view.php
```php
<?php 
	$website->get_template_theme(nombre_modelo);
```

### View - _cms/themes/{nombre_tema}/templates/{nombre_modelo}.php
```php
<?php 
	global $website, $info;
	// Tu Codigo ...
```