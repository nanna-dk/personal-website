<?php
###########################################################
/*
Script to host urls, and display the item based on its ID:
Usage: /click.php?id=x
*/
###########################################################

error_reporting(0);
include (realpath(__DIR__ . '/../db.php'));

// get url details based on ID
$sql = "SELECT * FROM " . $SETTINGS["data_table"] . " WHERE id='" . intval($_REQUEST["id"]) . "'";
$sql_result = mysql_query($sql, $connection) or die('request "Could not execute SQL query" ' . $sql);

// check if ID exists
if (mysql_num_rows($sql_result) > 0) {
    $item = mysql_fetch_assoc($sql_result);

    // increase clicks count by one
    $sql = "UPDATE " . $SETTINGS["data_table"] . " SET clicks=clicks+1 WHERE id='" . intval($_REQUEST["id"]) . "'";
    $sql_result = mysql_query($sql, $connection) or die('request "Could not execute SQL query" ' . $sql);
    header("Location: " . $item["url"]);
} else {
    echo "Item is missing.";
}
mysql_close($connection);
?>
