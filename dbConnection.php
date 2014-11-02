<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cs2102";

$link = mysql_connect($servername, $username, $password, $dbname);

if (!$link) {
    die('Could not connect: ' . mysql_connect_error());
}
//echo 'Connected successfully';

?>