<?php
require_once('../helpers/protect_from_guest.php');

require_once('../helpers/setsession.php');

require_once('../helpers/dbconnect.php');
if(isset($_GET) && !empty($_GET)){

	$contact_list_id=$_GET['contact_list_id'];

	$stmt=$db->prepare("SELECT * from contacts WHERE contact_lists_id=?");

	$stmt->execute([
		$contact_list_id
	]);

	$contacts=[];
	while($contact=$stmt->fetch(PDO::FETCH_OBJ)){
		$contacts[]=$contact;
	}
	echo json_encode($contacts);

}