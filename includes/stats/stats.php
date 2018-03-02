<?php
// Database statistics
include (realpath(__DIR__ . '/../db.php'));

// Most clicked items
$sql = "SELECT * FROM " . $DBtable . " ORDER BY clicks DESC"; // LIMIT 5

$stmt = $pdo->prepare($sql);
$stmt->execute();
  if ($stmt->rowCount() > 0) {
      $result = $stmt->fetchAll();
      echo '<div id="searchResults">';
      foreach($result as $row) {
        $rating     = $row['rating'];
        $votes      = $row['votes'];
        $avg        = ($rating == 0) ? 0 : round(($rating / $votes), 1);
        $totalVotes = ($votes == 1) ? "bedømmelse" : "bedømmelser";
        $rateStats  = ($rating == 0) ? "Ingen stemmer afgivet" : "$avg/5 baseret på $votes stemmer";
        $id = $row['id'];
        $title = $row['title'];
        $clicks = $row['clicks'];
        $hits = number_format($clicks, 0, '', '.');
        $dl = date("d. m. Y", strtotime($row["dl_time"]));
        $percentage = round($clicks / 100);
        echo '<p class="card-text"><a href="includes/downloads/downloads.php?id=' . $id . '" target="_blank">' . $title . '</a></p>';
        echo '<div class="progress" title="' . $title . ', downloaded '. $hits .' gange">';
        echo '<div class="progress-bar" role="progressbar" style="width:' . $percentage . '%" aria-valuenow="' . $percentage . '" aria-valuemin="0" aria-valuemax="100">' . $hits . '</div>';
        echo '</div>';
        echo '<div class="text-muted smaller">Sidst downloaded: '. $dl .'.</div>';
        echo '<div class="text-muted smaller">Bedømmelse: '. $rateStats .'.</div><br />';
      }
  }
  else {
      echo 'Ingen resultater fundet.';
  }
// Closing
$stmt = null;
$pdo = null;
?>
