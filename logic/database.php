<?php

$servername = "sql658.your-server.de";
$dbusername = "db_login";
$dbname = "the_date";

// set the database password based on a text file
$filename = 'pwd.txt';
$passwordfile = fopen($filename, 'r') or die('Unable to open password file');
$dbpassword = str_replace(array("\n", "\r"), '', fread($passwordfile,filesize($filename)));

$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

if (!$conn) {
  die("Connection failed: ". mysqli_connect_error());
}
