<?php
	include_once (realpath(__DIR__ . '/../../db.php'));
	if(isset($_POST['vote'])){

		$id = (int)$_POST['item'];
		$points = (int)$_POST['point'];
		$query = $pdo->prepare("SELECT votes, rating FROM ". $DBtable ." WHERE `id` = ?");
		$query->execute(array($id));

		while($row = $query->fetchObject()){
			$pointsUpdate = ($row->rating+$points);
			$voteUpdate = ($row->votes+1);

			$updateQuery = $pdo->prepare("UPDATE ". $DBtable ." SET `votes` = ?, `rating` = ? WHERE `id` = ?");
			if($updateQuery->execute(array($voteUpdate, $pointsUpdate, $id))){
				$avg = round(($pointsUpdate/$voteUpdate),1);
				die(json_encode(array('average' => $avg, 'votes' => $voteUpdate)));
			} else {
				echo "Could not update votes";
			}
		}
	}
?>
