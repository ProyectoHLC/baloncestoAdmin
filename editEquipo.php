<!DOCTYPE html>
<html lang="ES">
<head>
    <?php
    include 'functions.php';
    ?>
    <title>Liga Baloncesto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <!-- Logo -->
                <div class="logo">
                    <h1><a href="principal.php">Liga Baloncesto</a></h1>
                </div>
            </div>
            <div class="col-md-5">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="input-group form">
                        </div>
                    </div>
                </div>
            </div>
            <?php
            headerProfileMenu();
            ?>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="row">
        <div class="col-md-2">
            <div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li><a href="principal.php"><i class="glyphicon glyphicon-home"></i> Datos Liga</a></li>
                    <li class="current"><a href="equipos.php"><i class="glyphicon glyphicon-calendar"></i> Equipos</a>
                    </li>
                    <li><a href="resultados.php"><i class="glyphicon glyphicon-stats"></i> Resultados</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-6">
                    <div class="content-box-large">
                        <div class="panel-heading">
                            <div class="panel-title">Editar Equipo</div>
                        </div>
                        <div class="panel-body">
                            <?php
                            if (isset($_GET['codEquipo'])) {
                                $codEquipo = $_GET['codEquipo'];
                            }
                            $resultado = $database->select("equipos", "*", ["cod_equipo" => $codEquipo]);

                            foreach ($resultado as $result) {
                                echo '<form action="editEquipo.php" method="post">
                    <label>
                        <input name="cod_equipo" value="' . $result['cod_equipo'] . '" readonly type="text" />
                    </label><br>
                    <label>
                        <input name="nombre" value="' . $result['nombre'] . '" type="text" />
                    </label><br>
                    <label>
                        <input name="ciudad" value="' . $result['ciudad'] . '" type="text"/>
                    </label><br>
                    <label>
                        <input name="num_social" value="' . $result['num_social'] . '" type="text"/>
                    </label><br>
                    <label>
                        <input name="fecha" value="' . $result['fecha'] . '" type="text"/>
                    </label><br>
                    <input name="actualizar" class="boton" type="submit" value="Actualizar"/>
                    <h3><a href="equipos.php">Volver a datos de equipos</a></h3>
                  </form>';
                            }
                            ?>
                            <?php
                            //Capturamos los nuevos datos introducidos por el usuario
                            if (isset($_POST['actualizar'])) {

                                if (isset($_POST['cod_equipo']) && isset($_POST['nombre']) && isset($_POST['ciudad']) && isset($_POST['num_social']) && isset($_POST['fecha'])) {
                                    $idEquipo = $_POST['cod_equipo'];
                                    $nombre = $_POST['nombre'];
                                    $ciudad = $_POST['ciudad'];
                                    $numSocial = $_POST['num_social'];
                                    $fecha = $_POST['fecha'];

                                    $actualizacion = $database->update("equipos", array("cod_equipo" => $idEquipo, "cod_liga" => 1, "nombre" => $nombre, "ciudad" => $ciudad, "num_social" => $numSocial, "fecha" => $fecha));
                                    $result = $actualizacion->fetch();
                                    // Comprobando errores
                                    if ($result) {
                                        var_dump($database->error());
                                    } else {
                                        header('Location: equipos.php');
                                    }
                                }
                            }

                            ?>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php
    footer();
    ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>