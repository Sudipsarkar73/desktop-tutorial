<?php

$host='localhost';
$db_name="tempproject";
$db_user="root";
$db_pass='';
$db_port=3306;


$conn= new mysqli($host, $db_user, $db_pass, $db_name, $db_port);

if($conn->connect_error){
    echo "error";
}
else{
    echo "connected successfully"."<br>";
}
    

?>