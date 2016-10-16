<?php

class Guard{
	public static function protect($guest=true, $redirect='index'){
		if($guest){
			if(!isset($_SESSION['user_id'])){
				self::redirect($redirect);
			}
		}else{
			if(isset($_SESSION['user_id'])){
				self::redirect($redirect);
			}
		}
	}

	private static function redirect($redirect){
		header('Location: '.$redirect.'.php');
		exit();
	}
}