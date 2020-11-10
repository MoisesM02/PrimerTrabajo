<?php 
include('connection.php');
if(isset($_POST["now"])){
$fecha = filter_var($_POST["now"], FILTER_SANITIZE_STRING);
$stmt = $conn->prepare("SELECT Habitacion from LibroServicios Where NOW() BETWEEN Fecha_Inicio AND Fecha_Finalizacion;");
$result = $stmt->execute();
if($result && $stmt->rowCount() >=1){
    $stmt2 = $conn->prepare("SELECT Habitacion from Habitaciones WHERE Estado = 'Disponible'");
    $result2 =$stmt2->execute();
    if($result2 && $stmt2->rowCount() >=1){
        $HabitacionesOcupadas = [];
        while($habitaciones = $stmt->fetch(PDO::FETCH_ASSOC)){
            $HabitacionesOcupadas[] =$habitaciones["Habitacion"]; 
        }
        $TotalHabitaciones = [];
        while($habitaciones2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
            $TotalHabitaciones[] =$habitaciones2["Habitacion"]; 
        }
        $HabitacionesFinal = array_diff($TotalHabitaciones, $HabitacionesOcupadas);
        $json = [];
        foreach ($HabitacionesFinal as $Habitacion) {
            $json[] = ["habitacion" => $Habitacion];
        }
        echo json_encode($json);
       
    }
    
}else{
    $stmt2 = $conn->prepare("SELECT Habitacion from Habitaciones WHERE Estado = 'Disponible'");
    $result2 =$stmt2->execute();
    $json = [];
    while ($habitaciones = $stmt2->fetch(PDO::FETCH_ASSOC)) {
        $json[] = ["habitacion" =>$habitaciones["Habitacion"]];
    }
    echo json_encode($json);

}
}else{
    $stmt = $conn->prepare("SELECT Habitacion FROM Habitaciones WHERE Estado = 'Disponible';");
    $result = $stmt->execute();
    if($result && $stmt->rowCount() >=1){
        $json = [];
        while($habitaciones = $stmt->fetch(PDO::FETCH_ASSOC)){
            $json[] = [
                "habitacion" => $habitaciones["Habitacion"]
            ];
        }
        echo json_encode($json);
    }else{
        $message = "No se encontraron habitaciones disponibles";
    $message .= ($result) ? "" : " ";
    echo $message;
    }

}
?>