<?php 

	require_once 'config/app.php';

	session_destroy();

	Redirect::to('index');