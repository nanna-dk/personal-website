<?php
	include_once (realpath(__DIR__ . '/../db.php'));
?>
<html lang="da">
	<head>
		<meta charset=UTF-8>
		<title>Artigos</title>
	</head>

	<body>
		<ul>
			<?php
				$selecao = $pdo->prepare("SELECT * FROM `sitecontent` ORDER BY `id` DESC");
				$selecao->execute();
				while($row = $selecao->fetchObject()){
			?>
			<li><a href="single.php?id=<?php echo $row->id;?>"><?php echo $row->title ?></a></li>
			<?php }?>
		</ul>
	</body>
</html>
