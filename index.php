<?php
session_start();
require "./include/funkce_all.php";
$nactena_stranka = isset($_GET['clanek']) ? preg_replace('/[^a-z0-9_\\-]/i', '', $_GET['clanek']) : 'default';
// načtení části skriptu, pokud existuje
if (file_exists("scripts/$nactena_stranka.php")) {
    //sem muzes nacpat skript ktery neco provede a pak se v pripade potreby presmeruje jinam (aplikacni cast)
    require "scripts/$nactena_stranka.php";
}
?>
<!DOCTYPE html>
<head>
<title>
    Import změn xml souboru ICQ
</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<?php
    echo '<link rel="stylesheet" href="'.$GLOBALS["CestaProOdkaz"].'/css/rozlozeni.css" type="text/css" media="screen, projection, tv" />';
?>
</head>
<body>

<div id="zahlavi"> <!-- záhlaví -->
    Záhlaví
</div> <!-- hlavicka konec -->
		
<div id="obal_obsahu">
    <!-- horní menu -->
        <?php //require "content/menu_vysouvaci.php"; ?>
    <!-- horní menu konec -->	
	
    <div id="menu_leve"> <!-- leve menu -->
	   <?php require "content/menu_leve.php"; ?>
	</div> <!-- leve menu konec -->
	
	<div id="obsah_vnitrni"> <!-- text -->
        <?php if($odhlaseni_na_tvrdo != '') echo '<tag class="error">'.$odhlaseni_na_tvrdo.'</tag>'; ?>
		<?php require "content/$nactena_stranka.php"; // sem nacpes zobrazovaci cast stranky ?>
	</div> <!-- obsah_vnitrni konec -->

    <div id="zapati"> <!-- zápatí -->
	   Vytvořil Petr Řebíček (c)
	</div> <!-- paticka konec -->

</div> <!-- obal_obsahu konec -->
</body>
</html>
