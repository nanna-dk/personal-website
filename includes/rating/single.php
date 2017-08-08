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
	$pegaArtigo = $pdo->prepare("SELECT * FROM `sitecontent` WHERE id = ?");
	$pegaArtigo->execute(array($id));
	while($ratings = $pegaArtigo->fetchObject()){
		$calculo = ($ratings->rating == 0) ? 0 : round(($ratings->rating/$ratings->votes), 1);
?>
<h1><?php echo $ratings->title ?> - <a href="index.php"><<</a></h1>
<span class="ratingAverage" data-average="<?php echo $calculo;?>"></span>
<span class="article" data-id="<?php echo $id;?>"></span>

<div class="barra">
	<span class="bg"></span>
	<span class="stars">
<?php for($i=1; $i<=5; $i++):?>


<span class="star" data-vote="<?php echo $i;?>">
	<span class="starAbsolute"></span>
</span>
<?php
	endfor;
	echo '</span></div><p class="votos"><span>'.$ratings->votes.'</span> votes</p>';
}
?>
</body>
</html>
