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
$az = 0;
$durchgefallen = 0;
$schnitt = 2.0;
$min = 1000.0;


// Über alle Zeilen iterieren
foreach ($rows as $row) {

    // Zeile in Wörter zerlegen
    $words = explode(",", $row);
	$az++;

    // Über alle Wörter der Zeile iterieren
    foreach ($words as $word) {
		// Alle "Wörter" ausgeben
		printf("String Inhalt von word ist %d in der Datei \n", $word);
		
		// Alle "Wörter" ausgeben
		$schnitt = $word;
		printf("Floadt Inhalt von Schnitt ist %d in Datei \n", $schnitt);
		
        //  Anzahl der Noten zählen
        if ($word > 10) {
            $anzahl++;
        }
		// Anzahl der Noten zählen die durchgefallen sind
		if ($word < 10 and $word > 4){
			$durchgefallen++;
		}
		// Suche Minimum - klappt noch nicht
		if ($word < $min){
			$min = $word;
		}
    }
}

// Testet Datentyp
var_dump($schnitt);

// Gabe alles auf Konsle aus
printf("Es haben " . $anzahl . " Studenten an  der Klausur teilgenommen. Davon haben " . $durchgefallen . " nicht bestanden. 
Die beste Note ist " . $min . "Die Daten stammen aus der Datei \"%s\".\n", $path);

?>