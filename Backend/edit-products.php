<?php
include('connection.php');
if((isset($_POST["id"]) && !empty($_POST["id"])) && isset($_POST["nombre"]) && isset($_POST["codigo"]) && isset($_POST["precioCliente"]) && isset($_POST["precioEmpleado"]) && isset($_POST["categoria"]) && isset($_POST["precioCompra"]) && isset($_POST["gananciaEmpleado"]) && isset($_POST["gananciaCasa"])){
    $id = filter_var($_POST["id"], FILTER_SANITIZE_STRING);
    $nombre = filter_var(utf8_decode($_POST["nombre"]), FILTER_SANITIZE_STRING);
    $codigo = filter_var($_POST["codigo"], FILTER_SANITIZE_STRING);
    $precioCliente = filter_var($_POST["precioCliente"], FILTER_SANITIZE_STRING);
    $precioCompra = filter_var($_POST["precioCompra"], FILTER_SANITIZE_STRING);
    $precioEmpleado = filter_var($_POST["precioEmpleado"], FILTER_SANITIZE_STRING);
    $categoria = strtoupper(filter_var(utf8_decode($_POST["categoria"]), FILTER_SANITIZE_STRING));
    $gananciaEmpleado = $_POST["gananciaEmpleado"];
    $gananciaCasa = $_POST["gananciaCasa"];
        try{
        $stmt = $conn->prepare("UPDATE Productos SET Nombre_de_Producto =:nombre, Codigo_de_Producto =:codigo, Precio_Empleado =:precioEmpleado, Ganancia_Empleado =:gananciaEmpleado, Ganancia_Casa =:gananciaCasa, Precio_Clientes =:precioCliente, Categoria =:categoria, Precio_de_Compra =:precioCompra WHERE ID_Producto =:id");
        $result = $stmt->execute([
            "nombre" => $nombre,
            "codigo" => $codigo,
            "precioEmpleado" => $precioEmpleado,
            "precioCliente" => $precioCliente,
            "categoria" => $categoria,
            "precioCompra" => $precioCompra,
            "gananciaEmpleado" =>$gananciaEmpleado,
            "gananciaCasa" => $gananciaCasa,
            "id" => $id
        ]);
        if($result){
            echo "Producto actualizado correctamente.";
        }else{
            echo "Hubo un error al actualizar los datos"; 
        }
        }catch(PDOException $e){
            throw $e;
        }
}else{
    echo "Debes ingresar todos los datos";
    print_r($_POST);
}

?>