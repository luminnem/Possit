<?php
define("host", "mysql.3owl.com");
define("user", "u460684700_posit");
define("password", "626474139a");
define("name", "u460684700_posit");

$connection = mysql_connect(host, user, password) or die ("Problems with connection...");
$db_connection = mysql_select_db(name, $connection);
