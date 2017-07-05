<?php
/*
* Function to insert info into db: thisfile.php?id=x
*/
include (realpath(__DIR__ . '/../db.php'));

$content = mysqli_real_escape_string($conn, "String containing 'quotes'");
$id = mysqli_real_escape_string($conn, intval($_REQUEST["id"]));

$sql = "UPDATE " . $DBtable . " SET content = '$content' WHERE id = '$id'";
$rs = $conn->query($sql);

if ($rs === false) {
  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
}
else {
  echo "Record updated successfully";
}
// Close connection
$conn->close();
?>
