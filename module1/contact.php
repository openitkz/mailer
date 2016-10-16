<?php

require_once('helpers/protect_from_guest.php');

require_once('helpers/dbconnect.php');

if(isset($_GET) && !empty($_GET['id'])){

	$id=$_GET['id'];

	if(isset($_POST) && !empty($_POST)){
		$name=stripcslashes($_POST['name']);
		$surname=stripcslashes($_POST['surname']);
		$email=stripcslashes($_POST['email']);
		$stmt=$db->prepare("INSERT INTO contacts(name,surname,email,contact_lists_id) VALUES(?,?,?,?)");

		$stmt->execute([
			$name,
			$surname,
			$email,
			$id
		]);
	}

	$stmt=$db->prepare("SELECT c.* FROM contacts as c INNER JOIN contact_lists as c_l ON c.contact_lists_id=c_l.contact_lists_id WHERE c_l.contact_lists_id=? AND c_l.users_id=?");
	$stmt->execute([
		$id,
		$_SESSION['user_id']
	]);

	$contacts=[];
	while($contact=$stmt->fetch(PDO::FETCH_OBJ)){
		$contacts[]=$contact;
	}
}else{
	header('Location: contacts.php');
	exit();
}

?>

<?php require_once('layouts/header.php');?>

	<form action="" method="POST"  class="well form-horizontal">
		<fieldset>
			<div class="form-group">
				<label for=""  class="col-md-4 control-label">Имя</label>
				<div class="col-md-4 inputGroupContainer">
					<input type="text" name="name" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-md-4 control-label">Фамилия</label>
				<div class="col-md-4 inputGroupContainer">
					<input type="text" name="surname" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-md-4 control-label">Email</label>
				<div class="col-md-4 inputGroupContainer">
					<input type="text" name="email" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label"></label>
				<div class="col-md-4 inputGroupContainer">
					<button class="btn btn-default">Добавить</button>
				</div>
			</div>
		</fieldset>
	</form>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Имя</th>
				<th>Фамилия</th>
				<th>email</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($contacts as $contact){ ?>
				<tr>
					<td><?= $contact->name?></td>
					<td><?= $contact->surname?></td>
					<td><?= $contact->email?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>

<?php require_once('layouts/footer.php');?>

