<?php
  /*
  * Template layout for assignments
  * Include where needed
  */
  //error_reporting(E_ALL);

  $rating     = $row['rating'];
  $votes      = $row['votes'];
  $avg        = ($rating == 0) ? 0 : round(($rating / $votes), 1);
  $totalVotes = ($votes == 1) ? "stemme" : "stemmer";
  $id         = $row['id'];
  $title      = $row['title'];
  $desc       = $row['description'];

  // If used in a search - mark search words
  if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $title = preg_replace("/($search)/i", '<mark>$1</mark>', $title);
    $desc = preg_replace("/($search)/i", '<mark>$1</mark>', $desc);
  }

  $content    = $row['content'];
  $url        = $row['url'];
  $clicks     = number_format($row['clicks'], 0, '', '.');
  $dates      = (date('d. m. Y', strtotime($row['dates'])));
  echo '<div class="card">';
  echo '<h4 class="card-header"><span class="count">' . $counter . '.</span> <a href="includes/downloads/downloads.php?id=' . $id . '" target="_blank" rel="noopener" title="Se ' . $title . '">' . $title . '</a></h4>';
  echo '<div class="card-body"><p class="card-text">' . $desc . '</p>';
  // Rating start
  echo '<div class="ratings" data-id="' . $id . '" data-avg="' . $avg . '">';
  echo '<div class="bar">';
  echo '<span class="bg"></span>';
  echo '<span class="stars">';
  for ($i = 1; $i <= 5; $i++):
      echo '<span class="star" data-vote="' . $i . '" title="' . $i . '/5">
          <span class="starimg"></span>
        </span>';
  endfor;
  echo '</span>';
  echo '</div>';
  echo '<div class="small votes">' . $votes . ' ' . $totalVotes . '</div>';
  echo '</div>';
  // Rating end
  echo '</div>';
  echo '<div class="card-footer"><div class="footer-left">Oprettet: ' . $dates . '</div><div class="footer-right">Downloads: ' . $clicks . '</div></div>';
  echo '</div>';
?>
