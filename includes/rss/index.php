<?php
header("Content-Type: application/rss+xml; charset=UTF-8");

// Query the database
include(realpath(__DIR__ . '/../db.php'));

// General functions
include(realpath(__DIR__ . '/../functions.php'));

$rssfeed = '<?xml version="1.0" encoding="UTF-8"?>';
$rssfeed .= '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">';
$rssfeed .= '<channel>';
$rssfeed .= '<title>RSS feed</title>';
$rssfeed .= '<link>' . siteUrl() .'</link>';
$rssfeed .= '<description>This is an example RSS feed</description>';
$rssfeed .= '<language>da</language>';
$rssfeed .= '<copyright>Copyright © ' . date("Y") . ' ' . $site .'</copyright>';

$sql  = "SELECT * FROM " . $DBtable . " ORDER BY dates DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $result = $stmt->fetchAll();
    foreach ($result as $row) {
        $id     = $row['id'];
        $title  = $row['title'];
        $desc   = $row['description'];
        $cleanText = preg_replace('/<a[^>]*>.*?<\/a>/i', '', $desc);
        $url    = $row['url'];
        $clicks = number_format($row['clicks'], 0, '', '.');
        $dates  = $row['dates'];
        $rssfeed .= '<item>';
        $rssfeed .= '<title>' . $title . '</title>';
        $rssfeed .= '<description><![CDATA[' . $cleanText . ']]></description>';
        $rssfeed .= '<link>' . $url . '</link>';
        $rssfeed .= '<guid isPermaLink="true">' . fullSiteUrl() . '#-' . randomString(6) . $dates .'</guid>';
        $rssfeed .= '<pubDate>' . date("D, d M Y H:i:s O", strtotime($row['dates'])) . '</pubDate>';
        //$rssfeed .= '<atom:link href="' . fullSiteUrl() .' rel="self" type="application/rss+xml" />';
        $rssfeed .= '</item>';
    }
} else {
    echo 'Ingen resultater fundet.';
}
$rssfeed .= '</channel>';
$rssfeed .= '</rss>';

echo $rssfeed;

// Closing
$stmt = null;
$pdo  = null;

?>
