<?php
header('Content-type: text/html;charset=utf-8');
$freqData = array();

// Random words
$keywords  = "Başka, Başka, küskün küskün otomobil kaçtı buraya küskün otomobil neden kaçtı
          kaçtı buraya, oraya KISMEN @here #there J.J.Johanson hep.
          Danny:Where is mom? I don't know! Café est weiß for 2 €uros.
          My 2nd nickname is mike18.
";
// Set letter count to exclude words like 'and'/'or', etc.
$letterCount = 5;

// Get individual words and build a frequency table
foreach (str_word_count($keywords, 1) as $word) {
    // If the word has more than x letters
    if (mb_strlen($word, 'UTF-8') >= $letterCount) {
        // For each word found in the frequency table, increment its value by one
        array_key_exists($word, $freqData) ? $freqData[$word]++ : $freqData[$word] = 0;
    }
}

// Custom words and their frequency
$mandatory_words = array(
    'Car' => 4,
    'Bus' => 3,
    'ñññ Bike ñññ' => 3,
    'Motorcycle øøø' => 3
);

// Merge the two arrays
$freqData = array_merge($freqData, $mandatory_words);

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
            $cloudTags[] = '<a style="font-size: ' . floor($size) . 'px' . '" class="tags" href="https://www.' . $_SERVER['HTTP_HOST'] . '/?q=' . $tag . '" title="\'' . $tag . '\' er fundet ' . $count . ' gange">' . htmlspecialchars(stripslashes($tag)) . '</a>';
        }
    }

    return join("\n", $cloudTags) . "\n";
}

// Closing
$stmt = null;
$pdo  = null;

//echo getCloud($freqData);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
</head>
<body>
  <?php
  echo getCloud($freqData);
  ?>
</body>
</html>
