<?php
/*
Script to host urls, and display the item based on its ID:
Usage: /downloads.php?id=x
*/
include (realpath(__DIR__ . '/../db.php'));
if ((int)$_GET['id'] !== 0) {
  //error_reporting(E_ALL);
  $id = (int)$_GET['id'];
  $sql = "SELECT id, clicks, url FROM " . $DBtable . " WHERE id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  if ($stmt->rowCount() > 0) {
      $result = $stmt->fetchAll();
      foreach($result as $row) {
          header("Location: " . $row["url"]);
      }

      // Update counter by one and add a timestamp
      $sql2 = "UPDATE " . $DBtable . " SET clicks = clicks + 1, dl_time = now() WHERE id= :id";

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
