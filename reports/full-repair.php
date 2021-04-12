<?php


$where = '';

if(isset($_REQUEST['cli_carId'])){
    $cli_carId= $_REQUEST['cli_carId'];
    if($cli_carId != ""){
$where = "WHERE  cl.cli_carId = '$cli_carId'";
}
}

if(isset($_REQUEST['name'])){
    $name = $_REQUEST['name'];
    if($name != ""){
        if($where == ""){
$where = "WHERE cl.name = '$name'";
}
else{
    $where = "$where AND cl.name = '$name'";
}
}
}
if(isset($_REQUEST['mark'])){
    $mark = $_REQUEST['mark'];
    if($mark != ""){
        if($where == ""){
$where = " WHERE ca.mark = '$mark'";
}
else{
    $where = "$where AND ca.mark = '$mark'";
}
}
}
//1- conect to database
$host = "localhost";
$dbname = "car_workshop_db_2021";
$ussername = "root";
$password = "";

$cnx = new PDO("mysql:host=$host;dbname=$dbname", $ussername, $password);

//2. Build SQL sentence

$sql = "SELECT cl.name,cl.cli_carId, ca.mark,ca.model, re.description from repairs re join cars ca on ca.id=re.cars join client cl on cl.cli_carId= ca.car_cliId $where";
//3. prepare SQL sentence



$q = $cnx-> prepare($sql);

//4. execute SQL sentence

$result = $q-> execute();

$repairs = $q-> fetchAll();


?>
                          
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repairs list</title>
</head>
<body>
Mark
<form action="full-repair.php">
<select name="mark">

<option value="">Select</option>
<option value="mazda"> mazda</option>
 <option value="corolla"> corolla</option>
 <option value="toyota"> toyota</option>
 <option value="FIAT"> FIAT</option>

 </select>
 <br> <br>
 License Plate <input type name="cli_carId">
<br> <br>
Name Client <input type text  name ="name">
<br><br>
 <hr/>
<input type="submit"
 value="Search"/>

</form>
<h1>  REPAIRS LIST </h1>
    <table border="1">
        <tr>
           <td>
             Client Name    
         </td>
         <td>
             License Plate    
         </td>
         <td>
             Mark     
         </td>
         <td>
             Model     
         </td>
         <td>
             Description     
         </td>
    </tr>
    
    <?php
     for ($i=0; $i<count($repairs); $i++){
     ?>
    
    <tr>
           <td>
             <?php echo $repairs[$i]["name"] ?>  
         </td>
         <td>
         <?php echo $repairs[$i]["cli_carId"] ?>     
         </td>
         <td>
         <?php echo $repairs[$i]["mark"] ?>      
         </td>
         <td>
         <?php echo $repairs[$i]["model"] ?>      
         </td>
         <td>
         <?php echo $repairs[$i]["description"] ?>      
         </td>
    </tr>
    <?php
    }
    ?>

    </table>
</body>
</html>