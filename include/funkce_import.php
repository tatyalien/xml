<?php

/**
 * Struktura XML:
 * <EVENT>  
 * <CONTACT>petričenka</CONTACT>
 * <FROM>&ME;</FROM>
 * <TIME>20:00:52</TIME>
 * <DATE>2008-02-05</DATE>
 * <PROTOCOL>ICQ</PROTOCOL>
 * <ID>159475902</ID>
 * <TYPE>&MSG;</TYPE>
 * <MESSAGE>cusik, hele jakze to mas mejlik? petinka1 nebo jak?</MESSAGE>
 * <URL></URL> - někdy!!!
 * </EVENT>
 */


/*
Načte soubor xml a uloží obsah do DB
@param string $SouborXML
@return string $TextNaVraceni
*/
function nactiXML($SouborXML)
{
$TextNaVraceni = '';

    // pokud soubor existuje, importuji ho, jinak vypíšu chybu
    if (!File_Exists($SouborXML)) {
        return "ERROR - nenačten soubor: '$SouborXML'.<br />";
    } else {
        $TextNaVraceni .= "Načtení souboru: $SouborXML<br>";
        // načtení xml souboru
        $xml = simplexml_load_file($SouborXML);
        // xml soubor se musí načíst nejdřív do paměti, to chvilu trvá...
        // proměnné pro aktualizaci počítadla
        $i_radek = 0;
        // celkový počet řádků -> zboží
        $i_celkem_radku = count($xml->EVENT);

        $TextNaVraceni .= "Celkem rádků v xml: $i_celkem_radku<br>";
        $Zpravy = array();
        foreach ($xml->EVENT as $item) {
            $attr = $item->attributes();
            /*
            když mělo pole jako klíč datetime, tak mě to blbo...:
            Pole bude mít klíč DATETIME -> datum + čas
            
            U vstupních dat mělo 3006 event uzlů, ale pole 2997, proto raději pole má klíče 0,1,2,3...
            $item->DATE.' '.$item->TIME
            */
            $Zpravy[] = array("CONTACT" => (string )$item->CONTACT, "FROM" => (string )$item->
                FROM, "TIME" => (string )$item->TIME, "DATE" => (string )$item->DATE, "PROTOCOL" =>
                (string )$item->PROTOCOL, "ID" => (string )$item->ID, "TYPE" => (string )$item->
                TYPE, "MESSAGE" => (string )$item->MESSAGE, "URL" => (isset($item->URL)) ? (string )
                $item->URL : '', "FILE" => (isset($item->FILE)) ? (string )$item->FILE : '', );
            $i_radek++;
            unset($attr);
        };
        
        $TextNaVraceni .= "Zpracováno řádků: $i_radek<br>";
        $i = 0;
        foreach ($Zpravy as $key => $value) {
            $VlozitData = array();
            $VlozitData["t_CONTACT"] = "'" . saveDB($value['CONTACT']) . "'";
            $VlozitData["t_FROM"] = "'" . saveDB($value['FROM']) . "'";
            $VlozitData["t_TIME"] = "'" . saveDB($value['TIME']) . "'";
            $VlozitData["t_DATE"] = "'" . saveDB($value['DATE']) . "'";
            $VlozitData["t_PROTOCOL"] = "'" . saveDB($value['PROTOCOL']) . "'";
            $VlozitData["t_ID"] = "'" . saveDB($value['ID']) . "'";
            $VlozitData["t_TYPE"] = "'" . saveDB($value['TYPE']) . "'";
            $VlozitData["t_MESSAGE"] = "'" . saveDB($value['MESSAGE']) . "'";
            $VlozitData["t_URL"] = ($value['URL'] != '') ? "'" . saveDB($value['URL']) . "'" :
                "NULL";
            $VlozitData["t_FILE"] = ($value['FILE'] != '') ? "'" . saveDB($value['FILE']) .
                "'" : "NULL";

            if (!InsertTabulkyMysql($GLOBALS["TABLE_HISTORIE"], $VlozitData)) {
                $TextNaVraceni .= "ERROR - Nepodařilo se vložit (klíč $key), hodnoty:<br>";
                foreach($value as $key => $value) {
                    $TextNaVraceni .= "$key:$value<br>";    
                };
                $TextNaVraceni .= "<hr />";
            }
            ;
            unset($VlozitData);
            $i++;
        };
        return $TextNaVraceni;
    }
}

