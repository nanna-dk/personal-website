
<?php

// List traversing
  function getFileList($dir)
  {
    // array to hold return value
    $retval = array();

    // add trailing slash if missing
    if(substr($dir, -1) != "/") $dir .= "/";

    // open directory for reading
    $d = new DirectoryIterator($dir) or die("getFileList: Failed opening directory $dir for reading");
    foreach($d as $fileinfo) {
      // skip hidden files
      if($fileinfo->isDot()) continue;
      $retval[] = array(
        'name' => "{$dir}{$fileinfo}",
        'type' => ($fileinfo->getType() == "dir") ? "dir" : mime_content_type($fileinfo->getRealPath()),
        'size' => $fileinfo->getSize(),
        'lastmod' => $fileinfo->getMTime()
      );
    }

    return $retval;
  }

// Run function - pass folder path below
$dirlist = getFileList(".");
// output file list as table rows
echo "<table>";
foreach($dirlist as $file) {
  echo "<tr>\n";
  echo "<td><a href=\"{$file['name']}\">",basename($file['name']),"</a></td>\n";
  echo "<td>{$file['type']}</td>\n";
  echo "<td>{$file['size']}</td>\n";
  echo "<td>",date('r', $file['lastmod']),"</td>\n";
  echo "</tr>\n";
}
echo "</table>";
?>
