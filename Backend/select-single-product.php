<?php
include('connection.php');
if(isset($_POST["id"]) && !empty($_POST["id"])){
$id = $_POST["id"];
try{
$stmt = $conn->prepare("SELECT * from Productos where ID_Producto =:id");
$result = $stmt->execute([":id" => $id]);
if($result){
    $json = [];
    while($producto = $stmt->fetch(PDO::FETCH_ASSOC)){
    $id = $producto["ID_Producto"];
    $nombre = utf8_encode($producto["Nombre_de_Producto"]);
    $Codigo = $producto["Codigo_de_Producto"];
    $precioEmpleado = $producto['Precio_Empleado'];
    $precioClientes = $producto["Precio_Clientes"];
    $precioCompra = $producto["Precio_de_Compra"];
    $cantidad = $producto["Cantidad_en_Stock"];
    $categoria = utf8_encode($producto["Categoria"]);
    $gananciaCasa = $producto["Ganancia_Casa"];
    $gananciaEmpleado = $producto["Ganancia_Empleado"];
    $json[] = [
        "id" => $id,
        "nombre" => $nombre,
        "codigo" => $Codigo,
        "precioEmpleado" => $precioEmpleado,
        "precioCliente" => $precioClientes,
        "cantidad" => $cantidad,
        "precioCompra" => $precioCompra,
        "categoria" => $categoria,
        "gananciaCasa" =>$gananciaCasa,
        "gananciaEmpleado" => $gananciaEmpleado
    ];
    }
    echo json_encode($json);
}
}catch(Exception $e){

throw $e;
}

}else{
    echo "No se ha seleccionado ningún producto. Vuelve a intentarlo";
}

?>