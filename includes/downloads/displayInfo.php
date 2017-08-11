<?php
/*
* Function to display info from db: <?php displayHits(1) ?> etc.
*/
//error_reporting(E_ALL);
function displayHits($id) {
    include (realpath(__DIR__ . '/../db.php'));
    $sql = "SELECT clicks FROM " . $DBtable . " WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $result = $stmt->fetchAll();
        foreach($result as $row) {
            $clicks = $row['clicks'];
            echo number_format($clicks, 0, '', '.');
        }
    }
    $stmt = null;
    $pdo = null;
}

function displayTitle($id) {
    include (realpath(__DIR__ . '/../db.php'));
    $sql = "SELECT title FROM " . $DBtable . " WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $result = $stmt->fetchAll();
        foreach($result as $row) {
            $titles = $row['title'];
            echo $titles;
        }
    }
    $stmt = null;
    $pdo = null;
}

function displayDesc($id) {
    include (realpath(__DIR__ . '/../db.php'));
    $sql = "SELECT description FROM " . $DBtable . " WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $result = $stmt->fetchAll();
        foreach($result as $row) {
            $desc = $row['description'];
            echo $desc;
        }
    }
    $stmt = null;
    $pdo = null;
}

function displayDate($id) {
    include (realpath(__DIR__ . '/../db.php'));
    $sql = "SELECT dates FROM " . $DBtable . " WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $result = $stmt->fetchAll();
        foreach($result as $row) {
            $dates = $row['dates'];
            $dates = (date('d.m.Y', strtotime($dates)));
            echo $dates;
        }
    }
    $stmt = null;
    $pdo = null;
}
?>
