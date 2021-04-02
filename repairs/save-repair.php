<?php

$client = $_REQUEST["client"];
//$license_plate = $_REQUEST["license_plate"];
$cars = $_REQUEST["cars"];
$description = $_REQUEST["description"];
$admission_date = $_REQUEST["admission_date"];
$departure_date = $_REQUEST["departure_date"];


//1- conect to database
$host = "localhost";
$dbname = "car_workshop_db_2021";
$ussername = "root";
$password = "";

$cnx = new PDO("mysql:host=$host;dbname=$dbname", $ussername, $password);

//2. Build SQL sentence
$sql = "INSERT INTO `repairs` (`id`, `client`, `cars`, `description`, `admission_date`, `departure_date`) VALUES (NULL, '$client', '$cars',  '$description', '$admission_date', '$departure_date')";
//3. prepare SQL sentence
$w = $cnx->prepare($sql);
//4. execute SQL sentence


$result = $w->execute();
if($result){
    echo "Repair saved sucessfully";

}
else{
    echo "There was an error creating the repair";

}

?>
