<?php 

//autoload das bibliotecas do composer
require_once("vendor/autoload.php");

/**
 * carrega os controllers
 * @param type function($nameClass 
 */
spl_autoload_register(function($nameClass){

	$dirClass = "class/Controller";

	$filename = str_replace ("\\", "/", $dirClass . DIRECTORY_SEPARATOR . $nameClass . ".class.php");
	if(file_exists($filename)){
		require_once($filename);
	}

});

/**
 * carrega os models
 * @param type function($nameClass 
 */
spl_autoload_register(function($nameClass){

	$dirClass = "class/Model";

	$filename = str_replace ("\\", "/", $dirClass . DIRECTORY_SEPARATOR . $nameClass . ".class.php");
	if(file_exists($filename)){
		require_once($filename);
	}

});

/**
 * carrega os views
 * @param type function($nameClass 
 */
spl_autoload_register(function($nameClass){

	$dirClass = "class/View";

	$filename = str_replace ("\\", "/", $dirClass . DIRECTORY_SEPARATOR . $nameClass . ".class.php");
	if(file_exists($filename)){
		require_once($filename);
	}

});




?>