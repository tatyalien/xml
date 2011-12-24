<?php
function saveDB($value)
{
    // ošetření proti injection
    return mysql_real_escape_string($value);
}
function NaformatujStatistikuProWeb($statistika)
{
    $pomocna = str_replace("\r\n", "<br />", DlouhaCara(false, NacistStatistiku($statistika))) .
        "<br />\r\n";
    // stávalo se, že po výjezdu bylo u sebe <br><hr><br> -> nahradím jen "<hr>"
    return str_replace("<br /><hr /><br />", "<hr />", $pomocna);
}
function DlouhaCara($VstupVystup = true, $zdroj = "")
{
    if ($VstupVystup) {
        // pokud je true, vygeneruji posloupnost znaků...
        return str_repeat("_", 100) . "\r\n";
    } else {
        // pokud je false, vygeneruji z posloupnosti znaků html tak <hr>
        // maska znamená pokud se opakuje alespoň 2x znak _ a následuje enter tak to nahraď <hr>
        return ereg_replace("(_{2,})\r\n", "<hr />", $zdroj);
    }
}
function ZapisDoSouboruTxt($SouborNazev, $ZapisTextu, $iconv=true)
{
    // před zapisováním do souboru ještě zkontroluji zda existuje složka, pokud ne, vytvořím jí
    vytvor_strukturu($SouborNazev);
    // vytvoření a zapsání dat do souboru
    $soubor = fopen($SouborNazev, "w");
    // ještě pomocí iconv změním kódování z utf-8 na windowsácké aby fungovala správně čj v excelu atd...
    if ($iconv) {
        fwrite($soubor, iconv('utf-8', 'windows-1250', $ZapisTextu));
    } else {
        fwrite($soubor, $ZapisTextu);    
    }
    fclose($soubor);
}
function vytvor_strukturu($struktura)
{
    // vstupní hodnoty bývají většinou plná cesta i se souborem typu /cesta/cesta/soubor.csv
    // proto si nejdřív z cesty odsekám soubor...
    // Naleznu poslední výskyt lomítka v cestě "/" a pak oříznu řetězec po lomítko
    $struktura = substr($struktura, 0, strrpos($struktura, '/'));
    if (!file_exists($struktura)) {
        if (!mkdir($struktura, 0777, true)) {
            return "ERROR: Adresář nevytvořen. '$struktura'.";
        } else {
            return true;
        }
    } else {
        return true;
    }
}

function PrevodnikAliasu($text) {
    switch ($text) {
        case "alien":
            return "&ME;";
            break;
        case "Zpráva":
            return "&MSG;";
            break;
        case "Adresa":
            return "&URL;";
            break;
        case "File transfer":
            return "&FILE;";
            break;
        case "Zpráva systému":
            return "&SYS;";
            break;
        case "Kontakty":
            return "&ICQCNT;";
            break;
        case "SMS message":
            return "&SMS;";
            break;
        case "Webpager message":
            return "&ICQWP;";
            break;
        case "EMail Express message":
            return "&ICQEX;";
            break;
        case "Změny stavu":
            return "&STATUSCNG;";
            break; 
        case "SMTP Simple Email":
            return "&SMTP;";
            break;
        case "Other events (unknown)":
            return "&OTHER;";
            break; 
        case "Změny přezdívky":
            return "&NICKCNG;";
            break;
        case "Avatar changes":
            return "&AVACNG;";
            break; 
        case "WATrack notify":
            return "&WATRACK;";
            break;
        case "Status message changes":
            return "&STATUSMSGCHG;";
            break;
        case "Voice call":
            return "&VCALL;";
            break;
        case "UNKNOWN":
            return "&UNK;";
            break;
        default:
            return $text;
            break;
    };
}

function Nahrad($text){
    $text = str_replace('&', '&amp;', $text);
    $text = str_replace('@}->--', '@}-&gt;--', $text);
    $text = str_replace('>', '&gt;', $text);
    return $text;
}

function ExitujeVDb($VlozitData) {
    $query = "SELECT t_CONTACT, t_FROM, t_TIME, t_DATE, t_PROTOCOL, t_ID, t_TYPE, t_MESSAGE, t_URL, t_FILE FROM historie WHERE ";
    $podminka = '';
    foreach($VlozitData as $key => $value) {
        if ($value == '') {
            $podminka .= "$key IS NULL AND ";      
        } else {
            $podminka .= "$key = '".saveDB($value)."' AND ";  
        } 
    }
    $podminka = substr($podminka, 0, StrLen($podminka)-4);
    $query .= $podminka." LIMIT 1";
    $result = mysql_query($query);
    if (mysql_num_rows($result) == 0) {
        return 0;
    } else {
        return 1;
    };
}

?>
