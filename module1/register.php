<?php
	require_once('helpers/protect_from_logined.php');

	require_once('helpers/dbconnect.php');

	if(isset($_POST) && !empty($_POST)){
		$name=stripcslashes($_POST['username']);
		$password=stripcslashes(sha1($_POST['password']));

		$stmt=$db->prepare("INSERT INTO users(username, password) VALUES(?,?)");

		$stmt->execute([
			$name,
			$password
		]);

		header('Location: index.php');

		exit();
	}

?>

<?php 
	require_once('layouts/header.php');
?>
    <div class="row">
        <div class="col-md-offset-5 col-md-3">
            <form class="form-login" action="" method="POST">
	            <h4>Register</h4>
	            <input type="text" id="userName" name="username" class="form-control input-sm chat-input" placeholder="username" />
	            </br>
	          	<input type="text" id="name" name="name" class="form-control input-sm chat-input" placeholder="name" />
	            <br>
	            <input type="text" id="surname" name="surname" class="form-control input-sm chat-input" placeholder="surname" />
	            <br>
	            <input type="password" id="userPassword" name="password" class="form-control input-sm chat-input" placeholder="password" />
	            </br>
	            <div class="wrapper">
		            <span class="group-btn">     
		                <button href="#" class="btn btn-primary btn-md">login<i class="fa fa-sign-in"></i></button>
		            </span>
	            </div>
            </form>
        
        </div>
    </div>
<?php 
	require_once('layouts/footer.php');
?>