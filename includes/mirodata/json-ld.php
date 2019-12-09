<?php

// Outpud JSON-LD data
error_reporting(E_ALL);
include realpath(__DIR__.'/../db.php');

$sql = 'SELECT * FROM '.$DBtable.' ORDER BY clicks DESC';
$stmt = $pdo->prepare($sql);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $result = $stmt->fetchAll();
    echo '<script type="application/ld+json">';
    foreach ($result as $row) {
        $id = $row['id'];
        $title = $row['title'];
        $desc = $row['description'];
        $rating = $row['rating'];
        $votes = $row['votes'];
        $content = $row['content'];
        $url = $row['url'];
        $dates = (date('Y-m-d', strtotime($row['dates'])));

        $data = [
        '@context' => 'http://schema.org/',
        '@type' => 'BlogPosting',
        'headline' => $title,
        'genre' => '',
        'wordcount' => '',
        'keywords' => '',
        "url": "includes/downloads/downloads.php?id=".$id,
       //  "mainEntityOfPage": {
       //   "@type": "WebPage",
       //   "@id": 'includes/downloads/downloads.php?id='.$id.
       // },
         'dateCreated' => $dates,
         'datePublished' => $dates,
         'description' => $desc,
         'articleBody' => $desc,
      ];
        echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
    echo '</script>';
} else {
    echo '<div class="alert alert-warning" role="alert">Ingen resultater fundet.</div>';
}

// Closing
$stmt = null;
$pdo = null;

?>
