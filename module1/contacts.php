<?php

require_once('helpers/protect_from_guest.php');

require_once('helpers/dbconnect.php');

if(isset($_GET) && !empty($_GET['id'])){
	$id=$_GET['id'];
	$stmt=$db->prepare("DELETE FROM contact_lists WHERE contact_lists_id=?");

	$stmt->execute([
		$id
	]);
}else if(isset($_POST) && !empty($_POST)){
	$name=stripcslashes($_POST['name']);
	$description=stripcslashes($_POST['description']);

	$stmt=$db->prepare("INSERT INTO contact_lists(name,description,users_id) VALUES(?,?,?)");

	$stmt->execute([
		$name,
		$description,
		$_SESSION['user_id']
	]);
}

$stmt=$db->prepare("SELECT c.* FROM contact_lists as c INNER JOIN users as u ON u.user_id=c.users_id AND u.user_id=?");

$stmt->execute([
	$_SESSION['user_id']
]);

$contact_lists=[];
while($contact_list=$stmt->fetch(PDO::FETCH_OBJ)){
	$contact_lists[]=$contact_list;
}

?>

<?php require_once('layouts/header.php');?>
	<form action="" method="POST" class="well form-horizontal">
		<fieldset>
			<div class="form-group">
				<label for="" class="col-md-4 control-label">Название</label>
				<div class="col-md-4 inputGroupContainer">
					<input type="text" name="name" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-md-4 control-label">Описание</label>
				<div class="col-md-4 inputGroupContainer">
					<textarea name="description" class="form-control"></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label"></label>
  				<div class="col-md-4">
					<button class="btn btn-default">Добавить</button>
				</div>
			</div>
		</fieldset>
	</form>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Название</th>
				<th>Описание</th>
				<th></th>
				<td></td>
			</tr>
		</thead>
		<tbody>
			<?php foreach($contact_lists as $contact_list){ ?>
				<tr>
					<td><?= $contact_list->name?></td>
					<td><?= $contact_list->description?></td>
					<td><a href="contact.php?id=<?= $contact_list->contact_lists_id?>">Перейти</a></td>
					<td>
						<a href="contacts.php?id=<?= $contact_list->contact_lists_id?>" class="btn btn-warning">Удалить</a>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>

<?php require_once('layouts/footer.php');?>