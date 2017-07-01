<?php
/*
* Function to display info from db: <?php displayHits(1) ?> etc.
*/

function displayHits($id) {
    include (realpath(__DIR__ . '/../db.php'));
    $sql = "SELECT clicks FROM " . $DBtable . " WHERE id = $id";
    $rs=$conn->query($sql);

    if($rs === false) {
      trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
    } else {
      $arr = $rs->fetch_all(MYSQLI_ASSOC);
    }

    foreach($arr as $row) {
      $clicks = $row['clicks'];
      echo number_format($clicks, 0 ,'', '.');
    }
    // Free memory
    $rs->free();
    // Close connection
    $conn->close();
}

function displayTitle($id) {
    include (realpath(__DIR__ . '/../db.php'));
    $sql = "SELECT title FROM " . $DBtable . " WHERE id = $id";
    $rs=$conn->query($sql);
    if($rs === false) {
      trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
    } else {
      $arr = $rs->fetch_all(MYSQLI_ASSOC);
    }

    foreach($arr as $row) {
      $titles = $row['title'];
      echo $titles;
    }
    // Free memory
    $rs->free();
    // Close connection
    $conn->close();
}

function displayDesc($id) {
    include (realpath(__DIR__ . '/../db.php'));
    $sql = "SELECT description FROM " . $DBtable . " WHERE id = $id";
    $rs=$conn->query($sql);
    if($rs === false) {
      trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
    } else {
      $arr = $rs->fetch_all(MYSQLI_ASSOC);
    }

    foreach($arr as $row) {
      $desc = $row['description'];
      echo $desc;
    }
    // Free memory
    $rs->free();
    // Close connection
    $conn->close();
}

function displayDate($id) {
  include (realpath(__DIR__ . '/../db.php'));
    $sql = "SELECT dates FROM " . $DBtable . " WHERE id = $id";
    $rs=$conn->query($sql);

    if($rs === false) {
      trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
    } else {
      $arr = $rs->fetch_all(MYSQLI_ASSOC);
    }

    foreach($arr as $row) {
      $dates = $row['dates'];
      $dates =  (date('d.m.Y', strtotime($dates)));
      echo $dates;
    }
    // Free memory
    $rs->free();
    // Close connection
    $conn->close();
}
?>
