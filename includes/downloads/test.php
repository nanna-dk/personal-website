<?php
header('Content-type: text/html;charset=utf-8');
$freqData = array();

// Random words
$keywords  = "Başka, Başka, küskün küskün otomobil kaçt buraya küskün otomobil neden kaçt
          kaçt buraya, oraya KISMEN @here #there #there J.J.Johanson hep.
          Danny:Where is mom? I don't know! Café est weiß for 2 €uros.
          My 2nd nickname is mike18 12345678 æøå.
";


// Get individual words and build a frequency table
foreach (str_word_count($keywords, 1, 'øæå1233456789@ßüé€ç#?\':') as $word) {

    // For each word found in the frequency table, increment its value by one
    array_key_exists($word, $freqData) ? $freqData[$word]++ : $freqData[$word] = 0;
}

var_dump($freqData);

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

            // Check tags encoding
            echo mb_detect_encoding($tag);

            $cloudTags[] = '<a style="font-size: ' . floor($size) . 'px' . '" class="tags" href="https://www.' . $_SERVER['HTTP_HOST'] . '/?q=' . $tag . '" title="\'' . $tag . '\' was found ' . $count . ' times">' . htmlentities($tag) . '</a>';
        }
    }

    return join("\n", $cloudTags) . "\n";

}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
</head>
<body>
<br> --------------------<br>
  <?php
  echo getCloud($freqData);
  ?>
</body>
</html>
