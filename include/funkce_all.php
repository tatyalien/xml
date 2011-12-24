<?php
/**
 * HLAVNÍ NAČÍTACÍ SOUBOR NA FUNKCE
 */
// soubor s konstantama (na připojení do DB) si soubor zavolá sám...
include_once ("./include/funkce_spojeni_mysql.php");
include_once ("./include/funkce_mysql_dotazy.php");
include_once ("./include/funkce_pomocne.php");
include_once ("./include/funkce_import.php");
include_once ("./include/funkce_export.php");

$GLOBALS["TABLE_HISTORIE"] = 'historie';
// cesta
$GLOBALS["cesta"] = "$_SERVER[DOCUMENT_ROOT]" . substr($_SERVER["PHP_SELF"], 0,
    strrpos($_SERVER["PHP_SELF"], "/"));

?>
