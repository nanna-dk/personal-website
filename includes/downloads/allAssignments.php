<?php
// Query the database
include (realpath(__DIR__ . '/../db.php'));

  $sql = "SELECT * FROM " . $DBtable . " ORDER BY dates DESC";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  //set counter variable
  $counter = 1;
    if ($stmt->rowCount() > 0) {
        $result = $stmt->fetchAll();
        foreach($result as $row) {
            $id = $row['id'];
            $title = $row['title'];
            $desc = $row['description'];
            $content = $row['content'];
            $url = $row['url'];
            $clicks = number_format($row['clicks'], 0, '', '.');
            $dates = (date('d.m.Y', strtotime($row['dates'])));
            echo '<div class="card">';
            echo '<h4 class="card-header"><span class="count">' . $counter . '.</span> <a href="includes/downloads/downloads.php?id=' . $id . '" target="_blank" rel="noopener" title="Download">' . $title . '</a></h4>';
            echo '<div class="card-block"><p class="card-text">' . $desc . '</p></div>';
            echo '<div class="card-footer"><div class="footer-left">Oprettet: ' . $dates . '</div><div class="footer-right">Downloads: ' . $clicks . '</div></div>';
            echo '</div>';
            $counter++;
        }
    }
    else {
        echo '<div class="alert alert-warning" role="alert">Ingen resultater fundet.</div>';
    }

  // Closing
  $stmt = null;
  $pdo = null;
//}
?>