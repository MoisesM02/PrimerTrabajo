<?php
include("connection.php");
if(isset($_POST["now"])){
    $stmt = $conn->prepare("SELECT Nombre_Empleada from LibroServicios Where NOW() BETWEEN Fecha_Inicio AND Fecha_Finalizacion;");
    $result = $stmt->execute();
    if($result){
        $stmt2 = $conn->prepare("SELECT Nombre_Empleada from Empleadas WHERE Estado = 'Disponible'");
        $result2 =$stmt2->execute();
        if($result2 && $stmt2->rowCount() >=1){
            $EmpleadasOcupadas = [];
            while($Empleadas = $stmt->fetch(PDO::FETCH_ASSOC)){
                $EmpleadasOcupadas[] =$Empleadas["Nombre_Empleada"]; 
            }
            $TotalEmpleadas = [];
            while($Empleadas2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
                $TotalEmpleadas[] =$Empleadas2["Nombre_Empleada"]; 
            }
            $EmpleadasFinal = array_diff($TotalEmpleadas, $EmpleadasOcupadas);
            $json = [];
            foreach ($EmpleadasFinal as $Empleada) {
                $json[] = ["nombreEmpleada" => utf8_encode($Empleada)];
            }
           echo json_encode($json);
           
        }else{
            $message = "No Hay Empleadas en el personal";
        $message .= ($result2) ? "" : " ".$result2->rollback();
        echo $message;
        }
        
    }else{
        $message = "No se encontraron empleadas disponibles";
        $message .= ($result) ? "" : " ";
        echo $message;
    }
}
?>