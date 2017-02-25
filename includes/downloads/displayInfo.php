<?php
/*
* Function to display info from db: <?php displayHits(1) ?> etc.
*/
function displayHits($id) {
    include (realpath(__DIR__ . '/../db.php'));
    $sql = "SELECT clicks FROM " . $SETTINGS["data_table"] . " WHERE id = $id";
    $result = mysql_query($sql) or die(mysql_error());
    if(mysql_num_rows($result)) {
        $row = mysql_fetch_assoc($result) or die(mysql_error());
        $clicks = $row['clicks'];
        echo number_format($clicks, 0 ,'', '.');
    }
}
function displayTitle($id) {
    include (realpath(__DIR__ . '/../db.php'));
    $sql = "SELECT title FROM " . $SETTINGS["data_table"] . " WHERE id = $id";
    $result = mysql_query($sql) or die(mysql_error());
    if(mysql_num_rows($result)) {
        $row = mysql_fetch_assoc($result) or die(mysql_error());
        $titles = $row['title'];
        echo $titles;
    }
}
function displayDate($id) {
    include (realpath(__DIR__ . '/../db.php'));
    $sql = "SELECT dates FROM " . $SETTINGS["data_table"] . " WHERE id = $id";
    $result = mysql_query($sql) or die(mysql_error());
    if(mysql_num_rows($result)) {
        $row = mysql_fetch_assoc($result) or die(mysql_error());
        $dates = $row['dates'];
        echo $dates;
    }
}
?>
