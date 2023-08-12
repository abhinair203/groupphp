<?php

$db['db_host'] = "172.31.22.43";
$db['db_user'] = "Abhijith200540101";
$db['db_pass'] = "lMOzWuJwj";
$db['db_name'] = "Abhijith200540101";

foreach($db as $key=> $value)
{
    define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

if(!$connection)
{
    echo "We are not connected.";
}

 
?>