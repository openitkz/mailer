<?php

if(!isset($_SESSION)){
	session_start();
}

spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.php';
});


$db=DB::getInstance();

/*function autoload($path){
	$files=array_diff(scandir($path), array('.', '..'));
	foreach($files as $file){
		include($path.$file);
	}
}

autoload('classes/');*/