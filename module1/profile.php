<?php
require_once('helpers/protect_from_guest.php');

require_once('helpers/dbconnect.php');

if(isset($_POST) && !empty($_POST)){
	$name=stripcslashes($_POST['username']);
	if(!empty($_POST['password'])){
		$password=stripcslashes(sha1($_POST['password']));
	}
	$email=stripcslashes($_POST['email']);

	$sql="UPDATE users SET username=?";
	if(isset($password)){
		$sql.=", password=?";
	}

	$stmt=$db->prepare($sql);

	$updateVars=[$name];
	if(isset($password)){
		$updateVars[]=$password;
	}

	$stmt->execute($updateVars);

	header('Location: profile.php');
	exit();
}

$stmt=$db->prepare("SELECT username,password FROM users WHERE user_id=?");
$stmt->execute([
	$_SESSION['user_id']
]);

$user=$stmt->fetch(PDO::FETCH_OBJ);
?>
<?php 
	require_once('layouts/header.php');
?>
    <div class="row">
            <form class="form-login well form-horizontal" action="" method="POST" >
	            <h4>Change profile</h4>
	            <fieldset>
		            <div class="form-group">
		            	<label for="userName"  class="col-md-4 control-label">Имя</label>
		            	<div class="col-md-4 inputGroupContainer">
		            		<input type="text" id="userName" name="username" class="form-control input-sm chat-input" placeholder="username" value="<?= $user->username?>"/>
		            	</div>
		            </div>
		            <div class="form-group">
		            	<label for="userPassword"  class="col-md-4 control-label">Пароль</label>
		            	<div class="col-md-4 inputGroupContainer">
		            		<input type="password" id="userPassword" name="password" class="form-control input-sm chat-input" placeholder="new password"/>
		            	</div>
		            </div>
		            <div class="wrapper">
		            	<label for=""  class="col-md-4 control-label"></label>
		            	<div class="col-md-4 inputGroupContainer">
	
			                <button href="#" class="btn btn-primary btn-md">save updates <i class="fa fa-sign-in"></i></button>
			            </div>
		            </div>
		        </fieldset>
            </form>
    </div>

<?php 
	require_once('layouts/footer.php');
?>

