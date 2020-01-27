<?php

class Stockmarket
{
// database connection 
    private $conn;

// object properties
    public $date;
    public $open;
    public $high;
    public $low;
    public $close;
    public $volume;
    public $adj_volume;
    public $adj_high;
    public $adj_low;

    public $name;
    public $account;
    public $calls;
    public $minutes;

    public $callRecords0name;
    public $callRecords0callId;
    public $callRecords0duration;
    public $callRecords0switchCode;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }


// read athens stock market
    
    // read athens stock market
    function readAthens()
    {


        $query = "SELECT * FROM athens_stock" ;
        $prepared = $this->conn->prepare($query);
        $prepared->execute();

        return $prepared;
    }

    // read athens stock market
    function readBerlin()
    {


        $query = "SELECT * FROM berlin_stock" ;
        $prepared = $this->conn->prepare($query);
        $prepared->execute();

        return $prepared;
    }

    // read athens stock market
    function readCyprus()
    {


        $query = "SELECT * FROM cyprus_stock " ;
        $prepared = $this->conn->prepare($query);
        $prepared->execute();

        return $prepared;
    }

    // read athens stock market
    function readTorondo()
    {


        $query = "SELECT * FROM torondo_stock " ;
        $prepared = $this->conn->prepare($query);
        $prepared->execute();

        return $prepared;
    }

 // read mytable  stock market
 function readMytable()
 {


     $query = "SELECT * FROM mytable " ;
     $prepared = $this->conn->prepare($query);
     $prepared->execute();

     return $prepared;
 }

 // read all tables from  stock market
 function readStock()
 {


     //$query = "SELECT stock_market.name, athens_stock.date FROM athens_stock INNER JOIN stock_market on stock_market.name = athens_stock.name" ;
	 $query = "select * from athens_stock union select * from  usa_stock union SELECT  * from berlin_stock union select * from cyprus_stock  " ;
     $prepared = $this->conn->prepare($query);
     $prepared->execute();

     return $prepared;
 }



//     // read project by id
//     function read_by_id()
//     {
//         //query with positional parameters
//         $query = "SELECT id, name, date, open, high, low, close, volume, adj_open, created FROM projects WHERE id = ? LIMIT
//         0,1";
//         $prepared = $this->conn->prepare($query);
       
//         $prepared->bindParam(1, $this->id);
//         $prepared->execute();

//         return $prepared;
        
//     }
// // delete projects
//     function delete()
//     {

//         //query with positional parameters
//         $query = "DELETE from projects where id =?";
//         $prepared = $this->conn->prepare($query);
       
//         $prepared->bindParam(1, $this->id);

//         if ($prepared->execute()) {

//             return true;
//         } else {


//             return false;
//         }
//     }
// // create projects
//     function add()
//     {

//         //query with named parameters
//         $query = "INSERT INTO projects SET name=:name, date=:date, open=:open, high=:high, low=:low, close=:close, volume=:volume, adj_open=:adj_open, created=:created";
//         $prepared = $this->conn->prepare($query);

//         $this->name = htmlspecialchars(strip_tags($this->name));
//         $this->date = htmlspecialchars(strip_tags($this->date));
//         $this->open = htmlspecialchars(strip_tags($this->open));
//         $this->high = htmlspecialchars(strip_tags($this->high));
//         $this->low = htmlspecialchars(strip_tags($this->low));
//         $this->close = htmlspecialchars(strip_tags($this->close));
//         $this->volume = htmlspecialchars(strip_tags($this->volume));
//         $this->adj_open = htmlspecialchars(strip_tags($this->adj_open));
//         $this->created = htmlspecialchars(strip_tags($this->created));


//         // bind values 
//         $prepared->bindParam(":name", $this->name);
//         $prepared->bindParam(":date", $this->date);
//         $prepared->bindParam(":open", $this->open);
//         $prepared->bindParam(":high", $this->high);
//         $prepared->bindParam(":low", $this->low);
//         $prepared->bindParam(":close", $this->close);
//         $prepared->bindParam(":volume", $this->volume);
//         $prepared->bindParam(":adj_open", $this->adj_open);
//         $prepared->bindParam(":created", $this->created);

//         if ($prepared->execute()) {

//             return true;
//         } else {

//             return false;
//         }
//     }

// update projects
    function updateStock()
    {

        $query = "UPDATE athens_stock SET name = :name, date = :date, 
        open = :open, high = :high, 
        low = :low, close = :close,
        volume = :volume, adj_high = :adj_high,
        adj_low = :adj_low,adj_volume = :adj_volume
    
                WHERE id = :id";

        $prepared = $this->conn->prepare($query);


        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->name = htmlspecialchars(strip_tags($this->name));
       $this->date = htmlspecialchars(strip_tags($this->date));	
        $this->open = htmlspecialchars(strip_tags($this->open));
        $this->high = htmlspecialchars(strip_tags($this->high));
        $this->low = htmlspecialchars(strip_tags($this->low));
        $this->close = htmlspecialchars(strip_tags($this->close));
        $this->volume = htmlspecialchars(strip_tags($this->volume));       
        $this->adj_high = htmlspecialchars(strip_tags($this->adj_high));
        $this->adj_low = htmlspecialchars(strip_tags($this->adj_low));        
        $this->adj_volume = htmlspecialchars(strip_tags($this->adj_volume));
// bind values
        $prepared->bindParam(':id', $this->id);
        $prepared->bindParam(':name', $this->name);
        $prepared->bindParam(':date', $this->date);
        $prepared->bindParam(':open', $this->open);
        $prepared->bindParam(':high', $this->high);
        $prepared->bindParam(':low', $this->low);
        $prepared->bindParam(':close', $this->close);
        $prepared->bindParam(':volume', $this->volume);     
        $prepared->bindParam(':adj_high', $this->adj_high);
        $prepared->bindParam(':adj_low', $this->adj_low);       
        $prepared->bindParam(':adj_volume', $this->adj_volume);

        if ($prepared->execute()) {


            return true;
        } else {

            return false;
        }
    }
}
