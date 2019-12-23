<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'kridho_bankku');    // DB username
define('DB_PASSWORD', 'kridho1234');    // DB password
define('DB_DATABASE', 'kridho_bankku');      // DB name
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die( "Unable to connect");// $database = mysqli_select_db(DB_DATABASE) or die( "Unable to select database");
?>
