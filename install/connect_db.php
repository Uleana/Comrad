<?php
mysql_select_db($_SETTINGS['db_name']) or die($_EMESSAGES['db_choose_failed'].
	" `".$_SETTINGS['db_name']."`.<br>Причина: ".mysql_error()."<br>");
echo $_EMESSAGES['db_choose_succesful']." `".$_SETTINGS['db_name']."`.<br>";
mysql_query ("set character_set_client='utf8_general_ci'"); 
mysql_query ("set character_set_results='utf8_general_ci'"); 
mysql_query ("set collation_connection='utf8_general_ci'");
?>
