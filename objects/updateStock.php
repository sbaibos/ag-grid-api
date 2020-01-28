<?php

require_once "../classes/stockmarket.php";
require_once "../classes/database.php";


$database = new Database();

$stockmarket = new stockmarket($database->getConnection());

//$stockmarket->id  = isset($_GET['id']) ? $_GET['id'] : die();  i get id from request body

$data = json_decode(file_get_contents("php://input")); //array of objects
// get object from array 
$object = $data[0];
//for ($i=0;$i<=11;$i++){
	 foreach($data as $key => $value) {
		
$stockmarket->name = $value->name;
$stockmarket->date = $value->date;
$stockmarket->open = $value->open;
$stockmarket->high = $value->high;
$stockmarket->low = $value->low;
$stockmarket->close = $value->close;
$stockmarket->volume = $value->volume;
$stockmarket->adj_high = $value->adj_high;
$stockmarket->adj_low = $value->adj_low;
$stockmarket->adj_volume = $value->adj_volume;
$stockmarket->id=$value->id;
		 
$stockmarket->updateStock()	;	 
}
//var_dump($object);
// $stockmarket->name = $data[0]->name;
// $stockmarket->date = $data[0]->date;
// $stockmarket->open = $data[0]->open;
// $stockmarket->high = $data[0]->high;
// $stockmarket->low = $data[0]->low;
// $stockmarket->close = $data[0]->close;
// $stockmarket->volume = $data[0]->volume;
// $stockmarket->adj_high = $data[0]->adj_high;
// $stockmarket->adj_low = $data[0]->adj_low;
// $stockmarket->adj_volume = $data[0]->adj_volume;
// $stockmarket->id=$object->id;


if ($stockmarket->updateStock()) {

    http_response_code(200);

    echo json_encode(array("data was updated"));
} else {

    http_response_code(503);

    echo json_encode(array("data not updated"));
}
