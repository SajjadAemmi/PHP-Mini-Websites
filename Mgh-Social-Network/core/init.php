<?php
	session_start();
	
	define('DB_HOST','localhost');
	define('DB_USER','root');
	define('DB_PASS','');
	define('DB_NAME','mgh');
	
	define('SITE_TITLE','Wellcome To <b>Yas</b> Social Network!');
	
	define('BASE_URI','http://'.$_SERVER['SERVER_NAME'].'/mgh/');

	require_once('core/functions.php');
		
	function __autoload($class_name)
	{
		require_once('libraries/'.$class_name.'.php');
	}
?>