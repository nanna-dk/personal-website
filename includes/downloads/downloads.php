<?php
###########################################################
/*
Script to host urls, and display the item based on its ID:
Usage: /click.php?id=x
*/
###########################################################

error_reporting(0);
include (realpath(__DIR__ . '/../db.php'));

// Select by id
$sql = "SELECT * FROM " . $DBtable . " WHERE id='" . intval($_REQUEST["id"]) . "'";
$rs=$conn->query($sql);

// Iterate over recordset
if($rs === false) {
  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
  $arr = $rs->fetch_all(MYSQLI_ASSOC);
}

// Generate url
foreach($arr as $row) {
  header("Location: " . $row["url"]);
}

// Update counter by one
$sql= "UPDATE " . $DBtable . " SET clicks=clicks+1 WHERE id='" . intval($_REQUEST["id"]). "'";
if($conn->query($sql) === false) {
  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
  $affected_rows = $conn->affected_rows;
}

// Free memory
$rs->free();
// Close connection
$conn->close();
?>
