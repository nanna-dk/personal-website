<?php
	include_once (realpath(__DIR__ . '/../../db.php'));
	if(isset($_POST['vote'])){

		$id = (int)$_POST['item'];
		$points = (int)$_POST['point'];
		$query = $pdo->prepare("SELECT votes, rating FROM ". $DBtable ." WHERE `id` = ?");
		$query->execute(array($id));

		while($row = $query->fetchObject()){
			$pointssUpd = ($row->rating+$points);
			$voteUpdate = ($row->votes+1);

			$updateQuery = $pdo->prepare("UPDATE ". $DBtable ." SET `votes` = ?, `rating` = ? WHERE `id` = ?");
			if($updateQuery->execute(array($voteUpdate, $pointssUpd, $id))){
				$avg = round(($pointssUpd/$voteUpdate),1);
				setcookie("rated", 1, time() + (86400 * 30), "/"); // 86400 = 1 day
				die(json_encode(array('average' => $avg, 'votes' => $voteUpdate)));
			}
		}
	}
?>