/*
Načte soubor xml a uloží obsah do DB - pouze změny oproti tomu co je v db
@param string $SouborXML
@return string $TextNaVraceni
*/
function nactiJenZmenyXML($SouborXML)
{
$TextNaVraceni = '';
    // pokud soubor existuje, importuji ho, jinak vypíšu chybu
    if (!File_Exists($SouborXML)) {
        return "ERROR - nenačten soubor: '$SouborXML'.<br />";
    } else {
        $TextNaVraceni .= "Načtení souboru: $SouborXML<br>";
        // načtení xml souboru
        $xml = simplexml_load_file($SouborXML);
        // xml soubor se musí načíst nejdřív do paměti, to chvilu trvá...
        // proměnné pro aktualizaci počítadla
        $i_radek = 0;
        // celkový počet řádků -> zboží
        $i_celkem_radku = count($xml->EVENT);

        $TextNaVraceni .= "Celkem rádků: $i_celkem_radku<br>";
        $Zpravy = array();
        foreach ($xml->EVENT as $item) {
            $attr = $item->attributes();

            /*
            když mělo pole jako klíč datetime, tak mě to blbo...:
            Pole bude mít klíč DATETIME -> datum + čas
            
            U vstupních dat mělo 3006 event uzlů, ale pole 2997, proto raději pole má klíče 0,1,2,3...
            $item->DATE.' '.$item->TIME
            */
            $Zpravy[] = array("CONTACT" => (string )$item->CONTACT, 
                "FROM" => (string )$item->FROM, 
                "TIME" => (string )$item->TIME, 
                "DATE" => (string )$item->DATE, 
                "PROTOCOL" => (string )$item->PROTOCOL, 
                "ID" => (string )$item->ID, 
                "TYPE" => (string )$item->TYPE, 
                "MESSAGE" => (string )$item->MESSAGE, 
                "URL" => (isset($item->URL)) ? (string) $item->URL : '',   
                "FILE" => (isset($item->FILE)) ? (string) $item->FILE : '',              
                );
            $i_radek++;
        }
        $i = 0;
        $nezadano = 0;
        foreach ($Zpravy as $key => $value) {
            $VlozitData = Array();
            $VlozitData["t_CONTACT"] = "'". saveDB($value['CONTACT'])."'";
            $VlozitData["t_FROM"] = "'". saveDB($value['FROM'])."'";
            $VlozitData["t_TIME"] = "'". saveDB($value['TIME'])."'";
            $VlozitData["t_DATE"] = "'". saveDB($value['DATE'])."'";
            $VlozitData["t_PROTOCOL"] = "'". saveDB($value['PROTOCOL'])."'";
            $VlozitData["t_ID"] = "'". saveDB($value['ID'])."'";
            $VlozitData["t_TYPE"] = "'". saveDB($value['TYPE'])."'";
            $VlozitData["t_MESSAGE"] = "'". saveDB($value['MESSAGE'])."'";
            $VlozitData["t_URL"] = ($value['URL'] != '') ? "'". saveDB($value['URL'])."'" : "NULL";
            $VlozitData["t_FILE"] = ($value['FILE'] != '') ? "'". saveDB($value['FILE'])."'" : "NULL";

            $HledacData = Array();
            $HledacData["t_CONTACT"] = $value['CONTACT'];
            $HledacData["t_FROM"] = $value['FROM'];
            $HledacData["t_TIME"] = $value['TIME'];
            $HledacData["t_DATE"] = $value['DATE'];
            $HledacData["t_PROTOCOL"] = $value['PROTOCOL'];
            $HledacData["t_ID"] = $value['ID'];
            $HledacData["t_TYPE"] = $value['TYPE'];
            $HledacData["t_MESSAGE"] = $value['MESSAGE'];
            $HledacData["t_URL"] = $value['URL'];
            $HledacData["t_FILE"] = $value['FILE'];


            if(!ExitujeVDb($HledacData)) {
                $nezadano++;   
                if (!InsertTabulkyMysql('historie', $VlozitData)) {
                    $TextNaVraceni .= "ERROR - Nepodařilo se vložit (klíč $key), hodnoty:<br>";
                    foreach($value as $key => $value) {
                        $TextNaVraceni .= "$key:$value<br>";    
                    };
                    $TextNaVraceni .= "<hr />";
                };
            };
            unset($VlozitData, $HledacData);
            $i++;
        }
        $TextNaVraceni .= "Dodáno záznamů do DB: $nezadano<br>";
        return $TextNaVraceni;
    }
}

function NacistStatistiku($souborscestou)
{
    $souborscestou = str_replace("\\", "/", $souborscestou);
    $soubor = fopen($souborscestou, "r");
    $text = fread($soubor, filesize($souborscestou));
    fclose($soubor);
    return iconv('windows-1250', 'utf-8', $text);
}


?>
