<?php
	try {
		$db = new PDO('mysql:host=localhost;dbname=openit', 'root', 'a');
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
?>