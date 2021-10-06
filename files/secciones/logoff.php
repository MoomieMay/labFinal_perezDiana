<?php 


    session_start();
    unset($_SESSION['id_cuenta']);
    unset($_SESSION['cuenta']);
    unset($_SESSION['apellido']);
    unset($_SESSION['nombre']);
    unset($_SESSION['logueado']);
    unset($_SESSION['perfil']);
    session_destroy();
    if((session_id() != "") || isset($_COOKIE[session_name()])){
        if (setcookie(session_name(), '', time()-3600, '/')){
            header("Refresh:0;URL=../../files/index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=devide.width, initial-scale=1">
        <title> Arte Independiente </title>
        <base href="http://localhost/labFinal_perezDiana/"/> 
        <link rel="icon" href="../labFinal_perezDiana/img/pin-logo.png" type="image/png" sizes="16x16">
        
    </head>
</html>



