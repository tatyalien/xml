<form action='' method='post'>
<fieldset>
<legend>Postup aktualizace XML souboru</legend>
<table border="1" style="table-layout: fixed; border-collapse: collapse;">
<tr><th>Popis</th><th>hodnota</th><th>statistika</th></tr>
<tr><td>01 - Načtení - Hlavní databáze XML</td>
<?php
if(!empty($_SESSION["import_xml_hlavni"]) && isset($_SESSION["import_xml_hlavni"]) && $_SESSION["import_xml_hlavni"]) {
    echo "<td><input type='submit' name='import_xml_hlavni' value='Načtení hlavního xml.' /></td><td></td>";
} else {
    echo "<td><input type='submit' name='import_xml_hlavni' value='Zobrazit statistiku.' /></td>";
    echo "<td><input type='submit' name='vymazat_import_xml_hlavni' value='Vymazat statistiku.' /></td>";
}
?>
</tr>
<tr><td>02 - Načtení - změn XML</td>
<?php
if(!empty($_SESSION["import_xml_zmeny"]) && isset($_SESSION["import_xml_zmeny"]) && $_SESSION["import_xml_zmeny"]) {
    echo "<td><input type='submit' name='import_xml_zmeny' value='Načtení změn xml.' /></td><td></td>";
} else {
    echo "<td><input type='submit' name='import_xml_zmeny' value='Zobrazit statistiku.' /></td>";
    echo "<td><input type='submit' name='vymazat_import_xml_zmeny' value='Vymazat statistiku.' /></td>";
}
?>
</tr>
</table>
</fieldset>
<fieldset>
<legend>Export dat</legend>
<table border="1" style="table-layout: fixed; border-collapse: collapse;">
<tr><th>Popis</th><th>hodnota</th><th>statistika</th></tr>
<tr><td>01 - Export sloučené databáze</td>
<?php
if(!empty($_SESSION["export_sloucena_databaze"]) && isset($_SESSION["export_sloucena_databaze"]) && $_SESSION["export_sloucena_databaze"]) {
    echo "<td><input type='submit' name='export_sloucena_databaze' value='Export sloučené databáze.' /></td><td></td>";
} else {
    echo "<td><input type='submit' name='export_sloucena_databaze' value='Zobrazit statistiku.' /></td>";
    echo "<td><input type='submit' name='vymazat_export_sloucena_databaze' value='Vymazat statistiku.' /></td>";
}
?>
</tr>
</table>
</fieldset>
<fieldset>
<legend>Vymazání DB - tabulek</legend>
<table border="1" style="table-layout: fixed; border-collapse: collapse;">
<tr><th>Popis</th><th>hodnota</th><th>statistika</th></tr>
<tr><td>01 - Promazání dočasných tabulek</td>
<?php
if(!empty($_SESSION["dtb_vymazat"]) && isset($_SESSION["dtb_vymazat"]) && $_SESSION["dtb_vymazat"]) {
    echo "<td><input type='submit' name='vymazat_docasne_tabulky' value='Vymazat dočasné tabulky.' /></td><td></td>";
} else {
    echo "<td><input type='submit' name='vymazat_docasne_tabulky' value='Zobrazit statistiku.' /></td>";
    echo "<td><input type='submit' name='vymazat_vymazat_docasne_tabulky' value='Vymazat statistiku.' /></td>";
}
?>
</tr>
</table>
</fieldset>
