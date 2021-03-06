<?php

    //conexion a la BDD e inicio de sesión.
    include '../php/connection.php';

    /* var_dump($_SESSION['id']);
    var_dump($_SESSION['nivelUsuario']); */


    //se realiza validación en caso de que ya exista una sesión, manejo de accesos.
    if (isset($_SESSION['id'])) {
        if(isset($_SESSION['nivelUsuario'] )){
            if($_SESSION['nivelUsuario'] == 4){
                header("Location: ../vistasadmin/home_admin.php");
            }
        }
    }else{
        header("Location: ../index.php");
    }


    //Captura de variables de sesion (USUARIO-ADMIN)
    $id_usuario = $_SESSION['id'];
    $nombre_usuario = $_SESSION['nombreUsuario'];
    $nivel = $_SESSION['nivelUsuario'];
    $habilitado = $_SESSION['habilitarUsuario'];
    $correo_usuario = $_SESSION['correoUsuario'];

?>


<!-- ARCHIVO DOOM -->
<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../resources/img/icons/logo_ico.ico">
    <title>Inicio</title>
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- FONTS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Red+Rose&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap">
    
    <!--STYLE SHEETS -->
    <link rel="stylesheet" href="../css/ussers/styles.css">
    <link rel="stylesheet" href="../css/ussers/btn.css">

</head>

<!-- CODIGO PHP-->


    

<body>

    <header>
        <div class="logo_banner" style="background-color: #ffffff;">
            
            <img src="../resources/img/icons/LOGO_LARGE.png" style="width: 200px;margin-left: 23px; margin-top: auto;"><a href="../php/logout.php"><img class="float-end" src="../resources/img/icons/logout.png" style="width: 50px;margin-top: 10px;margin-right: 10px;"></a>
        </div>
    </header>
    <div>

        <!-- NAV BAR -->
        <nav class="navbar navbar-light navbar-expand-md" style="background: #57638F;">
            <div class="container-fluid"><a class="navbar-brand" href="#"></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link active usser_nick m-lg-1 usser_nick p-lg-0.1" href="home.php" style="font-family: 'Red Rose', serif;background: #ffffff;border-radius: 7px;color: #98bd9d;text-align: center;">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link usser_nick m-lg-1 usser_nick p-lg-0.1" href="misarchivos.php" style="font-family: 'Red Rose', serif;background: #98bd9d;border-radius: 7px;color: rgb(255,255,255);text-align: center;">Mis archivos</a></li>
                        <li class="nav-item"><a class="nav-link usser_nick m-lg-1 usser_nick p-lg-0.1" href="subir_Archivo.php" style="font-family: 'Red Rose', serif;background: #98bd9d;border-radius: 7px;color: rgb(255,255,255);text-align: center;">Subir archivos</a></li>
                        <li class="nav-item"><a class="nav-link usser_nick m-lg-1 usser_nick p-lg-0.1" href="ayuda.php" style="font-family: 'Red Rose', serif;background: #98bd9d;border-radius: 7px;color: rgb(255,255,255);text-align: center;">Ayuda</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>


    <!-- COLUMNAS INICIO -->
    <div>
        <div class="container">
            <!-- FILA -->
            <div class="row">
               <!-- COLUMNA 1 --> 
                <div class="col-xl " style="display:inline; border-radius: 20px;box-shadow: 5px 5px 5px rgba(33,37,41,0.39);border-style: solid;border-color: #98bd9d;margin-top: 15px; background-color: #ffffff;">
                    <h1 style="font-family: 'Red Rose', serif;text-align: center;font-size: 30px;margin-top: 10px;">BIENVENID@ <?php echo $nombre_usuario?></h1>
                    <h3 style="font-family: 'Red Rose', serif;text-align: center;color:#98bd9d;font-size: 20px;margin-top: 10px;">Nivel: <?php echo $nivel?></h3>
                    <p style="text-align: center;font-family: 'Red Rose', serif;color: #57638f;font-size: 18px;">¡Comienza a subir archivos desde ahora!</p>
                    
                    

                    <div class="container">
                        <a href="subir_Archivo.php"><button class="btn-outline-primary" style="font-family: 'Red Rose', serif;font-size: 13px;">SUBIR ARCHIVO</button></a>
                        <br><br>
                        <a href="misarchivos.php"><button class="btn-outline-primary" style="font-family: 'Red Rose', serif;font-size: 13px;">IR A ARCHIVERO</button></a>
                    </div>    
                    
                    
                    <p style="text-align: center;font-family: 'Red Rose', serif;color: #98bd9d;font-size: 18px;margin-top: 30px;">¿Tienes dudas? Contáctanos</p>
                </div>

                <!-- COLUMNA DOS -->
                <div class="col-xl" style="border-radius: 20px;box-shadow: 5px 5px 5px rgba(33,37,41,0.39);border-style: solid;border-color:#57638F;margin-top: 15px; margin-left: 15px; background-color: #ffffff;">
                    <h1 style="font-family: 'Red Rose', serif;text-align: center;font-size: 30px;margin-top: 10px;color: var(--bs-gray-900);">¿Cómo usar PACKFILE?</h1>
                    <p style="text-align: center;font-family: 'Red Rose', serif;color: #57638f;font-size: 18px;">¿Por dónde empiezo?</p>
                    <div id="wrapper" class="legend" style="padding: 5%; text-align: justify; color:#57638f">
                        <p>
                            Pack File es un sistema gestor de archivos en el cual podrás compartir y socializar tus 
                            archivos con colegas, asi como disponer de un espacio en la nube el cual te permitirá
                            descargarlos en cualquier momento y en cualquier lugar. </p> 

                        <p>Siempre y cuando cuentes con una conexion por supuesto ;)
                            Ante cualquier duda, no dudes en ponerte en contacto con el administrador en turno a través
                            de la sección de "Ayuda".</p> 
                        
                    </div>
                    <p style="text-align: center;font-family: 'Red Rose', serif;color: #98bd9d;font-size: 18px;margin-top: 30px;">¡ Packfile, tu portafolio digital !</p>
                </div>


                

            </div>
        </div>
    </div>
    


    <!-- DO NOT TOUCH:  Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

<footer class="container" style="text-align: center; color:#57638F">
    <br>
    <h4>Packfile - 2021</h4>
</footer>

</html>