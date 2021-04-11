<?php


//1- conect to database
$host = "localhost";
$dbname = "car_workshop_db_2021";
$ussername = "root";
$password = "";

$cnx = new PDO("mysql:host=$host;dbname=$dbname", $ussername, $password);

//2. Build SQL sentence
$sql = "SELECT  id, name FROM client";
//3. prepare SQL sentence
$q = $cnx->prepare($sql);
//4. execute SQL sentence
$result = $q->execute();
$client= $q->fetchAll();

//2. Build SQL sentence
$sql = "SELECT  id, car_cliId FROM cars";
//3. prepare SQL sentence
$q = $cnx->prepare($sql);
//4. execute SQL sentence
$result = $q->execute();
$cars= $q->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create repair</title>
</head>

<body>

<form action="save-repair.php" method="POST">
Vehicle repair <br>
<br>
<br>
Client
<br>
<select name="client" id="">

<?php
for($i=0; $i<count($client); $i++) {
?>
<option value="<?php echo $client[$i]["id"] ?>">
<?php echo $client[$i]["name"] ?>
</option>

<?php
}

?>

</select>
<br>
<br>
Car
<br>
<select name="cars" id="">

<?php
for($i=0; $i<count($cars); $i++) {
?>
<option value="<?php echo $cars[$i]["id"] ?>">
<?php echo $cars[$i]["car_cliId"] ?>
</option>

<?php
}

?>

</select>
<br>
<br>

<br>
Description <input type="text" name= "description"> <br/>
<br>
Admission Date <input type="date" name= "admission_date"> <br/>
<br>
Departure Date <input type="date" name= "departure_date"> <br/>
<br>
<input type="submit" value= "save Repair">
</form>
    
</body>
</html>