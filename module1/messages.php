<?php

require_once 'config/app.php';

Guard::protect();

if(isset($_GET['action']) && !empty($_GET['action'])){
	if($_GET['action']==='delete'){
		$id=stripslashes($_GET['id']);

		$db->query("DELETE FROM messages_sent WHERE message_sent_id=?",
			[
				$id
			]);
	}
}

$messages=$db->query("SELECT s.* FROM messages_sent AS s WHERE s.user_id=?",[
		$_SESSION['user_id']
	])->get();

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
					<td><a href="?action=delete&id=<?=$message->message_sent_id?>">delete</a></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>

	<?php require_once 'layouts/footer.php';?>