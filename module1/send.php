<?php 
require_once('helpers/protect_from_guest.php');

require_once('helpers/setsession.php');

require_once('helpers/dbconnect.php');


if(!isset($_SESSION['user_id'])){
	header('Location: index.php');
	exit();
}

if(isset($_POST) && !empty($_POST)){
	$contact_list_id=stripcslashes($_POST['contact_lists_id']);
	$title=stripcslashes($_POST['title']);
	$desc=stripcslashes($_POST['description']);


	$stmt=$db->prepare("SELECT * from contacts WHERE contact_lists_id=?");

	$stmt->execute([
		$contact_list_id
	]);

	$contacts=[];
	while($contact=$stmt->fetch(PDO::FETCH_OBJ)){
		$contacts[]=$contact;
	}

	$stmt=$db->prepare("INSERT INTO messages_sent(user_id,m_datetime,subject,email,html_message,status) VALUES(?,?,?,?,?,?)");

	foreach($contacts as $contact){
		$values=[
			$_SESSION['user_id'],
			time(),
			$title,
			$contact->email,
			$desc
		];

		if(mail($contact->email,$title,$desc,'From: zorkanov.93@gmail.com')){
			$values[]='S';
			$stmt->execute($values);
		}else{
			$values[]='N';
			$stmt->execute($values);
		}
	}
}

$stmt=$db->prepare("SELECT * from contact_lists WHERE users_id=?");
$stmt->execute([
	$_SESSION['user_id']
]);

$contact_lists=[];
while($contact_list=$stmt->fetch(PDO::FETCH_OBJ)){
	$contact_lists[]=$contact_list;
}
?>

<?php require_once('layouts/header.php');?>
	<form action="" method="POST"  class="well form-horizontal">
		<fieldset>
		<div class="row">
				<div class="form-group">
					<label for="contact_list_id" class="col-md-4 control-label">Список контактов</label>
					<div class="col-md-4 inputGroupContainer">
						<select name="contact_lists_id" id="contact_lists_id" class="form-control">
							<?php foreach($contact_lists as $contact_list){?>
								<option value="<?= $contact_list->contact_lists_id?>"><?= $contact_list->name?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="title" class="col-md-4 control-label">Название</label>
					<div class="col-md-4 inputGroupContainer">
						<input type="text" name="title" id="title" class="form-control" />
					</div>
				</div>
				<div class="form-group" >
					<label for="desc" class="col-md-4 control-label">Описание</label>
					<div class="col-md-4 inputGroupContainer">
						<textarea name="description" id="desc" class="form-control" /></textarea>
					</div>
				</div>
				<div class="form-group" >
					<label for="desc" class="col-md-4 control-label"></label>
					<div class="col-md-4 inputGroupContainer">
						<button class="btn btn-default right">Отправить</button>
					</div>
				</div>
		</div>
	</form>

<?php require_once('layouts/footer.php');?>