<?php
// Query the database
include (realpath(__DIR__ . '/../db.php'));

error_reporting(E_ALL);

  $sql = "SELECT tag FROM " . $DBtable . " ORDER BY id DESC";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $result = $stmt->fetchAll();
        foreach($result as $row) {
            $array = explode(",", $row['tag']);
            foreach($array as $key) {
              if (!empty($key)) {
                $key = preg_replace('/\s+/', '', $key); // Trim whitespace
                $key = strtolower($key);
                echo '<span>' . $key . '</span>';
              }
            }
        }
    }
    else {
        echo 'Error';
    }

  // Closing
  $stmt = null;
  $pdo = null;
//}
?>
