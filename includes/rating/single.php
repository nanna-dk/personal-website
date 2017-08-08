<?php
	include_once (realpath(__DIR__ . '/../db.php'));
?>
<html lang="da">
<head>
	<meta charset=UTF-8>
	<title>Rate</title>
	<link href="css/style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript" src="js/avaliations.js"></script>
</head>

	<body>
<?php
	$id = (int)$_GET['id'];
	$query = $pdo->prepare("SELECT * FROM ". $DBtable ." WHERE id = ?");
	$query->execute(array($id));
	while($item = $query->fetchObject()){
		$avg = ($item->rating == 0) ? 0 : round(($item->rating/$item->votes), 1);
		$votes = ($item->votes == 1) ? "stemme" : "stemmer";
?>
<h1><?php echo $item->title ?> - <a href="index.php"><<</a></h1>
<span class="ratingAverage" data-average="<?php echo $avg;?>"></span>
<span class="item" data-id="<?php echo $id;?>"></span>

<div class="bar">
	<span class="bg"></span>
	<span class="stars">
	<?php for($i=1; $i<=5; $i++):?>
	<span class="star" data-vote="<?php echo $i;?>">
		<span class="starimg"></span>
	</span>
	<?php
	endfor;
	echo '</span></div><p class="votes"><span>'.$item->votes.' '.$votes.'</span></p>';
}
?>
</body>
</html>
