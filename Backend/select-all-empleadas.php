<?php
include("connection.php");
$stmt = $conn->prepare("SELECT Nombre_Empleada from Empleadas Where Estado ='Disponible'");
// $stmt = $conn->prepare("SELECT * FROM `LibroServicios` INNER JOIN Empleadas ON LibroServicios.Nombre_Empleada = Empleadas.Nombre_Empleada AND Empleadas.Estado = 'Disponible' GROUP BY LibroServicios.Nombre_Empleada ORDER BY LibroServicios.Nombre_Empleada DESC");
$result = $stmt->execute();
if($result &&  $numRows = $stmt->rowCount() >= 1){
    $json =[];
    while($registro = $stmt->fetch(PDO::FETCH_ASSOC)){
        $json[] = [
            "nombreEmpleada" => utf8_encode($registro["Nombre_Empleada"])
        ];
    }
echo json_encode($json);
}else{
    echo "No se ha encontrado ninguna empleada";
}
?>