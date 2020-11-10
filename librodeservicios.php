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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libro de servicios</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/daterangepicker.css">
    <link rel="stylesheet" href="css/productos.css">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/moment-with-locales.min.js"></script>
    <script src="js/daterangepicker.js"></script>
    <script src="js/libroServicios.js"></script>
</head>
<body>
<input type="hidden" id="username" value="<?php usernameValue();?>">
<?php include "includes/menu.php"?>
    <div class="container">
    <div class="row">
        <div class="col-md-2">
            <select class="form-control my-3 Empleadas" id="Empleada">

            </select>
        </div>
        <div class="col-md-2">
            <input class="mt-4 " type="checkbox" id="disponibles"><span class="mt-4"> Disponibles</span>
        </div>
        <div class="col-md-3">
        <div id="reportrange" class="my-3" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
        <i class="fa fa-calendar"></i>&nbsp;
        <span></span> <i class="fa fa-caret-down"></i>
        </div>
     </div>
     <div class="col-md-2">
     <button id="saveButton" class="btn btn-primary my-3">Buscar</button>
     </div>
     <div class="col-md-2">
     <button class="btn btn-primary my-3" id="showModal">Agregar Entrada</button>
     </div>
    </div>
    <div class="tableResponsive pt-3" id="paginationData">
    </div>

    <div id="pages">
    </div>
    </div>
</div>
    <input type="hidden" id="numOfRecords" value="10">
    <input type="hidden" id="PageNumber" value="1">
    <?php include('includes/libro-servicios.php') ?>
</body>
</html>