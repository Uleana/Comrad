<?php
$out = "";
if (! mysql_connect ($_SETTINGS['host'],$_SETTINGS['user'],$_SETTINGS['password']))
{
   $out .= $_EMESSAGES['connection_failed']." `".$_SETTINGS['host']."`."."<br>Причина: ".mysql_error()."<br>";
   die($out);
}
else
{
    $out .= $_EMESSAGES['connection_succesful']." `".$_SETTINGS['host']."`.";
}
echo $out."<br>";
?>
