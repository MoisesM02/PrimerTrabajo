<?php
$servername = "localhost";
$username = "MoisesM";
$pass = "Mdvlinux23$";

try{
    $conn = new PDO("mysql:host=$servername;dbname=Primertrabajo", $username, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}catch(PDOException $e){
echo "Connection failed: ". $e->getMessage();
}
?>