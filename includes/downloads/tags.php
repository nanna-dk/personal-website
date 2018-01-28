<?php
header('Content-type: text/html;charset=utf-8');
setlocale(LC_ALL, 'da_DK');
// Query the database
include(realpath(__DIR__ . '/../db.php'));

$sql  = "SELECT description FROM " . $DBtable . " ORDER BY id DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
if ($stmt->rowCount() > 0) {
    $result   = $stmt->fetchAll();
    $freqData = array();
    foreach ($result as $row) {
        $keywords = $row['description'];
        // Set letter count to exclude words like 'and'/'or', etc.
        $letterCount = 5;

        // Get individual words and build a frequency table
        foreach (str_word_count($keywords, 1, 'øæå1233456789') as $word) {
            // If the word has more than x letters
            if (mb_strlen($word, 'UTF-8') >= $letterCount) {
                // For each word found in the frequency table, increment its value by one
                array_key_exists($word, $freqData) ? $freqData[$word]++ : $freqData[$word] = 0;
            }
        }

        // Custom words and their frequency
        $mandatory_words = array(
            'cscw' => 4,
            'hci' => 3,
            'opgave' => 3,
            'ETA' => 3
        );

        // Merge the two arrays
        $freqData  = array_merge($freqData, $mandatory_words);
    }
} else {
    echo 'Unable to fetch keywords';
}

function getCloud($data = array(), $minFontSize = 12, $maxFontSize = 30) {
    $minimumCount = min(array_values($data));
    $maximumCount = max(array_values($data));
    $spread       = $maximumCount - $minimumCount;
    $cloudTags    = array();
    $spread == 0 && $spread = 1;

    foreach ($data as $tag => $count) {
      if ($count > 0) {
        $size        = $minFontSize + ($count - $minimumCount) * ($maxFontSize - $minFontSize) / $spread;
        $tag         = strtolower($tag);
        $cloudTags[] = '<a style="font-size: ' . floor($size) . 'px' . '" class="tags" href="https://www.'. $_SERVER['HTTP_HOST'] .'/?q=' . $tag . '" title="\'' . $tag . '\' er fundet ' . $count . ' gange">' . html_entity_decode($tag) . '</a>';
      }
    }

    return join("\n", $cloudTags) . "\n";
}

// Closing
$stmt = null;
$pdo  = null;

echo getCloud($freqData);
?>
