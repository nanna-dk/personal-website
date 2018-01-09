<?php
// Searching the database
include (realpath(__DIR__ . '/../db.php'));
//error_reporting(E_ALL);
if (isset($_POST['search'])) {
  $search = $_POST['search'];

  $sql = "SELECT * FROM " . $DBtable . " WHERE title LIKE :search OR description LIKE :search OR content LIKE :search ORDER BY dates DESC";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
  $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $result = $stmt->fetchAll();
        $total = $stmt->rowCount();
        echo '<div id="searchResults">';
        echo '<div class="totalResults">Antal resultater: ' . $total . '</div>';
        foreach($result as $row) {
            $id = $row['id'];
            $title = $row['title'];
            $title = preg_replace("/($search)/i", '<mark>$1</mark>', $title);
            $desc = $row['description'];
            $desc = preg_replace("/($search)/i", '<mark>$1</mark>', $desc);
            $content = $row['content'];
            $url = $row['url'];
            $clicks = number_format($row['clicks'], 0, '', '.');
            $dates = (date('d.m.Y', strtotime($row['dates'])));
            echo '<div class="card">';
            echo '<h4 class="card-header"><a href="includes/downloads/downloads.php?id=' . $id . '" target="_blank" rel="noopener" title="Download">' . $title . '</a></h4>';
            echo '<div class="card-block"><p class="card-text">' . $desc . '</p></div>';
            echo '<div class="card-footer"><div class="footer-left">Oprettet: ' . $dates . '</div><div class="footer-right">Downloads: ' . $clicks . '</div></div>';
            echo '</div>';
        }
    }
    else {
        echo '<div class="alert alert-warning" role="alert">Ingen resultater fundet.</div>';
    }
  echo '</div>';

  // Closing
  $stmt = null;
  $pdo = null;
}
?>
