<?php

use Components\Database\DataAccessLayer;
use Models\Travel;

require ('autoload.php');

$data = new DataAccessLayer();

$query = $data->getPdo()->prepare('SELECT * FROM travels');
$query->execute();

$travelsArray = [];
while ($row = $query->fetch()) {
    // var_dump($row);
    $travel = new Travel();
    $travel->setId($row['id']);
    $travel->setDeparture($row['departure']);
    $travel->setArrival($row['arrival']);
    $travel->setDate($row['date']);
    $travel->setClientId($row['client_id']);
    $travelsArray[] = serialize($travel);
    file_put_contents('travels.txt', serialize($travel) . PHP_EOL, FILE_APPEND);
}

echo 'fin du script : données enregistré dans travels.txt.';
// $travelsArraySerialize = serialize($travelsArray);
// var_dump($travelsArraySerialize);

// file_put_contents('travels.txt', $travelsArraySerialize);