<?php

//required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// require include database and object file
require_once "../classes/stockmarket.php";
require_once "../classes/database.php";

// get database connection
$database = new Database();
// prepare project object
$stockmarket = new Stockmarket($database->getConnection());

// get project id
$stockmarket->id = isset($_GET['id']) ? $_GET['id'] : die();
// set project id to be deleted
if ($stockmarket->deleteStock()) {

    // set response code - 200 ok
    http_response_code(200);

    // tell the user
    echo json_encode(array("message" => "stock was deleted."));
} else {

    http_response_code(503);

    echo json_encode(array("message" => "Unable to delete stock"));
}
