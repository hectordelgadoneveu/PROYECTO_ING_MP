<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="icon" href="../resources/img/icons/logo_ico.ico">
    <title>Subir archivos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Red+Rose&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">

     <!--STYLE SHEETS -->
     
     <link rel="stylesheet" href="../css/ussers/btn.css">
    <link rel="stylesheet" href="../css/ussers/subir_archivo.css">

    
</head>

<!-- CODIGO PHP-->
<?php

    session_start();
    //Validacion de sesión de usuario, si en dado caso no existe, redirecciona a index.php:
    if (!isset($_SESSION['id'])) {
        header("Location: ../index.php");
    }


    //Catura de variables de sesion (USUARIO-ADMIN)
    $id_usuario = $_SESSION['id'];
    $nombre_usuario = $_SESSION['nombreUsuario'];
    $nivel = $_SESSION['nivelUsuario'];
    $habilitado = $_SESSION['habilitarUsuario'];
    $correo_usuario = $_SESSION['correoUsuario'];

?>

<!-- PARTE SUPERIOR DE PAGE (LOGO) -->
<header>
    <div class="logo_banner" style="background-color: #ffffff;">
        
        <img src="../resources/img/icons/LOGO_LARGE.png" style="width: 200px;margin-left: 23px; margin-top: auto;"><a href="../php/logout.php"><img class="float-end" src="../resources/img/icons/logout.png" style="width: 50px;margin-top: 10px;margin-right: 10px;"></a>
    </div>
</header>

<body>
    <div>
        <nav class="navbar navbar-light navbar-expand-md" style="background: #57638F;">
            <div class="container-fluid"><a class="navbar-brand" href="#"></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link active usser_nick m-lg-1 usser_nick p-lg-0.1" href="home.php" style="font-family: 'Red Rose', serif;background: #98bd9d;border-radius: 7px;color: rgb(255,255,255);text-align: center;">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link usser_nick m-lg-1 usser_nick p-lg-0.1" href="misarchivos.php" style="font-family: 'Red Rose', serif;background: #98bd9d;border-radius: 7px;color: #ffffff;text-align: center;border-right-color: 0,;">Mis archivos</a></li>
                        <li class="nav-item"><a class="nav-link usser_nick m-lg-1 usser_nick p-lg-0.1" href="subir_Archivo.php" style="font-family: 'Red Rose', serif;background: #ffffff;border-radius: 7px;color: #98bd9d;text-align: center;">Subir archivos</a></li>
                        <li class="nav-item"><a class="nav-link usser_nick m-lg-1 usser_nick p-lg-0.1" href="ayuda.php" style="font-family: 'Red Rose', serif;background: #98bd9d;border-radius: 7px;color: rgb(255,255,255);text-align: center;">Ayuda</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    
    <div class="container" style="background-color: #ffffff; border-radius: 10px; margin-bottom: 10px;">
            <div class="container" style="margin-left: 19px;margin-top: 25px;"> 
                <h1 style="font-family: Roboto, sans-serif;font-weight: bold;color: #57638f;">SUBIR ARCHIVO</h1>
                <p style="font-family: 'Red Rose', serif;font-size: 20px;color: #98bd9d;margin-top: 15px;">Nombre del archivo</p><input type="text" class="w-50" style="background: #DDD;border-color: rgba(0,0,0,0);border-radius: 6px;">
                <p style="font-family: 'Red Rose', serif;font-size: 20px;color: #98bd9d;margin-top: 20px;">Dirección del archivo</p><input type="text" class="w-50" style="background: #DDD;border-color: rgba(0,0,0,0);border-radius: 6px;">
            </div>
        <div class="drag-area">
            <div class="icon"><i class="fas fa-file-upload"></i></div>
            <header>Arrastre y suelte para subir el archivo</header>
            <span>o</span>
            <button>Busque su archivo</button>
            <input type="file" hidden>
        </div>
    </div>

    <script src="../scripts/js/upload.js"></script>
    
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
</body>


<footer class="container" style="text-align: center; color:#57638F">
    <br>
    <h4>Packfile - 2021</h4>
</footer>
</html>