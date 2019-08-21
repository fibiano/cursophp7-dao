<?php

class Sql extends PDO{

private $conn;


public function __construct()
{
    $this->conn= new PDO("mysql:host=localhost;dbname=dbphp7","root","3FqJemMp7@LV9sm");
   }


public function query($rawQuery,$params=array()){

   $stmt=$this->conn->prepare($rawQuery);

   $this->setParams($stmt,$params);

   $stmt->execute();

   return $stmt;

}

private function setParams($statement, $parameters=array()){

    foreach ($parameters as $key => $value) {
        $this->setParam($statement,$key,$value);
    }
}

private function setParam($statement,$key,$value){

    $statement->bindParam($key,$value);
}

public function select($rawQuery,$params=array())
{
    $stmt=$this->query($rawQuery,$params);  
   
   return $stmt->fetchAll(PDO::FETCH_ASSOC);
     

}


public function getConn()
{
return $this->conn;
}


public function setConn($conn)
{
$this->conn = $conn;

return $this;
}
}


?>