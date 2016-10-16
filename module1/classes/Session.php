<?php

class Session{
	public static function guest(){
		return !isset($_SESSION['user_id']);
	}
}