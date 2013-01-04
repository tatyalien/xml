<?php
// bylo již odesláno?
if (!empty($_POST))
{
    // spuštění skriptů
    if (isset($_POST["vymazat_docasne_tabulky"]) && $_POST["vymazat_docasne_tabulky"])
    {
        header("location:" . $GLOBALS["CestaProOdkaz"] . "/dtb/vymazat/");
    }
    if (isset($_POST["import_xml_hlavni"]) && $_POST["import_xml_hlavni"])
    {
        header("location:" . $GLOBALS["CestaProOdkaz"] . "/import/xml/hlavni/");
    }
    if (isset($_POST["import_xml_zmeny"]) && $_POST["import_xml_zmeny"])
    {
        header("location:" . $GLOBALS["CestaProOdkaz"] . "/import/xml/zmeny/");
    }
    if (isset($_POST["export_sloucena_databaze"]) && $_POST["export_sloucena_databaze"])
    {
        header("location:" . $GLOBALS["CestaProOdkaz"] . "/export/sloucena_databaze/");
    }    
    // vymazání
    if (isset($_POST["vymazat_vymazat_docasne_tabulky"]) && $_POST["vymazat_vymazat_docasne_tabulky"])
    {
        $_SESSION["dtb_vymazat"] = true;
    }
    if (isset($_POST["vymazat_import_xml_hlavni"]) && $_POST["vymazat_import_xml_hlavni"])
    {
        $_SESSION["import_xml_hlavni"] = true;
    }
    if (isset($_POST["vymazat_import_xml_zmeny"]) && $_POST["vymazat_import_xml_zmeny"])
    {
        $_SESSION["import_xml_zmeny"] = true;
    }
    if (isset($_POST["vymazat_export_sloucena_databaze"]) && $_POST["vymazat_export_sloucena_databaze"])
    {
        $_SESSION["export_sloucena_databaze"] = true;
    }
}
?>
