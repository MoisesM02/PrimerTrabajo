<?php
session_start();
function usernameValue(){
if(!isset($_SESSION["username"]) && empty($_SESSION["username"])){
    header("Location:login.php");
}else{
    echo utf8_encode($_SESSION["username"]);
}
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nombre de la compañía</title>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<input type="hidden" value="<?php usernameValue();?>">
<?php include('includes/menu.php') ?>
   <div class="container">
        <div class="row">
            <div class="col-md-1 mt-4"></div>
            <div class="col-md-3 mt-4">
                <div class="card">
                    <div class="card-header">
                        <strong>Productos</strong>
                    </div>
                    <div class="card-body">
                        <a href="productos.php" class="btn btn-warning">Administrar productos</a>
                        <br><br>
                        <a href="recibosdeproductos.php" class="btn btn-primary">Recibir productos</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-4">
                <div class="card">
                    <div class="card-header">
                        <strong>Servicios </strong>
                    </div>
                    <div class="card-body">
                        <a href="servicios.php" class="btn btn-warning">Administrar servicios</a>
                        <br><br>
                        <a href="librodeservicios.php" class="btn btn-primary">Libro de servicios</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mt-4">
                <div class="card">
                    <div class="card-header">
                        <strong>Ganancias</strong>
                    </div>
                    <div class="card-body">
                        <a href="charts.php" class="btn btn-primary"> Ganancias de servicios</a>
                    </div>
                </div>
            </div>
            <div class="col-md-1 mt-4"></div>
        </div>
   </div>
</body>
</html>