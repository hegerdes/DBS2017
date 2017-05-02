<?php
/**
 * Created by PhpStorm.
 * User: Henrik
 * Date: 29.04.2017
 * Time: 19:00
 */

namespace Sheet03;

include_once("Encoder.php");

class CSVEncoder implements Encoder
{
/**
 * Transforms Data from Noten CSV into array
 *
 * @param string $data
 * @return array
 *
 */

public function decode(string $data): array
{
    $rows = explode("\n", $data);

    $csvarray=array();

    foreach ($rows as $row) {
        $csvarray[] = str_getcsv($row);
    }
    return $csvarray;
}


}