<?php
$textOk = '';
$textError = '';
$statistika = $GLOBALS["cesta"]."/statistika/dtb_vymazat.txt";

if ($_SESSION["dtb_vymazat"]) {
    $StatistikaVytvoreno = '';
    $StatistikaZbytek = '';
    $StatistikaDoba = '';
    $StatistikaVytvoreno .= "Vytvořeno: ".date("d.m.Y G:i:s")."<br />";
    $time_start = microtime(true);

    $StatistikaZbytek .= (VymazatTabulkuMysql($GLOBALS["TABLE_HISTORIE"])) ? "Tabulka '".$GLOBALS["TABLE_HISTORIE"]."' vymazána.<br />" : "Tabulka '".$GLOBALS["TABLE_HISTORIE"]."' nebyla vymazána.<br />";
    
    $time_end = microtime(true);
	$time = $time_end - $time_start;
    $StatistikaVytvoreno .= "Start: ".StrFTime("%H:%M:%S", $time_start)."<br />";
    $StatistikaVytvoreno .= "Konec: " . StrFTime("%H:%M:%S", $time_end) . "<br />";
    $StatistikaVytvoreno .= "Doba trvání skriptu: ".StrFTime("%H:%M:%S", mktime(0, 0, $time, date("n"), date("d"), date("Y")))."<br />";
    $StatistikaVytvoreno .= "Doba trvání v microsekundách: $time<br />";
    $StatistikaVytvoreno .= "Statistika uložena: $statistika<br />";    
    $DlouhaCara = DlouhaCara(true);
    $textOk = $StatistikaVytvoreno.$StatistikaDoba."\r\n<hr />".$StatistikaZbytek;
    ZapisDoSouboruTxt($statistika,str_replace("<br />","\r\n",str_replace("<hr />",$DlouhaCara,$textOk)));
    unset($DlouhaCara, $StatistikaVytvoreno, $StatistikaSoubory, $StatistikaZbytek, $StatistikaDoba);
    // uložení do sessionu
    $_SESSION["dtb_vymazat"] = false;
    $textOk .= "<p><a href=\"".$GLOBALS["CestaProOdkaz"]."/postup\">Zpět.</a></p>";
} else {
    // pokud soubor neexistuje, vyp├ş┼íu chybovou hl├í┼íku...
    if (!File_Exists($statistika)) {
        $textError .= "ERROR - zdrojový soubor nenalezen. Není soubor: '$statistika'.<br />";
        $textError .= "<p><a href=\"".$GLOBALS["CestaProOdkaz"]."/postup\">Zpět.</a></p>";
    } else {  
    	$textOk = "<p><h2>Výjezd ze souboru statistik:</h2></p>";
    	$textOk .= "<h3>\"$statistika\"</h3>";
    	$textOk .= NaformatujStatistikuProWeb($statistika);
    	$textOk .= "<p><a href=\"".$GLOBALS["CestaProOdkaz"]."/postup\">Zpět.</a></p>";
    }
}
?>