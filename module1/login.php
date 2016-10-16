<?php
require_once 'config/app.php';

Guard::protect(false);

if(isset($_POST) && !empty($_POST)){
	$username=stripcslashes($_POST['username']);
	$password=stripcslashes(sha1($_POST['password']));

	$res = $db->query("SELECT user_id FROM users WHERE username=? AND password=?",[
			$username, $password
		])->first();

	if($res){
		$_SESSION['user_id']=$res->user_id;
		Redirect::to('index');
	}else{
		$errors='Invalid login or password!';
	}
}
?>

<?php 
	require_once('layouts/header.php');
?>
    <div class="row">
        <div class="col-md-offset-5 col-md-3">
        	<?php include_once('layouts/errors.php');?>
            <form class="form-login" action="" method="POST">
	            <h4>Login</h4>
	            <input type="text" id="userName" name="username" class="form-control input-sm chat-input" placeholder="username" />
	            </br>
	            <input type="password" id="userPassword" name="password" class="form-control input-sm chat-input" placeholder="password" />
	            </br>
	            <div class="wrapper">
		            <span class="group-btn">     
		                <button href="#" class="btn btn-primary btn-md">login <i class="fa fa-sign-in"></i></button>
		            </span>
	            </div>
            </form>
        
        </div>
    </div>

<?php 
	require_once('layouts/footer.php');
?>