<?php
//define(DEBUG, "DEBUG");
//define(RELEASE, "RELEASE");

function Init()
{
    /*global $_SETTINGS;
    $_SETTINGS['user'] = "u116305";
    $_SETTINGS['password'] = "galeon6";
    $_SETTINGS['db_name'] = "b116305_galeon";
    $_SETTINGS['host'] = "78.108.80.11";*/
    global $DEBUG;
    $DEBUG = "DEBUG";
    //global $RELEASE = "RELEASE";

    global $_SETTINGS;
    $_SETTINGS['user'] = "root";
    $_SETTINGS['password'] = "27040811";
    $_SETTINGS['db_name'] = "adminpanel";
    $_SETTINGS['host'] = "localhost";
    $_SETTINGS['encoding'] = "utf8";
}
Init();

$_EMESSAGES['connection_failed']="Не могу соединиться с сервером ";
$_EMESSAGES['connection_succesful']="Успешное подключение к серверу ";
$_EMESSAGES['db_create_failed']="Не могу создать БД ";
$_EMESSAGES['db_create_succesful']="Успешно создана БД ";
$_EMESSAGES['db_choose_failed']="Не могу выбрать БД ";
$_EMESSAGES['db_choose_succesful']="Успешно выбрана БД ";
$_EMESSAGES['table_creation_failed']="Не могу создать таблицу ";
$_EMESSAGES['table_creation_succesful']="Успешно создана таблица: ";
$_EMESSAGES['data_insert_failed']="Не могу вставить данные в таблицу: ";
$_EMESSAGES['data_insert_succesful']="Данные успешно вставлены в таблицу: ";
$_EMESSAGES['tables_creation_complete']="Создание таблиц завершено. ";
$_EMESSAGES['client_charset_set_failed']="Не могу уставновить кодировку клиента на ";
$_EMESSAGES['client_charset_set_succesful']="Кодировка клиента установлена на ";
$_EMESSAGES['server_charset_set_failed']="Не могу уставновить кодировку сервера на ";
$_EMESSAGES['server_charset_set_succesful']="Кодировка сервера установлена на ";

