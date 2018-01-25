<?php
// Query the database
include (realpath(__DIR__ . '/../db.php'));

error_reporting(E_ALL);

  $sql = "SELECT description FROM " . $DBtable . " ORDER BY id DESC";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $result = $stmt->fetchAll();
        $freqData = array();
        foreach($result as $row) {
          $lorem = $row['description'];
          // Set word size (to exclude words like 'and'/'or', etc.)
          $letterCount = 5;
          // Get individual words and build a frequency table
          foreach( str_word_count( $lorem, 1 ) as $word ) {
            // If the word has more than x letters
            if (mb_strlen($word) >= 5) {
            	// For each word found in the frequency table, increment its value by one
            	array_key_exists( $word, $freqData ) ? $freqData[ $word ]++ : $freqData[ $word ] = 0;
            }
          }
        }
    }
    else {
        echo 'Error';
    }

    function getCloud( $data = array(), $minFontSize = 12, $maxFontSize = 30 ) {
    	$minimumCount = min( array_values( $data ) );
    	$maximumCount = max( array_values( $data ) );
    	$spread       = $maximumCount - $minimumCount;
    	$cloudHTML    = '';
    	$cloudTags    = array();

    	$spread == 0 && $spread = 1;

    	foreach( $data as $tag => $count ) {
    		$size = $minFontSize + ( $count - $minimumCount )
    			* ( $maxFontSize - $minFontSize ) / $spread;
          $tag = strtolower($tag);
    		$cloudTags[] = '<a style="font-size: ' . floor( $size ) . 'px'
    		. '" class="tag_cloud" href="https://www.e-nanna.dk/?q=' . $tag
    		. '" title="\'' . $tag  . '\' returned a count of ' . $count . '">'
    		. htmlspecialchars( stripslashes( $tag ) ) . '</a>';
    	}

    	return join( "\n", $cloudTags ) . "\n";
}

  // Closing
  $stmt = null;
  $pdo = null;

echo getCloud( $freqData );
?>
