<?php


$where = '';

if(isset($_REQUEST['identification_card'])){
    $identification_card= $_REQUEST['identification_card'];
    if($identification_card != ""){
$where = "WHERE  cl.identification_card = '$identification_card'";
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
if(isset($_REQUEST['model'])){
    $model= $_REQUEST['model'];
    if($model != ""){
        if($where == ""){
$where = " WHERE ca.model = '$model'";
}
else{
    $where = "$where AND ca.model = '$model'";
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

$sql = "SELECT cl.name, cl.phone,cl.identification_card,ca.km,ca.model, re.admission_date from repairs re join cars ca on ca.id=re.cars join client cl on cl.cli_carId= ca.car_cliId $where";
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
Model
<form action="repair.php">
<select name="model">

<option value="">Select</option>
<option value="1994"> 1994</option>
<option value="2019"> 2019</option>
 <option value="2020"> 2020</option>
 <option value="2021"> 2021</option>
 <option value="2022"> 2022</option>

 </select>
 <br> <br>
 Identification Card <input type name="identification_card">
<br> <br>
Name Client <input type text  name ="name">
<br><br>
<input type="submit"
 value="Search"/>
 <hr/>


</form>
<h1>  REPAIRS LIST </h1>
    <table border="1">
        <tr>
           <td>
             name   
         </td>
         <td>
             phone
         </td>
         <td>
         identification card    
         </td>
         <td>
             km  
         </td>
         <td>
             model   
         </td>
         <td>
                admission date
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
         <?php echo $repairs[$i]["phone"] ?>     
         </td>
         <td>
         <?php echo $repairs[$i]["identification_card"] ?>      
         </td>
         <td>
         <?php echo $repairs[$i]["km"] ?>      
         </td>
         <td>
         <?php echo $repairs[$i]["model"] ?>      
         </td>
         <td>
         <?php echo $repairs[$i]["admission_date"] ?>      
         </td>
    </tr>
    <?php
    }
    ?>

    </table>
</body>
</html>