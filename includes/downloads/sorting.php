<?php

// Query the database
include realpath(__DIR__.'/../db.php');

if (isset($_POST['column']) && isset($_POST['sortOrder']) && isset($_POST['category'])) {
    $columnName = strtolower($_POST['column']);
    $columnName = filter_var($columnName, FILTER_SANITIZE_STRING);
    $columnName = filter_var($columnName, FILTER_SANITIZE_SPECIAL_CHARS);
    $sortOrder = strtoupper($_POST['sortOrder']);
    $sortOrder = filter_var($sortOrder, FILTER_SANITIZE_STRING);
    $sortOrder = filter_var($sortOrder, FILTER_SANITIZE_SPECIAL_CHARS);
    $category = strtolower($_POST['category']);
    $category = filter_var($category, FILTER_SANITIZE_STRING);
    $category = filter_var($category, FILTER_SANITIZE_SPECIAL_CHARS);

    if ('1' == $category) {
        $where = "WHERE s.category <> '1'";
    } elseif ('2' == $category) {
        $where = "WHERE s.category <> '2'";
    } else {
        $where = "WHERE s.category <> '1' AND s.category <> '2'";
    }

    if ('rating' == $columnName) {
        $sql = 'SELECT * FROM '.$DBtable.' t WHERE t.category NOT IN(SELECT distinct s.category FROM '.$DBtable.' s '.$where.') order by ROUND(rating / votes, 1) '.$sortOrder;
    } else {
        // Default query which will handle certain categories as well
        $sql = 'SELECT * FROM '.$DBtable.' t WHERE t.category NOT IN(SELECT distinct s.category FROM '.$DBtable.' s '.$where.') order by '.$columnName.' '.$sortOrder;
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    //set counter variable
    $counter = 1;
    if ($stmt->rowCount() > 0) {
        $result = $stmt->fetchAll();
        foreach ($result as $row) {
            include realpath(__DIR__.'/../tpl/assignment.php');
            ++$counter;
        }
    } else {
        echo '<div class="alert alert-warning" role="alert">Ingen resultater fundet.</div>';
    }

    // Closing
    $stmt = null;
    $pdo = null;
}
?>
