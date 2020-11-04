<?php
include("connection.php");
session_start();

if(!empty($_POST)){
    $username = $_POST['usuario'];
    $password = $_POST['contra'];

    $usernameSanitized = htmlspecialchars($username);
    $passwordSanitized = htmlspecialchars($password);
    $pwdEncrypted = hash("sha512", $passwordSanitized);
    $stmt = $conn->prepare("Select * from Usuarios where Nombre_de_Usuario =:user AND Password =:pwd");
    $stmt->execute(["user" => $usernameSanitized, "pwd" => $pwdEncrypted]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result['Nombre_de_Usuario'] == $username){
       $_SESSION["username"] = $username;
         
        
        $json = [
            "success" => TRUE,
            "message" => "Inicio de sesión correcto"
        ];
        echo json_encode($json);
    }else{
        echo "Nombre de usuario o contraseña incorrecta.";
    }
}

?>