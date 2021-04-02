<?php

$name = $_REQUEST["name"];
$identification_card = $_REQUEST["identification_card"];
$cli_carId = $_REQUEST["cli_carId"];
$phone = $_REQUEST["phone"];


//1- conect to database
$host = "localhost";
$dbname = "car_workshop_db_2021";
$ussername = "root";
$password = "";

$cnx = new PDO("mysql:host=$host;dbname=$dbname", $ussername, $password);

//2. Build SQL sentence

$sql = "INSERT INTO client (id, name, identification_card, cli_carId, phone) VALUES (NULL, '$name', '$identification_card',  '$cli_carId',  '$phone')";

//3. prepare SQL sentence

$q = $cnx->prepare($sql);

//4. execute SQL sentence

$result = $q->execute();
if($result){
    echo "Client saved sucessfully";
}
else{
    echo "There was an error creating the client $name";

}
?>
