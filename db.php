<?php
$configs = include('config.php');
return  mysqli_connect($configs['db_host'], $configs['db_username'], $configs['db_password'], $configs['db_name']);
