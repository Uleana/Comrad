<?php
$out = "";
mysql_query("drop database if exists `".$_SETTINGS['db_name']."`;");
if (mysql_query("create database `".$_SETTINGS['db_name']."` 
		  character set 'utf8'; "))
{
    $out .= $_EMESSAGES['db_create_succesful']." `".$_SETTINGS['db_name']."`.";
}
else
{
    $out .= $_EMESSAGES['db_create_failed']." `".$_SETTINGS['db_name']."`."
	    ."<br>Причина: ".  mysql_error()."<br>";
}

echo $out."<br>";
?>
