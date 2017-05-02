<?php

namespace Sheet03;

include_once("ResultNormalizer.php");
include_once("CSVEncoder.php");
//include_once("ResultSerializer.php");

$content = file_get_contents('noten.csv');
$rows = explode("\n", $content);

/*
 * Versuch den Encoder in OO zu implementieren
 */
//$csv_enc = new CSVEncoder($content);

/*
 * Testausgabe
 */
//var_dump($csv_enc);

// Erstellt ein 2d Array mit den getrennten Atributen aus CSV

$csvarray=array();
foreach ($rows as $row) {
    $csvarray[] = str_getcsv($row);
}

/*
 * Testausgabe
 */
//var_dump($csvarray);


/*
 * Orders the Dater by MartNR
 * uses Selechtionsort
 */
for($i=0; $i < count($csvarray); $i++){
    for($s=$i; $s < count($csvarray); $s++){
        if($csvarray[$s][2]<$csvarray[$i][2]){
            $help=$csvarray[$i];
            $csvarray[$i]= $csvarray[$s];
            $csvarray[$s]=$help;
        }

    }
}
array_pop($csvarray);


// TODO: Deserialize CSV data to Result objects.

?>


<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Klausur-Ergebnisse</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <h1>Klausur-Ergebnisse</h1>

    <h2>Noten</h2>
    <table class="table table-condensed">
        <tr>
            <th>Matrikel-Nummer</th>
            <th>Note</th>
        </tr>

        <?php

        for($i = 1; $i< count($csvarray); $i++){
            printf("<tr><td>" . $csvarray[$i][2] . "</td><td>" . $csvarray[$i][3] . "</td>");

            echo "\n";

        }


        ?>
    </table>

    <h2>Zusammenfassung</h2>
    <ul>
        <?php

        $anzahl=count($csvarray)-1;
        $min=999;
        $npassed=0;
        $avg=0;
        for($i=1;$i<count($csvarray);$i++){
            if($csvarray[$i][3] < $min){
                $min=$csvarray[$i][3];
            }
            if($csvarray[$i][3] > 4){
                $npassed++;
            }
            $avg = $avg + $csvarray[$i][3];

        }
        $avg=$avg/$anzahl;

        printf("Es haben " . $anzahl . " Studenten an  der Klausur teilgenommen. \n 
Davon haben " . $npassed . " nicht bestanden. \n
Der Durchscnitt ist " . $avg . ". \n 
Die beste Note ist " . $min . ". \n");

        // TODO: Print number of participants, best grade, average grade and number of not passed exams.

        ?>
    </ul>
</div>

</body>
</html>
