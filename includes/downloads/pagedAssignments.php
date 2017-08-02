<?php
// continue only if $_POST is set and it is a Ajax request
if (isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    include (realpath(__DIR__ . '/../db.php'));
    include (realpath(__DIR__ . '/../paging/paging.php'));

    // Get page number from Ajax POST
    if (isset($_POST["page"])) {
        $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
        if (!is_numeric($page_number)) {
            die('Invalid page number!');
        }
    }
    else {
        $page_number = 1; //if there's no page number, set it to 1
    }
    // get total number of records from database for pagination
    $sql = "SELECT * FROM " . $DBtable . " ORDER BY dates DESC";
    $rs = $conn->query($sql);
    if ($rs === false) {
        trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
    }
    else {
        $get_total_rows = $rs->fetch_row(); //hold total records in variable
    }
    if ($get_total_rows) {
        // Total number of results
        $total = mysqli_num_rows($rs);
        // break records into pages
        $total_pages = ceil($get_total_rows[0] / $item_per_page);
        // get starting position to fetch the records
        $page_position = (($page_number - 1) * $item_per_page);
        // Limit our results within a specified range.
        $rs = $conn->prepare("SELECT id, title, description, dates, clicks FROM " . $DBtable . " ORDER BY dates DESC LIMIT $page_position, $item_per_page");
        $rs->execute(); //Execute prepared Query
        $rs->bind_result($id, $title, $description, $dates, $clicks); //bind variables to prepared statement

        // Displaying paging
        echo '<nav aria-label="Navigation">';
        // Paging function from paging.php
        echo paginate($item_per_page, $page_number, $get_total_rows[0], $total_pages);
        echo '</nav>';

        // Displaying paging stats
        $page_position = (($page_number - 1) * $item_per_page) + 1;
        echo '<div class="paging-stats">';
        echo 'Side ' . $page_number . ' viser ';
        if ($page_number < $total_pages) {
            echo $page_position . ' til ' . ($page_position - 1 + $item_per_page) . ' ud af i alt ' . $total;
        }
        elseif (($page_number == $total_pages)) {
            echo $page_position . ' til ' . $total . ' ud af i alt' . $total;
        }
        echo '</div>';

        while ($rs->fetch()) { //fetch values
            $clicks = number_format($clicks, 0, '', '.');
            $dates = (date('d.m.Y', strtotime($dates)));
            echo '<div class="card">';
            echo '<h4 class="card-header">' . $title . '</h4>';
            echo '<div class="card-block"><p class="card-text">' . $description . '</p><a href="includes/downloads/downloads.php?id=' . $id . '" target="_blank" class="btn btn-primary">Download</a></div>';
            echo '<div class="card-footer"><div class="footer-left">Dato: ' . $dates . '</div><div class="footer-right">Downloads: ' . $clicks . '</div></div>';
            echo '</div>';
        }
        echo '<nav class="mt-3" aria-label="Page navigation">';
        // Paging function from paging.php
        echo paginate($item_per_page, $page_number, $get_total_rows[0], $total_pages);
        echo '</nav>';
    }
    else {
        echo '<div class="alert alert-warning" role="alert">Ingen resultater fundet.</div>';
    }
    exit;
}
// Free memory
$rs->free();
// Close connection
$conn->close();
?>
