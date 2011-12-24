<?php
if ($_SERVER["SERVER_ADDR"]=="127.0.0.1")
{
    define("SQL_HOST", "localhost");
    define("SQL_DBNAME", "dtb_icq");
    define("SQL_USERNAME", "root");
    define("SQL_PASSWORD", "");
}
else
{
    define("SQL_HOST", "localhost");
    define("SQL_DBNAME", "dtb_icq");
    define("SQL_USERNAME", "root");
    define("SQL_PASSWORD", "");
}
?>
