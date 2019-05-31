<?php
/*
Script to host urls, and display the item based on its ID:
Usage: /downloads.php?id=x
*/
include(realpath(__DIR__ . '/../db.php'));
if ((int)$_GET['id'] !== 0) {
  $id = (int)$_GET['id'];
  $sql = "SELECT id, clicks, url FROM " . $DBtable . " WHERE id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  if ($stmt->rowCount() > 0) {
      $result = $stmt->fetchAll();
      foreach($result as $row) {
          if ($id == 7) {
            // Special header for zip files
            header("Content-Description: Download");
            header('Content-type: application/zip');
            header('Content-Transfer-Encoding: binary');
            header('Connection: Keep-Alive');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header("Content-Length: " . filesize($row["url"]));
            header("Location: " . $row["url"]);
          } else {
            header("Location: " . $row["url"]);
          }
      }

      // Update counter by one and add a timestamp (plus 1 hour to get correct time zone on remote db)
      $sql2 = "UPDATE " . $DBtable . " SET clicks = clicks + 1, dl_time = DATE_ADD(now(), INTERVAL 1 HOUR) WHERE id= :id";

      $stmt2 = $pdo->prepare($sql2);
      $stmt2->bindValue(':id', $id, PDO::PARAM_INT);
      $stmt2->execute();
  }
  $stmt = null;
  $pdo = null;
} else {
  echo "Invalid request";
}
?>
