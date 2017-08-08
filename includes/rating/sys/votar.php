<?php
	include_once (realpath(__DIR__ . '/../../db.php'));
	if(isset($_POST['votar'])){
		$artigoId = (int)$_POST['artigo'];
		$points = (int)$_POST['ponto'];

		$pegaArtigo = $pdo->prepare("SELECT votes, rating FROM `sitecontent` WHERE `id` = ?");
		$pegaArtigo->execute(array($artigoId));

		while($row = $pegaArtigo->fetchObject()){
			$pointssUpd = ($row->rating+$points);
			$votosUpd = ($row->votes+1);

			$atualizaArtigo = $pdo->prepare("UPDATE `sitecontent` SET `votes` = ?, `rating` = ? WHERE `id` = ?");
			if($atualizaArtigo->execute(array($votosUpd, $pointssUpd, $artigoId))){
				$calculo = round(($pointssUpd/$votosUpd),1);
				die(json_encode(array('average' => $calculo, 'votes' => $votosUpd)));
			}
		}
	}
?>
