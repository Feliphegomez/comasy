<?php
define('MODE_DEBUG', true);
#define('MODE_DEBUG', false); 
 
// Access DB
# define('DRIVER_DB', 'MySQLi');
define('DRIVER_DB', 'PDO');
define('HOST_DB', 'localhost');
define('NAME_DB', 'feliphegomez_cms');
define('USER_DB', 'feliphegomez_cms');
define('PASS_DB', 'feliphegomez_cms');

// TABLES DB
define('TABLE_ROUTE', 'routes');
define('TABLE_OPTIONS', 'options');
define('TABLE_MENUS', 'menus');
define('TABLE_ROLES', 'permissions');
define('TABLE_SESSIONS', 'sessions');

# ---------------- ABSOLUTE ----------------
// Active Errors PHP
if(MODE_DEBUG == true)
{
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
}


ini_set('max_user_connections', 1);
ini_set('max_connections', 1);

date_default_timezone_set('America/Bogota');