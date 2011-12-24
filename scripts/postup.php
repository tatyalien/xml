<?php
// bylo již odesláno?
if (!empty($_POST))
{
    // spuštění skriptů
    if ($_POST["vymazat_docasne_tabulky"])
    {
        header("location:" . $GLOBALS["CestaProOdkaz"] . "/dtb/vymazat/");
    }
    if ($_POST["import_xml_hlavni"])
    {
        header("location:" . $GLOBALS["CestaProOdkaz"] . "/import/xml/hlavni/");
    }
    if ($_POST["import_xml_zmeny"])
    {
        header("location:" . $GLOBALS["CestaProOdkaz"] . "/import/xml/zmeny/");
    }
    if ($_POST["export_sloucena_databaze"])
    {
        header("location:" . $GLOBALS["CestaProOdkaz"] . "/export/sloucena_databaze/");
    }    
    // vymazání
    if ($_POST["vymazat_vymazat_docasne_tabulky"])
    {
        $_SESSION["dtb_vymazat"] = true;
    }
    if ($_POST["vymazat_import_xml_hlavni"])
    {
        $_SESSION["import_xml_hlavni"] = true;
    }
    if ($_POST["vymazat_import_xml_zmeny"])
    {
        $_SESSION["import_xml_zmeny"] = true;
    }
    if ($_POST["vymazat_export_sloucena_databaze"])
    {
        $_SESSION["export_sloucena_databaze"] = true;
    }
}
?>
