<?php

//required headers
 header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



require_once "../classes/stockmarket.php";
require_once "../classes/database.php";

$database =  new Database();
// instantiate product object with database connection as argument
$stockmarket = new Stockmarket($database->getConnection());

// get posted data, because its json we need file_get_contents, php://input is a stream
//$data = file_get_contents(("php://input"));
$data = json_decode(file_get_contents("php://input"));//single object

var_dump($data);
// make sure data is not empty
if (
     !empty($data->name) 
     // !empty($data->date) 
    // !empty($data->open) &&
    // !empty($data->high) &&
    // !empty($data->low) &&
    // !empty($data->close) &&
    // !empty($data->volume) &&
    // !empty($data->adj_high) &&
	// !empty($data->adj_low) &&
	// !empty($data->adj_volume)
) {
	
	

    // set product property values
    $stockmarket->name = $data->name;
    $stockmarket->date = $data->date;
    $stockmarket->open = $data->open;
    $stockmarket->high = $data->high;
    $stockmarket->low = $data->low;
    $stockmarket->close = $data->close;
    $stockmarket->volume = $data->volume;
    $stockmarket->adj_high = $data->adj_high;
    $stockmarket->adj_low = $data->adj_low;
	 $stockmarket->adj_volume = $data->adj_volume;




    // create the product
    if ($stockmarket->addStock()) {

        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "stockmarket product was created."));
    }

    // if unable to create the product, tell the user
    else {

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to create product."));
    }
}

// tell the user data is incomplete
else {

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}
