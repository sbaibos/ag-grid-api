<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once "../classes/stockmarket.php";
require_once "../classes/database.php";


$database = new Database();

$stockmarket = new Stockmarket($database->getConnection());

$read = $stockmarket->readStock();
$num = $read->rowCount();

if($num>0){
 
    // products array
    $stock_arr=array();
    
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
	

	
	
	 while ($row = $read->fetch(PDO::FETCH_ASSOC)){

        
        // extract row
        //this will make $row['name'] to
        // // just $name only
       extract($row);
 
         $project_item=array(
             "name" => $name,
			  "date" => $date,
             "open" => floatval($open),
			 "high" => floatval($high),
			 "low"=>floatval($low),                        
             "close"=>floatval($close),
			 "volume"=>intval($volume),
			 "adj_volume"=>floatval($adj_volume),
             "adj_high"=>floatval($adj_high),
            "adj_low"=>floatval($adj_low),
			"id"=>floatval($id)
					
			      
       );
	   
	   
	   
   
	   array_push($stock_arr, $project_item);
	 
	  }  
	   
	      
 
         
    
 
    // // set response code - 200 OK
     http_response_code(200);
 
    // // show products data in json format
     echo json_encode($stock_arr);
	 
 }
 
 else{
 
    // // set response code - 404 Not found
    http_response_code(404);
 
    // // tell the user no products found
     echo json_encode(
        array("message" => "No stockdata found.")
    );
 }
	
	
	
 
	 
	 





?>