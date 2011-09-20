<?php
$out = "";

$name = "UserGroup";
if (mysql_query("create table `".$name."`
(
  `ID` bigint(20) not null auto_increment,
  `Name` varchar(255) not null comment 'Name of users group',
  `Lock` tinyint(1) not null default 0 comment 'Blocking flag',
  primary key (ID),
  unique index UserGroups_Name (`Name`)
) engine = innodb auto_increment = 1 character set utf8 comment = 'Users groups.';"))
{
    $out .= $_EMESSAGES['table_creation_succesful']."`".$name."`<br>";
}    
else
{
    $out .= $_EMESSAGES['table_creation_failed']."`".$name."`"."<br>Причина: ";
    $out .= mysql_error()."<br>";
}

$name = "Users";
if (mysql_query("create table `".$name."`
(
  `ID` bigint(20) not null auto_increment,
  `Name` varchar(150) not null comment 'User name.',
  `Login` varchar(40) not null comment 'User login.',
  `Email` varchar(70) not null comment 'User email.',
  `Group` bigint(20) not null comment 'User group.',
  `LastVisit` timestamp not null default Now() comment 'Time of last visit user.',
  `Lock` tinyint(1) not null default 1 comment 'Event blocking flag.',
   primary key (ID),
   unique index Users_Login(`Login`),
   constraint Users_UserGroup foreign key (`Group`) references `UserGroup` (ID)
					    on delete cascade on update cascade
) engine = innodb auto_increment = 1 character set utf8 comment = 'Users.';"))
{
    $out .= $_EMESSAGES['table_creation_succesful']."`".$name."`<br>";
}    
else
{
    $out .= $_EMESSAGES['table_creation_failed']."`".$name."`"."<br>Причина: ";
    $out .= mysql_error()."<br>";
}



$name = "TableType";
if (mysql_query("create table `".$name."`
(
  `ID` tinyint unsigned not null auto_increment,
  `Name` varchar(255) not null comment 'Name of table type',
   primary key (ID)
) engine = innodb auto_increment = 1 character set utf8 comment = 'Tables type.';"))
{
    $out .= $_EMESSAGES['table_creation_succesful']."`".$name."`<br>";
}    
else
{
    $out .= $_EMESSAGES['table_creation_failed']."`".$name."`"."<br>Причина: ";
    $out .= mysql_error()."<br>";
}

$name = "Tables";
if (mysql_query("create table `".$name."`
(
  `ID` bigint(20) not null auto_increment,
  `Name` varchar(255) not null comment 'Table name.',
  `Type` tinyint unsigned not null comment 'Type of table.',
  primary key (ID),
  unique index `Table` (`Name`),
  constraint Tables_TableType foreign key (`Type`) references `TableType` (ID)
					    on delete cascade on update cascade
) engine = innodb auto_increment = 1 character set utf8 comment = 'Tables.';"))
{
    $out .= $_EMESSAGES['table_creation_succesful']."`".$name."`<br>";
}    
else
{
    $out .= $_EMESSAGES['table_creation_failed']."`".$name."`"."<br>Причина: ";
    $out .= mysql_error()."<br>";
}

$name = "ActionType";
if (mysql_query("create table `".$name."`
(
  `ID` bigint(20) not null,
  `Name` timestamp not null comment 'Name type of action',
  primary key (ID)
) engine = innodb character set utf8 comment = 'Action Type.';"))
{
    $out .= $_EMESSAGES['table_creation_succesful']."`".$name."`<br>";
}    
else
{
    $out .= $_EMESSAGES['table_creation_failed']."`".$name."`"."<br>Причина: ";
    $out .= mysql_error()."<br>";
}


$name = "Logs";
if (mysql_query("create table `".$name."`
(
  `ID` bigint(20) not null,
  `ActionTime` timestamp not null comment 'Moment of action',
  `ActionType` bigint(20) not null comment 'Action type',
  `Result` tinyint not null comment 'Result of action',
  `SQLCode` text not null comment 'Executed query',
  `SQL-Server-Answer` text not null comment 'Server answer',
  `User`   bigint(20) not null comment 'Author',
  primary key (ID),
  constraint Logs_Users foreign key (User) references `Users` (ID) on delete cascade on update cascade,
  constraint Logs_ActionType foreign key (ActionType) references `ActionType` (ID) on delete cascade on update cascade
) engine = innodb character set utf8 comment = 'Event flyers.';"))
{
    $out .= $_EMESSAGES['table_creation_succesful']."`".$name."`<br>";
}    
else
{
    $out .= $_EMESSAGES['table_creation_failed']."`".$name."`"."<br>Причина: ";
    $out .= mysql_error()."<br>";
}

$name = "Priviledges";
if (mysql_query("create table `".$name."`
(
  `ID` bigint(20) not null,
  `Name` varchar(255) not null comment 'Name of priviledgy',
  `UserGroup` timestamp not null comment 'Users group',
  `ActionType` bigint(20) not null comment 'Action type',
  `TableType` tinyint not null comment 'Type of table',
  `SQLCode` text not null comment 'Sql code tried to execute',
  `SQL-Server-Answer` text not null comment 'Server answer',
  primary key (`ID`),
  constraint Priviledges_ActionType foreign key (ActionType) references `ActionType` (ID) on delete cascade on update cascade
) engine = innodb character set utf8 comment = 'Event flyers.';"))
{
    $out .= $_EMESSAGES['table_creation_succesful']."`".$name."`<br>";
}    
else
{
    $out .= $_EMESSAGES['table_creation_failed']."`".$name."`"."<br>Причина: ";
    $out .= mysql_error()."<br>";
}

$out .= $_EMESSAGES['tables_creation_complete']."<br>";


echo $out."<br>";
?>
