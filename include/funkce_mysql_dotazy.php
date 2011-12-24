<?php
function VymazatTabulkuMysql($tabulka) {
    $query = "TRUNCATE TABLE $tabulka";
    // odeslání dotazu a zjištění, zda se příkaz provedl, pokud ne, vypíšu chybovou hlášku
    $result = mysql_query($query);
    return ($result) ? true : false;
}
function PrehoditKodovani($tabulka, $kodovani){
    $query = "ALTER TABLE $tabulka CONVERT TO CHARACTER SET utf8 COLLATE $kodovani";
    $result = mysql_query($query);
    return ($result) ? true : false;
}
function InsertTabulkyMysql($tabulka, array $HodnotyVlozit) {
    // vytvoření dotazu, implode spojí hodnoty dle rozdělovače
    $query = "INSERT INTO $tabulka (".implode(", ", array_keys($HodnotyVlozit)).
        ") VALUES (".implode(", ", $HodnotyVlozit).")";
    $result = mysql_query($query);
    // odeslání dotazu a zjištění, zda se příkaz provedl
    return ($result) ? true : false;
}
function UpdateTabulkyMysql($tabulka, array $HodnotyZmenit, array $HodnotyHledat, $limit = "") {
    // poskládání hodnot typu klíč = hodnota
    array_walk($HodnotyZmenit, create_function('&$val, $key',
        '$val = "$key = $val";'));
    array_walk($HodnotyHledat, create_function('&$val, $key',
        '$val = "$key = $val";'));
    // vytvoření dotazu, implode spojí hodnoty dle rozdělovače
    $query = "UPDATE $tabulka SET ".implode(", ", $HodnotyZmenit)." WHERE ".
        implode(" And ", $HodnotyHledat);
    // pokud je vyplněný limit, dodám ještě tento limit do dotazu
    if($limit != "") $query .= " LIMIT $limit";
    // odeslání dotazu a zjištění, zda se příkaz provedl, pokud ne, vypíšu chybovou hlášku
    $result = mysql_query($query);
    return ($result) ? true : false;
}
function DeleteZaznamuTabulkyMysql($tabulka, array $HodnotySmazat) {
    // poskládání hodnot typu klíč = hodnota
    array_walk($HodnotySmazat, create_function('&$val, $key',
        '$val = "$key = $val";'));
    // vytvoření dotazu, implode spojí hodnoty dle rozdělovače
    $query = "DELETE FROM $tabulka WHERE ".implode(" And ", $HodnotySmazat);
    // odeslání dotazu a zjištění, zda se příkaz provedl, pokud ne, vypíšu chybovou hlášku
	$result = mysql_query($query);
    return ($result) ? true : false;
}
function InsertOnDuplicateKeyUpdate($tabulka, array $HodnotyVlozitNeboZmenit){
    $HodnotyZmenit = $HodnotyVlozitNeboZmenit;
    array_walk($HodnotyZmenit, create_function('&$val, $key', '$val = "$key = $val";'));
    // vytvoření dotazu, implode spojí hodnoty dle rozdělovače
    $query = "INSERT INTO $tabulka (".implode(", ", array_keys($HodnotyVlozitNeboZmenit)).
        ") VALUES (".implode(", ", $HodnotyVlozitNeboZmenit).") ON DUPLICATE KEY UPDATE ";
    $query .= implode(", ", $HodnotyZmenit);
    $result = mysql_query($query);
    // odeslání dotazu a zjištění, zda se příkaz provedl
    return ($result) ? true : false;
}
?>
