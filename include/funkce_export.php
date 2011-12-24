<?php
/*
 Exportuje data do xml
*/
function Exportovat($SouborCesta)
{
    $text = '';
    $query = "SELECT t_CONTACT, t_FROM, t_TIME, t_DATE, t_PROTOCOL, t_ID, t_TYPE, t_MESSAGE, t_URL, t_FILE FROM historie ORDER BY t_DATE, t_TIME";
    $result = mysql_query($query);
    if (mysql_num_rows($result) == 0) {
        return "Nepodařilo se exportovat.";
    } else {
        
$obsah = '<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE IMHISTORY [
<!ELEMENT IMHISTORY (EVENT*)>
<!ELEMENT EVENT (CONTACT, FROM, TIME, DATE, PROTOCOL, ID?, TYPE, FILE?, URL?, MESSAGE?)>
<!ELEMENT CONTACT (#PCDATA)>
<!ELEMENT FROM (#PCDATA)>
<!ELEMENT TIME (#PCDATA)>
<!ELEMENT DATE (#PCDATA)>
<!ELEMENT PROTOCOL (#PCDATA)>
<!ELEMENT ID (#PCDATA)>
<!ELEMENT TYPE (#PCDATA)>
<!ELEMENT FILE (#PCDATA)>
<!ELEMENT URL (#PCDATA)>
<!ELEMENT MESSAGE (#PCDATA)>
<!ENTITY ME "alien">
<!ENTITY MSG "Zpráva">
<!ENTITY URL "Adresa">
<!ENTITY FILE "File transfer">
<!ENTITY SYS "Zpráva systému">
<!ENTITY ICQCNT "Kontakty">
<!ENTITY SMS "SMS message">
<!ENTITY ICQWP "Webpager message">
<!ENTITY ICQEX "EMail Express message">
<!ENTITY STATUSCNG "Změny stavu">
<!ENTITY SMTP "SMTP Simple Email">
<!ENTITY OTHER "Other events (unknown)">
<!ENTITY NICKCNG "Změny přezdívky">
<!ENTITY AVACNG "Avatar changes">
<!ENTITY WATRACK "WATrack notify">
<!ENTITY STATUSMSGCHG "Status message changes">
<!ENTITY VCALL "Voice call">
<!ENTITY UNK "UNKNOWN">
]>
<IMHISTORY>';
        $obsah .= "\r\n";
        while ($zaznam = MySQL_Fetch_Array($result)) {
            $obsah .= "<EVENT>\r\n";
            $obsah .= "	<CONTACT>".$zaznam["t_CONTACT"]."</CONTACT>\r\n";
            $obsah .= "	<FROM>".PrevodnikAliasu($zaznam["t_FROM"])."</FROM>\r\n";
            $obsah .= "	<TIME>".$zaznam["t_TIME"]."</TIME>\r\n";
            $obsah .= "	<DATE>".$zaznam["t_DATE"]."</DATE>\r\n";
            $obsah .= "	<PROTOCOL>".$zaznam["t_PROTOCOL"]."</PROTOCOL>\r\n";
            $obsah .= "	<ID>".$zaznam["t_ID"]."</ID>\r\n";
            $obsah .= "	<TYPE>".PrevodnikAliasu($zaznam["t_TYPE"])."</TYPE>\r\n";
            $obsah .= "	<MESSAGE>".Nahrad($zaznam["t_MESSAGE"])."</MESSAGE>\r\n";
            if($zaznam["t_URL"] != '') {
                $obsah .= "	<URL>".PrevodnikAliasu($zaznam["t_URL"])."</URL>\r\n";     
            };
            if($zaznam["t_FILE"] != '') {
                $obsah .= "	<FILE>".PrevodnikAliasu($zaznam["t_FILE"])."</FILE>\r\n";     
            };
            $obsah .= "</EVENT>\r\n";
            
            //$obsah .= ExportStrednik($zaznam["nezname_1"], ";") . ";";
            //$obsah .= ExportStrednik($zaznam["nezname_8"], ";") . "\r\n";
        }
        $obsah .= "</IMHISTORY>";
        ZapisDoSouboruTxt($SouborCesta, $obsah, false);
        $text .= "Záznamy exportovány.<br>";
        $text .= "Vytvořen soubor: $SouborCesta";
    }

    // uvolnění paměti
    mysql_free_result($result);
    return $text;
}
?>
