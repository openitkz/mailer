<?php 

	require_once('helpers/protect_from_guest.php');

	session_destroy();

	header('Location: index.php');
	exit();