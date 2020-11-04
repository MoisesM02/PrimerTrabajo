<?php
include("connection.php");
if(isset($_POST["id"]) && !empty($_POST["id"])){
    $id = $_POST["id"];
    $stmt = $conn->prepare("DELETE from Servicios WHERE ID =:id;");
    try{
        $result = $stmt->execute(["id" => $id]);
    if($result){
        echo "Producto eliminado correctamente";
    }else{
        echo "Ocurrió un problema al eliminar el producto";
    }
    }catch(PDOException $e){
        $conn->rollback();
        throw $e;
    }
    
}

?>