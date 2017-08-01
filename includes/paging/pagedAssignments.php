<?php
/*
Example URL : http://www.sanwebe.com/2013/03/ajax-pagination-with-jquery-php */

// continue only if $_POST is set and it is a Ajax request

if (isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    include (realpath(__DIR__ . '/../db.php'));

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

    // break records into pages

    $total_pages = ceil($get_total_rows[0] / $item_per_page);

    // get starting position to fetch the records

    $page_position = (($page_number - 1) * $item_per_page);

    // Limit our results within a specified range.

    $rs = $conn->prepare("SELECT id, title, description, dates, clicks FROM " . $DBtable . " ORDER BY dates DESC LIMIT $page_position, $item_per_page");
    $rs->execute(); //Execute prepared Query
    $rs->bind_result($id, $title, $description, $dates, $clicks); //bind variables to prepared statement
    while ($rs->fetch()) { //fetch values
        $clicks = number_format($clicks, 0, '', '.');
        $dates = (date('d.m.Y', strtotime($dates)));
        echo '<div class="card">';
        echo '<h4 class="card-header">' . $title . '</h4>';
        echo '<div class="card-block"><p class="card-text">' . $description . '</p><a href="includes/downloads/downloads.php?id=' . $id . '" target="_blank" class="btn btn-primary">Download</a></div>';
        echo '<div class="card-footer"><div class="footer-left">Dato: ' . $dates . '</div><div class="footer-right">Downloads: ' . $clicks . '</div></div>';
        echo '</div>';
    }

    echo '<nav aria-label="Page navigation mt-3">';
    echo paginate_function($item_per_page, $page_number, $get_total_rows[0], $total_pages);
    echo '</nav>';
    exit;
}

// ############### pagination function #########################################

function paginate_function($item_per_page, $current_page, $total_records, $total_pages)
{
    $pagination = '';
    if ($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages) { //verify total pages and current page number
        $pagination.= '<ul class="pagination justify-content-center">';
        $right_links = $current_page + 3;
        $previous = $current_page - 3; //previous link
        $next = $current_page + 1; //next link
        $first_link = true; //boolean var to decide our first link
        if ($current_page > 1) {
            $previous_link = ($previous == 0) ? 1 : $previous;
            $pagination.= '<li class="class="page-item" first"><a class="page-link" href="#" data-page="1" title="Første">&laquo;</a></li>'; //first link
            $pagination.= '<li class="page-item"><a class="page-link" href="#" data-page="' . $previous_link . '" title="Forrige">&lt;</a></li>'; //previous link
            for ($i = ($current_page - 2); $i < $current_page; $i++) { //Create left-hand side links
                if ($i > 0) {
                    $pagination.= '<li class="page-item"><a class="page-link" href="#" data-page="' . $i . '" title="Page' . $i . '">' . $i . '</a></li>';
                }
            }
            //set first link to false
            $first_link = false;
        }

        if ($first_link) { //if current active page is first link
            $pagination.= '<li class="page-item active first"><a class="page-link" href="#">' . $current_page . '<span class="sr-only">(current)</span></a></li>';
        }
        elseif ($current_page == $total_pages) { //if it's the last active link
            $pagination.= '<li class="page-item active last"><a class="page-link" href="#">' . $current_page . '<span class="sr-only">(current)</span></a></li>';
        }
        else { //regular current link
            $pagination.= '<li class="page-item active"><a class="page-link" href="#">' . $current_page . '<span class="sr-only">(current)</span></a></li>';
        }

        for ($i = $current_page + 1; $i < $right_links; $i++) { //create right-hand side links
            if ($i <= $total_pages) {
                $pagination.= '<li class="page-item"><a class="page-link" href="#" data-page="' . $i . '" title="Page ' . $i . '">' . $i . '</a></li>';
            }
        }

        if ($current_page < $total_pages) {
            $next_link = ($i > $total_pages) ? $total_pages : $i;
            $pagination.= '<li class="page-item"><a class="page-link" href="#" data-page="' . $next_link . '" title="Næste">&gt;</a></li>'; //next link
            $pagination.= '<li class="page-item last"><a class="page-link" href="#" data-page="' . $total_pages . '" title="Sidste">&raquo;</a></li>'; //last link
        }

        $pagination.= '</ul>';
    }

    //return pagination links
    return $pagination;
}

// Free memory
$rs->free();

// Close connection
$conn->close();
?>
