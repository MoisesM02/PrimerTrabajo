<?php
session_start();
if(!empty($_SESSION["username"])){
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">

    <script src="js/login.js"></script>
</head>
<body>
    <!-- Formulario -->
    <div class="row">
    <div class="col-sm-2 col-md-3 col-lg-3"></div>
    <div class="col-sm-8 col-md-6 col-lg-6">
        <div class="container">
            <div class="card">
            <div class="card-body">
                <form id="LoginForm">
                        <div class="image">
                            <img src="https://is5-ssl.mzstatic.com/image/thumb/Purple124/v4/5c/f2/72/5cf27278-05ee-5433-5110-6bf79b05adc9/AppIcon-0-0-1x_U007emarketing-0-0-0-7-0-0-sRGB-0-0-0-GLES2_U002c0-512MB-85-220-0-0.png/1200x630wa.png" alt="logo">
                        </div>
                    <center><h3>Iniciar sesión</h3></center>
                    <div class="form-group">
                    <label for="Username"><h4>Nombre de usuario</h4></label>
                    <input type="text" id = "Username" class="form-control" placeholder="Nombre de usuario">
                    </div>
                    <div class="form-group">
                    <label for="Password"><h4>Contraseña</h4></label>
                    <input type="Password" id = "Password" class="form-control" placeholder="Contraseña">
                    <br>
                    <input type="checkbox" id="ShowPassword"> <label for="ShowPassword"> Mostrar contraseña</label> 
                    </div>
                    <div class="form-group">
                    <center>
                    <input type="submit" value="Iniciar sesión" class="btn btn-primary" id="enviar">
                    </center>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
    <div class="col-sm-2 col-md-3 col-lg-4"></div>
    </div>
</body>
</html>
