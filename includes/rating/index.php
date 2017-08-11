<?php
	include_once (realpath(__DIR__ . '/../db.php'));
?>
<html lang="da">
	<head>
		<meta charset=UTF-8>
		<title>Items</title>
	</head>

	<body>
		<ul>
			<?php
				$sql = $pdo->prepare("SELECT * FROM `sitecontent` ORDER BY `id` DESC");
				$sql->execute();
				while($row = $sql->fetchObject()){
			?>
			<li><a href="single.php?id=<?php echo $row->id;?>"><?php echo $row->title ?></a></li>
			<?php }?>
		</ul>
	</body>
</html>
