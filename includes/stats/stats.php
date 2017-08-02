<?php
// Database statistics
include (realpath(__DIR__ . '/../db.php'));

// Most clicked items
$sql = "SELECT * FROM " . $DBtable . " ORDER BY clicks DESC LIMIT 5";
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
        $clicks = $row['clicks'];
        $hits = number_format($clicks, 0, '', '.');
        $percentage = round($clicks / 100);
        echo '<p class="card-text"><a href="includes/downloads/downloads.php?id=' . $id . '" target="_blank">' . $title . '</a></p>';
        echo '<div class="progress" title="' . $title . '">';
        echo '<div class="progress-bar" role="progressbar" style="width:' . $percentage . '%" aria-valuenow="' . $percentage . '" aria-valuemin="0" aria-valuemax="100">' . $hits . '</div>';
        echo '</div><br />';
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
