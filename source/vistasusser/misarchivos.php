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
    echo("EL NIVEL DEL USUARIO ES: ".$nivel);
    $habilitado = $_SESSION['habilitarUsuario'];
    $correo_usuario = $_SESSION['correoUsuario'];

    //VARIABLES PARA QUERYS INICIALES: Nivel - Tipo (Si en dado caso no recibe datos se ponen datos default)
    $level_query=0;
    $type_query= "";

    if(isset($_GET['level_query'])){
        $level_query= $_GET['level_query'];
    }

    if(isset($_GET['type_query'])){
        $type_query= $_GET['type_query'];
    }

    var_dump("LEVEL_QUERY: ".$level_query);
    var_dump("TYPE: ".$type_query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../resources/img/icons/logo_ico.ico">
    <title>Mis Archivos</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- FONTS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Red+Rose&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap">

    <!--STYLE SHEETS -->
    <link rel="stylesheet" href="../css/ussers/styles.css">
    <link rel="stylesheet" href="../css/ussers/btn.css">

    <!-- JQUERY / AJAX -->
    <script src="../scripts/jquery/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <!-- DATA TABLES -->
    <link rel="stylesheet" href="../librerias/datatable/dataTables.bootstrap5.min.css">

    <!-- VUE JS -->
    <!-- versión de producción, optimizada para tamaño y velocidad -->
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>

    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<!-- CODIGO PHP-->



<body>
    <!-- PARTE SUPERIOR DE PAGE (LOGO) -->
    <header>
        <div class="logo_banner" style="background-color: #ffffff;">
            
            <img src="../resources/img/icons/LOGO_LARGE.png" style="width: 200px;margin-left: 23px; margin-top: auto;"><a href="../php/logout.php"><img class="float-end" src="../resources/img/icons/logout.png" style="width: 50px;margin-top: 10px;margin-right: 10px;"></a>
        </div>
    </header>
    
    <!-- BARRA DE NAVEGACIÓN -->
    <div>
        <nav class="navbar navbar-light navbar-expand-md" style="background: #57638F;">
            <div class="container-fluid"><a class="navbar-brand" href="#"></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link active usser_nick m-lg-1 usser_nick p-lg-0.1" href="home.php" style="font-family: 'Red Rose', serif;background: #98bd9d;border-radius: 7px;color: rgb(255,255,255);text-align: center;">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link usser_nick m-lg-1 usser_nick p-lg-0.1" href="misarchivos.php" style="font-family: 'Red Rose', serif;background: #ffffff;border-radius: 7px;color: #98bd9d;text-align: center;">Mis archivos</a></li>
                        <li class="nav-item"><a class="nav-link usser_nick m-lg-1 usser_nick p-lg-0.1" href="subir_Archivo.php" style="font-family: 'Red Rose', serif;background: #98bd9d;border-radius: 7px;color: rgb(255,255,255);text-align: center;">Subir archivos</a></li>
                        <li class="nav-item"><a class="nav-link usser_nick m-lg-1 usser_nick p-lg-0.1" href="ayuda.php" style="font-family: 'Red Rose', serif;background: #98bd9d;border-radius: 7px;color: rgb(255,255,255);text-align: center;">Ayuda</a></li>
                             
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <!-- FILTROS -->
    
    <div class="cuadro_filtros">
        
        <div class="row">

            <div class="col-md-2 cuadro_filtros_2">

                <a href="micarpeta.php"><button class="btn_analizar" type="button" style="background-color:#57638F; margin-top:10px; margin-bottom:10px; width:100%;">Mi Carpeta</button></a>

                <hr>
                <h4 style="font-family: 'Red Rose', serif;">FILTROS</h4>

                <!--BUSCADOR FORMULARIO -->
                <div class="container" style="background-color: rgb(255, 255, 255); display:flex; justify-content: left;">
                    <form action="misarchivos.php" id="form" name="form" method="get">

                        <!-- FILTROS -->
                        <hr>

                        <!-- FILTROS -->
                        <div style="text-align: left;">
                            <h6 style="font-family: 'Red Rose', serif;">FORMATO</h6>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="type_query" value="" name="type_query" <?php if($type_query == ""){?>checked<?php } ?> >
                                        <label class="form-check-label" for="All">
                                          Todos
                                        </label>
                                      </div>
                                </div>

                                <div class="col-sm">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="type_query" value="pdf" name="type_query" <?php if($type_query == "pdf"){?>checked<?php } ?> >
                                        <label class="form-check-label" for="Pdf">
                                          PDF
                                        </label>
                                      </div>
                                </div>
                            </div>


                            <!-- SEGUNDA FILA DE TIPOS -->
                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="type_query" value="docx" name="type_query" <?php if($type_query == "docx"){?>checked<?php } ?> >
                                        <label class="form-check-label" for="Word">
                                          Word
                                        </label>
                                      </div>
                                </div>

                                <div class="col-sm">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="type_query" value="txt" name="type_query" <?php if($type_query == "txt"){?>checked<?php } ?> >
                                        <label class="form-check-label" for="txt">
                                          TXT
                                        </label>
                                      </div>
                                </div>
                            </div>

                            <!-- LISTA DE CHECKBOX SELECCIONADOS -->
                            <div style="color:#57638F">Ids seleccionados en matriz: <span id="arr" style="color:#66e6b5"></span></div>
                            <div style="color:#57638F">Ids seleccionados: <span id="str" style="color:#66e6b5"></span></div>
                            <hr>
                            

                            <h6 style="font-family: 'Red Rose', serif;">NIVEL</h6>
                            <div class="multi_select_box">
                                <select class="multi_select" name="level_query" id="level_query">
                                    <option value="0" <?php if($level_query == 0){?>selected<?php } ?> >Todos</option>

                                    <?php //LIMITACION DE SELECTOR PARA USUARIOS ?>
                                    <?php if($nivel > 1){?>
                                    <option id="level_query" value="1" <?php if($level_query == 1){?>selected<?php } ?> >1</option>
                                    <?php } ?>

                                    <?php if($nivel> 2){?>
                                    <option id="level_query" value="2" <?php if($level_query == 2){?>selected<?php } ?>>2</option>
                                    <?php } ?>

                                    <?php if($nivel > 5){?>
                                    <option id="level_query" value="3" <?php if($level_query == 3){?>selected<?php } ?> >3</option>
                                    <?php } ?>

                                </select>
                            </div>

                            <br>
                            <div class="btn_enviar">
                                <button type="submit" class="btn btn-primary">Filtrar</button>
                            </div>

                        
                              
                        </div>
                        


                    </form>
                    
                    
                </div>


            </div>

<!-- TABLAAAAAAAAAAAA   -->

            <!-- TABLA DE ARCHIVOS -->
            <div class="col-md-10">
                <!-- SEGUNO CONTAINER-->
                <div class="container" style="border: 1px solid #d0d0d0;; border-radius: 5px; background-color:#57638F; color:#ffffff; ">

                    <h2 style="margin-top:10px;">Lista de Archivos <i class="fa fa-question-circle" id="help" aria-hidden="true" style="cursor: pointer" onclick="ayuda();"></i></h2>
                    <div class="container" style="margin-bottom: 10px; ">
                        <div class="container" style="border: 0px solid #d0d0d0;; border-radius: 5px; overflow-y: scroll; height: 400px; ">
                            <table class="table table-hover bg-white" id="tablaGestorDataTable" style="border-radius: 5px; ">
                                <thead style="text-align:center; background-color:#98bd9d; color:#ffffff">
                                    <tr>
                                        <th width="30%">Nombre</th>
                                        <th width="10%">Fecha</th>
                                        <th width="5%">Tipo</th>
                                        <th width="10%">Tamaño</th>
                                        <th width="5%">Nivel</th>
                                        <th width="20%">Usuario</th>
                                        <th width="5%">D</th>
                                        <th width="5%">P</th>
                                        <th width="5%">A</th>
                                    </tr>
                                </thead>

                                <?php

                                    //AQUI COMIENZA LA MAGIA DE LAS QUERYS: CONDICIONES DE BUSCADOR Y NIVELES DE ACCESO

                                    //NOTA!: LA QUERY POR DEFAULT SE EJECUTA EN CASO DE NO TENER DATOS DE TYPE NI LEVEL

                                    //No se ha seleccionado ningun filtro: QUERY DEFAULT
                                    if($type_query == "" && $level_query == 0){
                                        switch($nivel){
                                            //USUARIO NIVEL 1: SIN FILTROS
                                            case 1:
                                                $sql = "SELECT  archivos.idArchivos,
                                                                usuarios.nombreUsuario, 
                                                                usuarios.nivelUsuario,
                                                                usuarios.idUsuario,
                                                                archivos.ruta,
                                                                archivos.nombreArchivo, 
                                                                archivos.tipoArchivo, 
                                                                archivos.sizeArchivo, 
                                                                archivos.fechaArchivo
                                                                 
                                                                
                                                        FROM archivos 
                                                        INNER JOIN usuarios ON archivos.fk_usuarios_idUsuario = usuarios.idUsuario 
                                                        WHERE usuarios.idUsuario = $id_usuario AND archivos.estado = 1;";
                                                break;

                                                //USUARIO NIVEL 2: SIN FILTROS 
                                                case 2:
                                                    $sql = "SELECT  archivos.idArchivos,
                                                                    usuarios.nombreUsuario, 
                                                                    usuarios.nivelUsuario,
                                                                    usuarios.idUsuario,
                                                                    archivos.ruta,
                                                                    archivos.nombreArchivo, 
                                                                    archivos.tipoArchivo, 
                                                                    archivos.sizeArchivo, 
                                                                    archivos.fechaArchivo
                                                                     
                                                                    
                                                            FROM archivos 
                                                            INNER JOIN usuarios ON archivos.fk_usuarios_idUsuario = usuarios.idUsuario 
                                                            WHERE (usuarios.nivelUsuario = 1 OR usuarios.idUsuario = $id_usuario) AND archivos.estado = 1;";
                                                    break;

                                                //USUARIO NIVEL 3: SIN FILTROS 
                                                case 3:
                                                    $sql = "SELECT  archivos.idArchivos,
                                                                    usuarios.nombreUsuario, 
                                                                    usuarios.nivelUsuario,
                                                                    usuarios.idUsuario,
                                                                    archivos.ruta,
                                                                    archivos.nombreArchivo, 
                                                                    archivos.tipoArchivo, 
                                                                    archivos.sizeArchivo, 
                                                                    archivos.fechaArchivo
                                                                     
                                                                    
                                                            FROM archivos 
                                                            INNER JOIN usuarios ON archivos.fk_usuarios_idUsuario = usuarios.idUsuario 
                                                            WHERE archivos.estado = 1 AND (usuarios.nivelUsuario <= 2 OR usuarios.idUsuario = $id_usuario) ;";
                                                    break;

                                                //USUARIO NIVEL 4: SIN FILTROS
                                                case 4:
                                                        "SELECT  archivos.idArchivos,
                                                                usuarios.nombreUsuario, 
                                                                usuarios.nivelUsuario,
                                                                usuarios.idUsuario,
                                                                archivos.ruta,
                                                                archivos.nombreArchivo, 
                                                                archivos.tipoArchivo, 
                                                                archivos.sizeArchivo, 
                                                                archivos.fechaArchivo
                                                                FROM archivos 
                                                                INNER JOIN usuarios ON archivos.fk_usuarios_idUsuario = usuarios.idUsuario 
                                                                WHERE usuarios.nivelUsuario <= 3 AND archivos.estado = 1;";
                                                    break;
                                        }
                                    }

                                    //sSe ha seleccionado un nivel, pero no un tipo:
                                    if($type_query == "" && $level_query != 0){
                                        switch($nivel){
                                            //USUARIO NIVEL 1: Siempre verá todos los archivos que son solo suyos
                                            case 1:
                                                $sql = "SELECT  archivos.idArchivos,
                                                                usuarios.nombreUsuario, 
                                                                usuarios.nivelUsuario,
                                                                usuarios.idUsuario,
                                                                archivos.ruta,
                                                                archivos.nombreArchivo, 
                                                                archivos.tipoArchivo, 
                                                                archivos.sizeArchivo, 
                                                                archivos.fechaArchivo
                                                                 
                                                                
                                                        FROM archivos 
                                                        INNER JOIN usuarios ON archivos.fk_usuarios_idUsuario = usuarios.idUsuario 
                                                        WHERE usuarios.idUsuario = $id_usuario AND archivos.estado = 1;";
                                                break;

                                                //USUARIO NIVEL 2: Selecciona nivel 1 
                                                case 2:
                                                    $sql = "SELECT  archivos.idArchivos,
                                                                    usuarios.nombreUsuario, 
                                                                    usuarios.nivelUsuario,
                                                                    usuarios.idUsuario,
                                                                    archivos.ruta,
                                                                    archivos.nombreArchivo, 
                                                                    archivos.tipoArchivo, 
                                                                    archivos.sizeArchivo, 
                                                                    archivos.fechaArchivo
                                                                     
                                                                    
                                                            FROM archivos 
                                                            INNER JOIN usuarios ON archivos.fk_usuarios_idUsuario = usuarios.idUsuario 
                                                            WHERE (usuarios.nivelUsuario = $level_query) AND archivos.estado = 1;";
                                                    break;

                                                //USUARIO NIVEL 3: Selecciona nivel 1 o 2
                                                case 3:
                                                    $sql = "SELECT  archivos.idArchivos,
                                                                    usuarios.nombreUsuario, 
                                                                    usuarios.nivelUsuario,
                                                                    usuarios.idUsuario,
                                                                    archivos.ruta,
                                                                    archivos.nombreArchivo, 
                                                                    archivos.tipoArchivo, 
                                                                    archivos.sizeArchivo, 
                                                                    archivos.fechaArchivo
                                                                     
                                                                    
                                                            FROM archivos 
                                                            INNER JOIN usuarios ON archivos.fk_usuarios_idUsuario = usuarios.idUsuario 
                                                            WHERE (usuarios.nivelUsuario = $level_query) AND archivos.estado = 1;";
                                                    break;

                                                //USUARIO NIVEL 4: Selecciona nivel 1,2 o 3
                                                case 4:
                                                    $sql=  "SELECT  archivos.idArchivos,
                                                                usuarios.nombreUsuario, 
                                                                usuarios.nivelUsuario,
                                                                usuarios.idUsuario,
                                                                archivos.ruta,
                                                                archivos.nombreArchivo, 
                                                                archivos.tipoArchivo, 
                                                                archivos.sizeArchivo, 
                                                                archivos.fechaArchivo
                                                                FROM archivos 
                                                                INNER JOIN usuarios ON archivos.fk_usuarios_idUsuario = usuarios.idUsuario 
                                                                WHERE (usuarios.nivelUsuario = $level_query) AND archivos.estado = 1;";
                                                    break;
                                        }
                                    }


                                    //Se ha seleccionado un tipo, pero no un nivel:
                                    if($type_query != "" && $level_query == 0){
                                        //echo("SI TIENE ALGO EL PINCHE QUERY DE TYPE");
                                        switch($nivel){
                                            //USUARIO NIVEL 1: Todos los archivos de un solo tipo para el usuario
                                            case 1:
                                                $sql = "SELECT  archivos.idArchivos,
                                                                usuarios.nombreUsuario, 
                                                                usuarios.nivelUsuario,
                                                                usuarios.idUsuario,
                                                                archivos.ruta,
                                                                archivos.nombreArchivo, 
                                                                archivos.tipoArchivo, 
                                                                archivos.sizeArchivo, 
                                                                archivos.fechaArchivo
                                                                 
                                                                
                                                        FROM archivos 
                                                        INNER JOIN usuarios ON archivos.fk_usuarios_idUsuario = usuarios.idUsuario 
                                                        WHERE usuarios.idUsuario = $id_usuario AND archivos.estado = 1 AND archivos.tipoArchivo = '$type_query';";
                                                break;

                                                //USUARIO NIVEL 2: Selecciona algun tipo, y puede visualizar cualquier nivel 1 y su propio nivel
                                                case 2:
                                                    $sql = "SELECT  archivos.idArchivos,
                                                                    usuarios.nombreUsuario, 
                                                                    usuarios.nivelUsuario,
                                                                    usuarios.idUsuario,
                                                                    archivos.ruta,
                                                                    archivos.nombreArchivo, 
                                                                    archivos.tipoArchivo, 
                                                                    archivos.sizeArchivo, 
                                                                    archivos.fechaArchivo
                                                                     
                                                                    
                                                            FROM archivos 
                                                            INNER JOIN usuarios ON archivos.fk_usuarios_idUsuario = usuarios.idUsuario 
                                                            WHERE (usuarios.nivelUsuario < 2 || usuarios.idUsuario = $id_usuario ) AND archivos.estado = 1 AND archivos.tipoArchivo ='$type_query';";
                                                    break;

                                                //USUARIO NIVEL 3: Selecciona algun tipo y puede visualizar cualquier nivel 1,2 y su propio nivel
                                                case 3:
                                                    $sql = "SELECT  archivos.idArchivos,
                                                                    usuarios.nombreUsuario, 
                                                                    usuarios.nivelUsuario,
                                                                    usuarios.idUsuario,
                                                                    archivos.ruta,
                                                                    archivos.nombreArchivo, 
                                                                    archivos.tipoArchivo, 
                                                                    archivos.sizeArchivo, 
                                                                    archivos.fechaArchivo
                                                                     
                                                                    
                                                            FROM archivos 
                                                            INNER JOIN usuarios ON archivos.fk_usuarios_idUsuario = usuarios.idUsuario 
                                                            WHERE (usuarios.nivelUsuario < 3 || usuarios.idUsuario = $id_usuario ) AND archivos.estado = 1 AND archivos.tipoArchivo = '$type_query';";
                                                    break;

                                                //USUARIO NIVEL 3: Selecciona algun tipo y puede visualizar cualquier nivel 1,2 y 3. 
                                                case 4:
                                                    $sql=  "SELECT  archivos.idArchivos,
                                                                usuarios.nombreUsuario, 
                                                                usuarios.nivelUsuario,
                                                                usuarios.idUsuario,
                                                                archivos.ruta,
                                                                archivos.nombreArchivo, 
                                                                archivos.tipoArchivo, 
                                                                archivos.sizeArchivo, 
                                                                archivos.fechaArchivo
                                                                FROM archivos 
                                                                INNER JOIN usuarios ON archivos.fk_usuarios_idUsuario = usuarios.idUsuario 
                                                                WHERE (usuarios.nivelUsuario <= 3 ) AND archivos.estado = 1 AND archivos.tipoArchivo = '$type_query';";
                                                    break;
                                        }
                                    }


                                    //Se ha seleccionado un tipo y un tipo nivel:
                                    if($type_query != "" && $level_query != 0){
                                        //echo("SI TIENE ALGO EL PINCHE QUERY DE TYPE");
                                        switch($nivel){
                                            //USUARIO NIVEL 1: Todos los archivos de un solo tipo para el usuario
                                            case 1:
                                                $sql = "SELECT  archivos.idArchivos,
                                                                usuarios.nombreUsuario, 
                                                                usuarios.nivelUsuario,
                                                                usuarios.idUsuario,
                                                                archivos.ruta,
                                                                archivos.nombreArchivo, 
                                                                archivos.tipoArchivo, 
                                                                archivos.sizeArchivo, 
                                                                archivos.fechaArchivo
                                                                 
                                                                
                                                        FROM archivos 
                                                        INNER JOIN usuarios ON archivos.fk_usuarios_idUsuario = usuarios.idUsuario 
                                                        WHERE usuarios.idUsuario = $id_usuario AND archivos.estado = 1 AND archivos.tipoArchivo = '$type_query';";
                                                break;

                                                //USUARIO NIVEL 2: Selecciona algun tipo, y puede visualizar nivel 1 y su propio nivel
                                                case 2:
                                                    $sql = "SELECT  archivos.idArchivos,
                                                                    usuarios.nombreUsuario, 
                                                                    usuarios.nivelUsuario,
                                                                    usuarios.idUsuario,
                                                                    archivos.ruta,
                                                                    archivos.nombreArchivo, 
                                                                    archivos.tipoArchivo, 
                                                                    archivos.sizeArchivo, 
                                                                    archivos.fechaArchivo
                                                                     
                                                                    
                                                            FROM archivos 
                                                            INNER JOIN usuarios ON archivos.fk_usuarios_idUsuario = usuarios.idUsuario 
                                                            WHERE ((usuarios.nivelUsuario = $level_query ) AND (usuarios.nivelUsuario < 2)) AND archivos.estado = 1 AND archivos.tipoArchivo ='$type_query';";
                                                    break;

                                                //USUARIO NIVEL 3: Selecciona algun tipo y puede visualizar cualquier nivel 1,2 y su propio nivel
                                                case 3:
                                                    $sql = "SELECT  archivos.idArchivos,
                                                                    usuarios.nombreUsuario, 
                                                                    usuarios.nivelUsuario,
                                                                    usuarios.idUsuario,
                                                                    archivos.ruta,
                                                                    archivos.nombreArchivo, 
                                                                    archivos.tipoArchivo, 
                                                                    archivos.sizeArchivo, 
                                                                    archivos.fechaArchivo
                                                                     
                                                                    
                                                            FROM archivos 
                                                            INNER JOIN usuarios ON archivos.fk_usuarios_idUsuario = usuarios.idUsuario 
                                                            WHERE ((usuarios.nivelUsuario = $level_query ) AND (usuarios.nivelUsuario < 3)) AND archivos.estado = 1 AND archivos.tipoArchivo ='$type_query';";
                                                    break;

                                                //USUARIO NIVEL 3: Selecciona algun tipo y puede visualizar cualquier nivel 1,2 y 3. 
                                                case 4:
                                                    $sql=  "SELECT  archivos.idArchivos,
                                                                usuarios.nombreUsuario, 
                                                                usuarios.nivelUsuario,
                                                                usuarios.idUsuario,
                                                                archivos.ruta,
                                                                archivos.nombreArchivo, 
                                                                archivos.tipoArchivo, 
                                                                archivos.sizeArchivo, 
                                                                archivos.fechaArchivo
                                                                FROM archivos 
                                                                INNER JOIN usuarios ON archivos.fk_usuarios_idUsuario = usuarios.idUsuario 
                                                                WHERE ((usuarios.nivelUsuario = $level_query )) AND archivos.estado = 1 AND archivos.tipoArchivo ='$type_query';";
                                                    break;
                                        }
                                    }

                                    

                                    //AQUI TERMINÓ TU DESMADRE
                                    /* switch($nivel){
                                        case 1:
                                            $sql = "SELECT  archivos.idArchivos,
                                                            usuarios.nombreUsuario, 
                                                            usuarios.nivelUsuario,
                                                            usuarios.idUsuario,
                                                            archivos.ruta,
                                                            archivos.nombreArchivo, 
                                                            archivos.tipoArchivo, 
                                                            archivos.sizeArchivo, 
                                                            archivos.fechaArchivo
                                                             
                                                            
                                                    FROM archivos 
                                                    INNER JOIN usuarios ON archivos.fk_usuarios_idUsuario = usuarios.idUsuario 
                                                    WHERE usuarios.idUsuario = $id_usuario AND archivos.estado = 1;";
                                            break;
                                        case 2:
                                            $sql = "SELECT  archivos.idArchivos,
                                                            usuarios.nombreUsuario, 
                                                            usuarios.nivelUsuario,
                                                            usuarios.idUsuario,
                                                            archivos.ruta,
                                                            archivos.nombreArchivo, 
                                                            archivos.tipoArchivo, 
                                                            archivos.sizeArchivo, 
                                                            archivos.fechaArchivo 
                                                    FROM archivos 
                                                    INNER JOIN usuarios ON archivos.fk_usuarios_idUsuario = usuarios.idUsuario 
                                                    WHERE (usuarios.nivelUsuario = 1 OR usuarios.idUsuario = $id_usuario) AND archivos.estado = 1;";
                                            break;
                                        case 3:
                                            $sql= "SELECT  archivos.idArchivos,
                                                            usuarios.nombreUsuario, 
                                                            usuarios.nivelUsuario,
                                                            usuarios.idUsuario,
                                                            archivos.ruta,
                                                            archivos.nombreArchivo, 
                                                            archivos.tipoArchivo, 
                                                            archivos.sizeArchivo, 
                                                            archivos.fechaArchivo 
                                                    FROM archivos 
                                                    INNER JOIN usuarios ON archivos.fk_usuarios_idUsuario = usuarios.idUsuario 
                                                    WHERE archivos.estado = 1 AND (usuarios.nivelUsuario <= 2 OR usuarios.idUsuario = $id_usuario) ;";
                                            break;

                                        case 4:
                                            $sql= "SELECT  archivos.idArchivos,
                                                    usuarios.nombreUsuario, 
                                                    usuarios.nivelUsuario,
                                                    usuarios.idUsuario,
                                                    archivos.ruta,
                                                    archivos.nombreArchivo, 
                                                    archivos.tipoArchivo, 
                                                    archivos.sizeArchivo, 
                                                    archivos.fechaArchivo
                                                    FROM archivos 
                                                    INNER JOIN usuarios ON archivos.fk_usuarios_idUsuario = usuarios.idUsuario 
                                                    WHERE usuarios.nivelUsuario <= 3 AND archivos.estado = 1;";
                                            break;
                                    } */

                                    //var_dump($sql);
                                    $result = mysqli_query($link, $sql);
                                    //var_dump($sql);
                                    //var_dump($result);

                                    while($mostrar = mysqli_fetch_array($result)){
                                        $idArchivo = $mostrar["idArchivos"];
                                        $nombreUsuario_query = $mostrar["nombreUsuario"];
                                        $nivelUsuario_query = $mostrar["nivelUsuario"];
                                        $idUsuario_query = $mostrar["idUsuario"];
                                        $rutaArchivo_query = $mostrar["ruta"];
                                        $nombreArchivo = $mostrar["nombreArchivo"];
                                        $fechaArchivo = $mostrar["fechaArchivo"]; 
                                        $tipoArchivo = $mostrar["tipoArchivo"];
                                        $sizeArchivo = round($mostrar["sizeArchivo"]/1000000,3).' MB';
                                ?>


                                <tr style="text-align:center;">
                                        <td><b><?php echo $nombreArchivo; ?></b></td>
                                        <td><?php echo $fechaArchivo; ?></td>
                                        <td><?php echo $tipoArchivo; ?></td>
                                        <td><?php echo $sizeArchivo; ?></td>
                                        <td><?php echo $nivelUsuario_query; ?></td>
                                        <td><?php echo $nombreUsuario_query; ?></td>
                                        <td><a href="../php/descarga.php?idArchivo=<?php echo $idArchivo?>&idUsuario=<?php echo $idUsuario_query?>&rutaFile=<?php  echo $rutaArchivo_query ?>&nameFile=<?php echo $nombreArchivo?>"><button class="btn_descarga"  type="button"><img src="../resources/img/icons/download.png" width="30px" height="32px" alt=""></button></a></td>
                                        <td><a href="../php/prev_archivo_controller.php?idArchivo=<?php echo $idArchivo?>&idUsuario=<?php echo $idUsuario_query?>&rutaFile=<?php  echo $rutaArchivo_query ?>&nameFile=<?php echo $nombreArchivo?>"><button class="btn_prev" type="button"><img src="../resources/img/icons/previsualizar_eye.png" width="30px" height="32px" alt=""></button></a></td>
                                        
                                        <?php if($tipoArchivo == "pdf" || $tipoArchivo == "docx" || $tipoArchivo == "txt" || $tipoArchivo == "doc") {?>
                                            <td><a href="../vistasAcciones/analisis.php?idArchivo=<?php echo $idArchivo?>&idUsuario=<?php echo $idUsuario_query?>&rutaFile=<?php  echo $rutaArchivo_query ?>&nameFile=<?php echo $nombreArchivo?>&type=<?php echo $tipoArchivo;?>"><button class="btn_analizar" type="button"><img src="../resources/img/icons/graficas.png" width="30px" height="32px" alt=""></button></a></td>
                                        <?php }else{?>
                                            <td><a href="#"><button class="btn_analizar" type="button" style="background-color:gray"><img src="../resources/img/icons/graficas.png" width="30px" height="32px" alt=""></button></a></td>
                                        <?php } ?>
                                        
                                </tr>

                                <?php } ?>
                            </table>
                        </div>
                    </div>

                    
                    
                </div>

            </div>

            <!-- FIN TABLA -->

            
        </div>

        


        </div>
    </div>

    <!-- funciones datatable -->
    <script type="text/javascript">
        $(document).ready(function(){
            var table = $('#tablaGestorDataTable').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
            });


            /*//Se crea una fila en el head de la tabla y se cloma para caa columna
            $('#tablaGestorDataTable thead tr').clone(true).appendTo('#tablaGestorDataTable thead');

            //funciones de busqueda por columna
            $('#tablaGestorDataTable thead tr:eq(1) th').each(function(i) {
                var title = $(this).text(); //es el nombre de la columna
                $(this).html('<input type="text" placeholder="Buscar..." />');

                $( 'input', this).on('keyup change',function (){
                    if(table.column(i).search() !== this.value){
                        table
                            .column(i)
                            .search(this.value)
                            .draw();
                    }
                });

            });*/

        });

        

    </script>

    <!-- AYUDA -->
    <script>
        function ayuda(){
            swal("¡Bienvenido al Archivero!", "Este espacio te permitirá ver los archivos que han subido tus compañeros, he aqui algunos tips: \n\n - Podrás buscar archivos rapidamente con la barra de busqueda. \n\n Las acciones disponibles para los archivos son: \n\n * D: Descargar \n * A: Analizar \n * P: Previsualizar \n\n OJO: Hay tipos de archivos que no contaran con todas las opciones disponibles", "info");
        }


    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    

    <!-- DATA TABLES -->
    <script src="../librerias/datatable/jquery.dataTables.min.js"></script>
    <script src="../librerias/datatable/dataTables.bootstrap5.min.js"></script>
    

    <!-- JQUERY -->
    <script src="../scripts/js/filtros_usuario.js"></script>
    <!-- FOOTER -->
    <footer class="container" style="text-align: center; color:#57638F">
        <br>
        <h4>Packfile - 2021</h4>
    </footer>

</body>

</html>