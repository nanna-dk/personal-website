<?php
// Searching the database
include (realpath(__DIR__ . '/../db.php'));
include (realpath(__DIR__ . '/../paging/paging.php'));
if (isset($_POST['search'])) {
  $search = $_POST['search'];
  $search = preg_replace("#[^0-9a-z]i#", "", $search);
  $sql = "SELECT * FROM " . $DBtable . " WHERE title LIKE '%" . $search . "%' OR description LIKE '%" . $search . "%' ORDER BY dates DESC";
  $rs = $conn->query($sql);
  if ($rs === false) {
      trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
  }
  else {
      $arr = $rs->fetch_all(MYSQLI_ASSOC);
  }
  if ($arr) {
    $total = mysqli_num_rows($rs);
    echo '<div id="searchResults">';
    echo '<div class="totalResults">Antal resultater: ' . $total . '</div>';
    foreach($arr as $row) {
        $id = $row['id'];
        $title = $row['title'];
        $title = preg_replace("/($search)/i",'<mark>$1</mark>', $title);
        $desc = $row['description'];
        $desc = preg_replace("/($search)/i",'<mark>$1</mark>', $desc);
        $url = $row['url'];
        $clicks = $row['clicks'];
        $clicks = number_format($clicks, 0, '', '.');
        $dates = $row['dates'];
        $dates = (date('d.m.Y', strtotime($dates)));

        echo '<div class="card">';
        echo '<h4 class="card-header">' . $title . '</h4>';
        echo '<div class="card-block"><p class="card-text">' . $desc . '</p><a href="includes/downloads/downloads.php?id=' . $id . '" target="_blank" class="btn btn-primary">Download</a></div>';
        echo '<div class="card-footer"><div class="footer-left">Oprettet: ' . $dates . '</div><div class="footer-right">Downloads: ' . $clicks . '</div></div>';
        echo '</div>';
      }
  }
  else {
      echo '<div class="alert alert-warning" role="alert">Ingen resultater fundet.</div>';
  }
  echo '</div>';
  // Free memory
  $rs->free();
  // Close connection
  $conn->close();
}
?>
