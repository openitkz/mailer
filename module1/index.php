<?php
require_once 'config/app.php';

Guard::protect(true,'login');

$user=$db->query("SELECT username FROM users WHERE user_id= ? ",[
	$_SESSION['user_id']
	]);

?>

<?php require_once('layouts/header.php');?>
      <h1>Welcome <?= $user->username; ?></h1>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
      <hr>
      <h3>Test</h3>
      <p>Lorem ipsum...</p>
<?php require_once('layouts/footer.php');?>

