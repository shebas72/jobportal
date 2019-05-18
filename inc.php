<?php
$mysql_hostname = "mysql1005.mochahost.com";  //your mysql host name
$mysql_user = "shebas72_myjob"; //your mysql user name
$mysql_password = "!7JIKi}U2U(H"; //your mysql password
$mysql_database = "shebas72_myjob"; //your mysql database

$mailfrom = 'MyJob.sa<no-reply@myjob.sa>';
$mailto = 'shebas.veer@gmail.com';

$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Opps some thing went wrong");
mysql_select_db($mysql_database, $bd) or die("Error on database connection");

