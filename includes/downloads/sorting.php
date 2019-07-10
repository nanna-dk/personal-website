<?php
// Query the database
include(realpath(__DIR__ . '/../db.php'));

if (isset($_POST['column']) && isset($_POST['sortOrder']) && isset($_POST['category'])) {
    $columnName = strtolower($_POST['column']);
    $columnName = filter_var($columnName, FILTER_SANITIZE_SPECIAL_CHARS);
    $sortOrder  = strtoupper($_POST['sortOrder']);
    $sortOrder = filter_var($sortOrder, FILTER_SANITIZE_SPECIAL_CHARS);

      $category = isset($_POST['category']);
      //$category = filter_var($category, FILTER_VALIDATE_INT) === 0 || filter_var($category, FILTER_VALIDATE_INT);

    if ($columnName == 'rating') {
      $sql = "SELECT * FROM " . $DBtable . " order by ROUND(rating / votes, 1) " . $sortOrder;
    } else {
      $sql = "SELECT * FROM " . $DBtable . " order by " . $columnName . " " . $sortOrder;
    }

    if ($category === 1) {
      $sql .= "WHERE category = '1'";
    } else if ($category === 2) {
      $sql .= "WHERE category = '2'";
    }

    var_dump($sql);

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
