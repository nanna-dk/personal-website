<?php
// Searching the database
include (realpath(__DIR__ . '/../db.php'));

$sql = "SELECT * FROM " . $DBtable . " ORDER BY dates DESC";
$rs = $conn->query($sql);
if ($rs === false) {
    trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
}
else {
    $arr = $rs->fetch_all(MYSQLI_ASSOC);
}
if ($arr) {
    foreach($arr as $row) {
        $id = $row['id'];
        $title = $row['title'];
        $desc = $row['description'];
        $url = $row['url'];
        $clicks = $row['clicks'];
        $clicks = number_format($clicks, 0, '', '.');
        $dates = $row['dates'];
        $dates = (date('d.m.Y', strtotime($dates)));
        echo '<div class="card">';
        echo '<h4 class="card-header">' . $title . '</h4>';
        echo '<div class="card-block"><p class="card-text">' . $desc . '</p><a href="includes/downloads/downloads.php?id=' . $id . '" target="_blank" class="btn btn-primary">Download</a></div>';
        echo '<div class="card-footer"><div class="footer-left">Dato: ' . $dates . '</div><div class="footer-right">Downloads: ' . $clicks . '</div></div>';
        echo '</div>';
    }
}
else {
    echo 'Ingen resultater fundet.';
}
// Free memory
$rs->free();
// Close connection
$conn->close();

?>
