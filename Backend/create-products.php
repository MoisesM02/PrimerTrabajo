<?php
include('connection.php');
if(isset($_POST["nombre"]) && isset($_POST["codigo"]) && isset($_POST["precioCliente"]) && isset($_POST["precioEmpleado"]) && isset($_POST["categoria"]) && isset($_POST["precioCompra"])){
    
    $nombre = filter_var(utf8_decode($_POST["nombre"]), FILTER_SANITIZE_STRING);
    $codigo = filter_var($_POST["codigo"], FILTER_SANITIZE_STRING);
    $precioCliente = filter_var($_POST["precioCliente"], FILTER_SANITIZE_STRING);
    $precioEmpleado = filter_var($_POST["precioEmpleado"], FILTER_SANITIZE_STRING);
    $precioCompra = filter_var($_POST["precioCompra"], FILTER_SANITIZE_STRING);
    $categoria = strtoupper(filter_var(utf8_decode($_POST["categoria"]), FILTER_SANITIZE_STRING));
    
        try{
        $stmt = $conn->prepare("INSERT INTO Productos (Nombre_de_Producto, Codigo_de_Producto, Precio_Clientes, Precio_Empleado, Categoria, Precio_de_Compra, Cantidad_en_Stock) VALUES(:nombre, :codigo, :precioCliente, :precioEmpleado, :categoria, :precioCompra, 0);");
        $result = $stmt->execute([
            "nombre" => $nombre,
            "codigo" => $codigo,
            "precioEmpleado" => $precioEmpleado,
            "precioCliente" => $precioCliente,
            "precioCompra" => $precioCompra,
            "categoria" => $categoria
        ]);
        if($result){
            echo "Producto añadido correctamente.";
        }else{
            echo "Hubo un error al agregar el producto"; 
        }
        }catch(PDOException $e){
            echo "¿Qué falló?";
            throw $e;
            
        }

}else{
    echo "Debe completar todos los campos";
    print_r($_POST);
}

?>