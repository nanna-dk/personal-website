<?php
/*
* Connect to mySQL database
*/

/* Define MySQL connection details and database table name */
$SETTINGS["hostname"]='localhost';
$SETTINGS["mysql_user"]='komfrisk_dk';
$SETTINGS["mysql_pass"]='cibizam';
$SETTINGS["mysql_database"]='komfrisk_dk';
$SETTINGS["data_table"]='count_clicks';

/* Connect to MySQL */

if (!isset($install) or $install != '1') {
	$connection = mysql_connect($SETTINGS["hostname"], $SETTINGS["mysql_user"], $SETTINGS["mysql_pass"]) or die ('Unable to connect to MySQL server.<br ><br >Please make sure your MySQL login details are correct.');
	$db = mysql_select_db($SETTINGS["mysql_database"], $connection) or die ('request "Unable to select database."');
};
?>
