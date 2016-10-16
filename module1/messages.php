<?php

require_once('helpers/protect_from_guest.php');

require_once('helpers/dbconnect.php');

if(isset($_GET['action']) && !empty($_GET['action'])){
	if($_GET['action']==='delete'){
		$id=stripslashes($_GET['id']);

		$stmt=$db->prepare("DELETE FROM messages_sent WHERE message_sent_id=?");

		if($stmt->execute([
			$id
		])){
			echo json_encode(['error'=>'0']);
		}else{
			echo json_encode(['error'=>'1']);
		};
		exit();
	}
}

$stmt=$db->prepare("SELECT s.* FROM messages_sent AS s WHERE s.user_id=?");

$stmt->execute([
	$_SESSION['user_id']
]);

$messages=[];
while($message=$stmt->fetch(PDO::FETCH_OBJ)){
	$messages[]=$message;
}

?>
<?php require_once 'layouts/header.php';?>
<table class="table table-bordered">
		<thead>
			<tr>
				<th>Получатель</th>
				<th>Статус</th>
				<th>Время отправки</th>
				<th>Название</th>
				<th>Текст сообщения</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($messages as $message){ ?>
				<tr>
					<td><?= $message->email?></td>
					<td><?=$message->status?></td>
					<td>
						<?= date('Y-m-d H:i:s',$message->m_datetime)?>
					</td>
					<td><?=$message->subject?></td>
					<td><?=$message->html_message?></td>
					<td><a href="?action=delete&id=<?=$message->message_sent_id?>" class="remove">delete</a></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>

	<?php require_once 'layouts/footer.php';?>