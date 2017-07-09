<!DOCTYPE html>
<html class="no-js" lang="da">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="Nanna Ellegaard, frontend-udvikler, cand.it i multimedier, cv" name="description">
  <meta name="theme-color" content="#c14343">
  <meta name="google-site-verification" content="MV2MazdIeTTrYsADXu2ARdwg44eWp_co_c7P2LZ7oyc">
  <link rel="apple-touch-icon" href="http://www.e-nanna.dk/apple-touch-icon.png">
  <link rel="icon" href="http://www.e-nanna.dk/favicon.ico">
  <title>Nannas website</title>
  <link href="http://www.e-nanna.dk/dist/css/style.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="http://www.e-nanna.dk/dist/js/bootstrap.min.js"></script>
</head>

<body>
<form action ="<?php echo $_SERVER['PHP_Self']; ?>" method="post">
<input name="search" type="text" size="30" placeholder="Søg">
<button type="submit" value="Search">Search</button>
</form>
<?php
include ('../downloads/displayInfo.php');
include ('../db.php');

if (isset($_POST['search'])) {
  $search = $_POST['search'];
  $search = preg_replace("#[^0-9a-z]i#", "", $search);
  $sql = "SELECT * FROM " . $DBtable . " WHERE title LIKE '%" . $search . "%' OR description LIKE '%" . $search . "%'";
  $rs = $conn->query($sql);

  if ($rs === false) {
      trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
  }
  else {
      $arr = $rs->fetch_all(MYSQLI_ASSOC);
  }

  if ($arr) {
      echo '<div class="card">';
      foreach($arr as $row) {
          $title = $row['title'];
          $desc = $row['description'];
          $id = $row['id'];
          echo '<li><a target="_blank" href="../downloads/downloads.php?id='. $id .'">' . $title . '</a></li>';
      }
      echo '</div>';
  }
  else {
      echo 'Ingen resultater fundet.';
  }

  // Free memory
  $rs->free();

  // Close connection
  $conn->close();
}
?>

</body>

</html>
