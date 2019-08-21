<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once "../classes/stockmarket.php";
require_once "../classes/database.php";


$database = new Database();

$project = new Project($database->getConnection());

$read = $project->readMytable();
$num = $read->rowCount();

if($num>0){
 
    // products array
    $master_arr=array();
    //$details_arr=array();
    //$master_arr["Torondo"]=array();
    
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $read->fetch(PDO::FETCH_ASSOC)){

        
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        
        $project_item=array(
            "name" => $name,
            "account" => $account,
			"calls" => $calls,
            "minutes"=>$minutes,
            "callRecords" =>array("callRecords0name"=>$callRecords0name,
			"callRecords0callId"=>$callRecords0callId,
			"callRecords0duration"=>$callRecords0duration,
            "callRecords0switchCode"=>$callRecords0switchCode),                        
            
                    );
 
        array_push($master_arr, $project_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($master_arr);
}
 
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No stockdata found.")
    );
}




?>