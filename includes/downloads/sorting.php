<?php
// Query the database
include(realpath(__DIR__ . '/../db.php'));

if (isset($_POST['column']) && isset($_POST['sortOrder'])) {
    $columnName = str_replace(" ", "_", strtolower($_POST['column']));
    $sortOrder  = $_POST['sortOrder'];

    $sql = "SELECT * FROM " . $DBtable . " order by " . $columnName . " " . $sortOrder;

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
        echo '<td><div class="alert alert-warning" role="alert">Ingen resultater fundet.</div></td>';
    }

    // Closing
    $stmt = null;
    $pdo  = null;

}
?>
