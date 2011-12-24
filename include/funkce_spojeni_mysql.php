<?php
// soubor s konstantama (na připojení do DB)
include_once ("./include/pripojeni.php");
/*= PŘIPOJENÍ K MYSQL A NASTAVEVNÍ LINKU NA PŘIPOJENÍ + NASTAVENÍ KÓDOVÁNÍ */
$GLOBALS["link"] = @mysql_connect(SQL_HOST, SQL_USERNAME, SQL_PASSWORD) or die("Nelze se připojit k serveru MYSQL");
$GLOBALS["link_transakce"] = @mysqli_connect(SQL_HOST, SQL_USERNAME, SQL_PASSWORD,SQL_DBNAME) or die("Nelze se připojit k serveru MYSQL (transakce)");
$GLOBALS["CestaProOdkaz"] = "http://$_SERVER[SERVER_NAME]" . substr($_SERVER["PHP_SELF"], 0, strrpos($_SERVER["PHP_SELF"], "/"));
@mysql_select_db(SQL_DBNAME) or die("Nelze vybrat databázi ".SQL_DBNAME.".");
mysql_query("SET NAMES 'utf8'");
mysqli_query($GLOBALS["link_transakce"],"SET NAMES 'utf8'");
setlocale(LC_CTYPE, 'cs_CZ');
?>