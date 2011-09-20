<?php
include_once "../config/config.php";
/**
 * Класс, который позволяет получать данные
 * в необходимом формате от БД
 *
 * При неуспешном запросе к БД возвращается значение -1
 * @author alexandr
 */
class DatabaseInterface 
{
    private $DBHost;
    private $DBName;
    private $DBUser;
    private $DBPassword;
    private $DBConnection;
    private $DBEncoding;


    function __construct($Host, $Name, $User, $Password,
			 $Encoding)
    {
        $this->DBName = $Name;
        $this->DBHost = $Host;
        $this->DBUser = $User;
        $this->DBPassword = $Password;
	$this->DBEncoding = $Encoding;
    }
    
    function Connect()
    {
	$out = "";
	global $_EMESSAGES;
	
        $this->DBConnection = new mysqli(   $this->DBHost,$this->DBUser,
                                                   $this->DBPassword,$this->DBName);
        if ($this->DBConnection->connect_error)
        {
            $out .= $_EMESSAGES['connection_failed']."'".$this->DBHost."'.".
		"<br>Причина: ".$this->DBConnection->connect_error;
	    die($out);
        }
	
	if (isset($DEBUG))
	    $out .= $_EMESSAGES['connection_succesful']."'".$this->DBHost."'.";
	if (!$this->DBConnection->query("set character set '".$this->DBEncoding."';"))
	{
	     $out .= $_EMESSAGES['client_charset_set_failed']." '".$this->DBEncoding."'. ".
		     "<br> Причина: ".$this->DBConnection->connect_error;
	    die($out); 
	}
	
	if (isset($DEBUG))
	    $out .= $_EMESSAGES['client_charset_set_succesful']." '".$this->DBEncoding."'. ";
	if (!$this->DBConnection->query("set names '".$this->DBEncoding."';"))
	{
	    $out .= $_EMESSAGES['server_charset_set_failed']." '".$this->DBEncoding."'. ".
		     "<br> Причина: ".$this->DBConnection->connect_error;
	    die($out);
	}
	if (isset($DEBUG))
	    $out .= $_EMESSAGES['server_charset_set_succesful']." '".$this->DBEncoding."'. ";
	echo $out;
	
	
    }
    
    function getUser($Login, $Password)
    {
	$statment = $this->DBConnection->prepare("select `ID`,`Group`, `LastVisit`
	    `Email`, `Lock` from `Users` where `Login` = '?' and `Password` = '?';");
        $statment->bind_param("ss",$Login,  md5($Password));
        $statment->execute();
        $statment->bind_result($id,$group,$lastvisit,$email,$lock);
        $statment->fetch();
        $statment->close();
	return isset($id)?array($id,$this->getGroupName($group),$lastvisit,
	    $email,$lock):NULL;
    }
    
    function getGroupName($Id)
    {
	$statment = $this->DBConnection->prepare("select `Name`
	    from `UserGroup` where `ID` = '?';");
        $statment->bind_param("i",$Id);
        $statment->execute();
        $statment->bind_result($name);
        $statment->fetch();
        $statment->close();
	return isset($name)?$name:NULL;
    }
    
    function UpdateLastVisitTime($Id, $NewTime)
    {
	$statment = $this->DBConnection->prepare("update `Users`
	    set `LastVisit` = '?' where `ID` = '?';");
        $statment->bind_param("si",$NewTime,$Id);
        $res = $statment->execute();
        $statment->close();
	return $res;
    }
    
    function insertUser($Login, $Password)
    {
	
    }
    
    function selectDataFromTable($Table, $SortField, $SortType)
    {
	$statment = $this->DBConnection->prepare("update `Users`
	    set `LastVisit` = '?' where `ID` = '?';");
        $statment->bind_param("si",$NewTime,$Id);
        $res = $statment->execute();
        $statment->close();
	return $res;
    }
    
    function getMySQLTable($TableName)
    {
	
    }
    
    function getColumnsByTableName($Name)   
    {
	$result = "";
	$statment = $this->DBConnection->prepare("explain `".$Name."`;");
        //$statment->bind_param("s",$Name);
        $statment->execute();
        $statment->bind_result($field,$type,$null,$key,$default,$extra);
        while($statment->fetch())
	{
	    $result[] = array('name'=>$field,
			      'type'=>$type,
			      'null'=>$null,
			      'key'=>$key,
			      'extra'=>$extra,
			      'default'=>$default);
	}    
	$statment->close();
	return ($result!="")?$result:NULL;
    }
    
    function getCreateScriptByTableName($Name)
    {
	$statment = $this->DBConnection->prepare("show create table `".$Name."`;");
        //$statment->bind_param("s",$Name);
        $statment->execute();
        $statment->bind_result($table,$script);
        $statment->fetch();
	$statment->close();
	return (isset($table))?$script:NULL;
    }
    
    function getTables()
    {
	$result = "";
	global $_SETTINGS;
	$statment = $this->DBConnection->prepare("show tables;");
        $statment->execute();
        $statment->bind_result($table_name);
        while($statment->fetch())
	{
	    $result[] = $table_name;
	}    
	$statment->close();
	return ($result!="")?$result:NULL;
    }
}

?>
