<?php 
session_start();

//Configurações gerais
require 'system/config.php';
//Rotas do sistema
require 'app/config/routes.php';
// constantes
require 'system/constant.php';

require 'vendor/autoload.php';

//Carregamento automático de classes
spl_autoload_register(function($class) {
	if(file_exists('app/controllers/'.$class.'.php')){
		require_once 'app/controllers/'.$class.'.php';			
	}	elseif (file_exists('app/models/'.$class.'.php')) {
		require_once 'app/models/'.$class.'.php';
	} elseif(file_exists('system/'.$class.'.php')){
		require_once 'system/'.$class.'.php';
	} else {
		$dir_modules = 'app/modules/';
		$modules = scandir($dir_modules);
		foreach ($modules as $key => $value) { 
			if (!in_array($value,array(".",".."))) { 
				if (is_dir($dir_modules.$value.'/models')) { 
					if(file_exists('app/modules/'.$value.'/models/'.$class.'.php')) {				
						require_once 'app/modules/'.$value.'/models/'.$class.'.php';
					}
				}			 
			} 			
		} 		
	}
});

//Inicializando a aplicação
$core = new Core();
$core->run();
?>