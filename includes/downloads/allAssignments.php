<?php
// Query the database
include(realpath(__DIR__ . '/../db.php'));

$sql  = "SELECT * FROM " . $DBtable . " ORDER BY dates DESC";
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
?>
