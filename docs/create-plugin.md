# Crear Plugin

## Caracteres no permitidos en el nombre
- Los caracteres # % & * { } \ : < > ? / + son prohibidos de utilizar en cualquier elemento del plugin.
- Es prohibido iniciar o terminar con un espacio o un línea inferior ( _ ).
- Es prohibido terminar con un punto.
- Comas no son ilegales, pero cuando se utilizan programáticamente pueden producir problemas pues en métodos con diferentes parámetros, el separador es una coma.

## Estructura
	_cms/
	└── plugins
	    └── {plugin-name}
	         ├── controllers
	         │   └── {controller-name}.php
	         ├── models
	         │   └── {model-name}.php
	         ├── modules
	         │   └── {module-name}
	         │       └── sections
	         │           └── {section-name}.php
	         └── views
	             └── {view-name}.php

### Mas Información
| Variable | Descripcion |
|----------|-------------|
| plugin-name | Nombre del Plugin (Plugin). |
| controller-name | Nombre del Controllador (Controller). |
| model-name | Nombre del Modelo (Model). |
| module-name | Nombre del Modulo (Module). |
| section-name | Nombre de la Seccion (Section). |
| view-name | Nombre del Visor (View). |
|----------|-------------|

### Route - Parametros SQL
- URL
- nombre del plugin = {plugin-name}
- nombre del modulo = {module-name}
- nombre de la section = {section-name}
- ID o Selector adicional para mejor filtrado o crear archivos dinamicos.

## Ejemplos de archivos

### Seccion
La seccion se debe alojar en el archivo `_cms/plugins/{plugin-name}/modules/{nombre_modulo}/sections/{section-name}.php`
```php
<?php 
	// Controlador a utilizar
	$website->get_controller_plugin('{plugin-name}', '{controller-name}');
	// Visor o Vista a utilizar
	$website->get_view_plugin('{plugin-name}', '{view-name}');
```

### Controlador
El controlador se debe alojar en el archivo `_cms/plugins/{plugin-name}/controllers/{controller-name}_controller.php`

```php
<?php 
	// Variaciones o Condiciones
	...
```

### Vista o Visor
El visor o vista se debe alojar en el archivo `_cms/plugins/{plugin-name}/views/{view-name}_view.php`

```php
<?php 
	// Esta es el nombre de la Template del Tema.
	$website->get_template_theme({template-name});
```

### Modelo
El modelo se debe alojar en el archivo `_cms/plugins/{plugin-name}/models/{model-name}_model.php`

```php
<?php 
	// Ejemplo # 1
	class MyModel extends BaseClass
	{
		...
	}
	
	// Ejemplo # 2
	class MyModel 
	{
		...
	}
```