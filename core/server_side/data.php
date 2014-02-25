<?php
define("host", "localhost");
define("user", "root");
define("password", "");
define("name", "posit_core");

$connection = mysql_connect(host, user, password) or die (mysql_error()."Problems with connection...");
$db_connection = mysql_select_db(name, $connection);
