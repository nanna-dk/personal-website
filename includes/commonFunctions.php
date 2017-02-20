<?php
/*
* Function to display number of clicks
*/
function displayHits($id) {
    include ("db.php");
    $sql = "SELECT clicks FROM " . $SETTINGS["data_table"] . " WHERE id = $id";
    $result = mysql_query($sql) or die(mysql_error());
    if(mysql_num_rows($result)) {
        $row = mysql_fetch_assoc($result) or die(mysql_error());
        $clicks = $row['clicks'];
        echo $clicks;
    }
}
?>
