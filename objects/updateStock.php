<?php

require_once "../classes/stockmarket.php";
require_once "../classes/database.php";


$database = new Database();

$stockmarket = new stockmarket($database->getConnection());

$stockmarket->id  = isset($_GET['id']) ? $_GET['id'] : die();

$data = json_decode(file_get_contents("php://input")); //array of objects
// get object from array 
$object = $data[0];
var_dump($data);
$stockmarket->name = $object->name;
$stockmarket->date = $object->date;
$stockmarket->open = $object->open;
$stockmarket->high = $object->high;
$stockmarket->low = $object->low;
$stockmarket->close = $object->close;
$stockmarket->volume = $object->volume;
$stockmarket->adj_high = $object->adj_high;
$stockmarket->adj_low = $object->adj_low;
$stockmarket->adj_volume = $object->adj_volume;



if ($stockmarket->updateStock()) {

    http_response_code(200);

    echo json_encode(array("data was updated"));
} else {

    http_response_code(503);

    echo json_encode(array("data not updated"));
}
