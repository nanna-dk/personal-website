<?php
// Query the database
include(realpath(__DIR__ . '/../db.php'));

if (isset($_POST['column']) && isset($_POST['sortOrder'])) {
    $columnName = strtolower(strip_tags($_POST['column']));
    $sortOrder  = strtoupper(strip_tags($_POST['sortOrder']));

    if ($columnName == 'rating') {
      $sql = "SELECT * FROM " . $DBtable . " order by ROUND(rating / votes, 1) " . $sortOrder;
    } else {
      $sql = "SELECT * FROM " . $DBtable . " order by " . $columnName . " " . $sortOrder;
    }
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    //set counter variable
    $counter = 1;
    if ($stmt->rowCount() > 0) {
        $result = $stmt->fetchAll();
        foreach ($result as $row) {
            include(realpath(__DIR__ . '/../tpl/assignment.php'));
            $counter++;
        }
    } else {
        echo '<div class="alert alert-warning" role="alert">Ingen resultater fundet.</div>';
    }

    // Closing
    $stmt = null;
    $pdo  = null;
}
?>
