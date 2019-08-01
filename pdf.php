<?php
// Parse all pdf files from a folder
error_reporting(E_ALL);
ini_set("display_errors", 1);

include 'vendor/autoload.php';

$pdf_files = glob(dirname(__FILE__).'/opgaver/*.pdf');

// Parse pdf file and build necessary objects.
$parser = new \Smalot\PdfParser\Parser();

foreach ($pdf_files as $file) {

    $pdf = $parser->parseFile($file);

    // Retrieve all pages from the pdf file.
    $pages = $pdf->getPages();

    // Loop over each page to extract text.
    foreach ($pages as $page) {
        echo $page->getText();
        echo '<hr>';
    }
}
?>
