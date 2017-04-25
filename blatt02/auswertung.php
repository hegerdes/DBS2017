<?php

// Pfad zu der Datei prüfen
$path = (string) $argv[1];
if (!file_exists($path)) {
    printf("%s\n", "Fehler!");
    exit(-1);
}

// Datei einlesen
$content = file_get_contents($path);
$neu = str_word_count($content);

// Inhalt der Datei in Zeilen aufspalten
$rows = explode("\n", $content);

$anzahl = 0;
$durchgefallen = 0;
$schnitt = 0.0;
$min = 1000.0;
$noten = array();

// Test der Dateitypen
/*
var_dump($schnitt);
var_dump($anzahl);
var_dump($durchgefallen);
var_dump($min);
*/

// Über alle Zeilen iterieren
foreach ($rows as $row) {

    // Zeile in Wörter zerlegen
    $words = explode(",", $row);

    // Über alle Wörter der Zeile iterieren
    foreach ($words as $word) {
		// Alle "Wörter" ausgeben
        // printf("String Inhalt von word ist %d in der Datei \n", $word);
		
		// Alle "Wörter" ausgeben
		//$schnitt = $word;
		//printf("Floadt Inhalt von Schnitt ist %d in Datei \n", $schnitt);
		//echo $schnitt;
		
		// Lege alle Noten als Float in ein Array
		if ($word < 6 and $word > 0){
			$noten[$anzahl] = (float)$word;
		}
		
        //  Anzahl der Martikelnumern zählen
        if ($word > 10) {
            $anzahl++;
        }

		// Anzahl der Noten zählen die durchgefallen sind
		if ($word < 6 and $word > 4){
			$durchgefallen++;
		}
		
		
    }
}

for($i = 1; $i < $anzahl; $i++) {
	if ($noten[$i] < $min){
		$min = $noten[$i];
	}
    $schnitt = $schnitt + $noten[$i];
}
$schnitt = $schnitt/$anzahl;

// Testet Datentyp erneut
/*
var_dump($schnitt);
var_dump($anzahl);
var_dump($durchgefallen);
var_dump($min);
echo count($noten);
echo "Array an Stelle 0 ist " . $noten[0] . " und an STelle5 " . $noten[5];
echo $schnitt;
*/

// Gebe alles auf Konsle aus
printf("Es haben " . $anzahl . " Studenten an  der Klausur teilgenommen. \n 
Davon haben " . $durchgefallen . " nicht bestanden. \n
Der Durchscnitt ist " . $schnitt . ". \n 
Die beste Note ist " . $min . ". \n
Die Daten stammen aus der Datei \"%s\".\n", $path);


?>