<?php
include('connection.php');
    if(!empty($_POST)){
        $username = $_POST["Username"];
        $pwd1 = $_POST["Pass1"];
        $pwd2 = $_POST["Pass2"];
        $userType = $_POST["usrType"];
        $userType = utf8_decode(filter_var($userType, FILTER_SANITIZE_STRING));
        $username = utf8_decode(filter_var($username, FILTER_SANITIZE_STRING));
        $pwd1 = utf8_decode(filter_var($pwd1, FILTER_SANITIZE_STRING));
        $pwd2 = utf8_decode(filter_var($pwd2, FILTER_SANITIZE_STRING));

        if($pwd1 === $pwd2){
            if(strlen($pwd1) >= 10){
            
            $selectsql = $conn->prepare("SELECT * from Usuarios where Nombre_de_Usuario =:username LIMIT 1");
            $selectsql->execute([":username" => $username]);
            $VerificacionDeUsuario = $selectsql->fetch();
            if(empty($VerificacionDeUsuario["Nombre_de_Usuario"])){
                $data = [
                    "user" => $username,
                    "pwd" => hash('sha512', $pwd1),
                    "usrType" => $userType
                ];
                try{
                $sql = "Insert into Usuarios (Nombre_de_Usuario, Password, Tipo_de_Usuario) VALUES(:user, :pwd, :usrType)";
                $stmt = $conn->prepare($sql);
                $stmt->execute($data);
                echo "Usuario creado exitosamente.";
                }catch(Exception $e){
                    $pdo->rollback();
                    throw $e;
                }
            }else{
                echo "Este usuario ya existe.";
            }
            }else
            echo "La contraseña debe poseer 10 dígitos.";
        }else{
            echo "Las contraseñas deben ser iguales";
        }
    }

?>