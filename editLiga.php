<?php
ob_start();
?>
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
            <div class="sidebar content-box" style="adisplay: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li class="current"><a href="principal.php"><i class="glyphicon glyphicon-home"></i> Datos Liga</a>
                    </li>
                    <li><a href="equipos.php"><i class="glyphicon glyphicon-calendar"></i> Equipos</a></li>
                    <li><a href="resultados.php"><i class="glyphicon glyphicon-stats"></i> Resultados</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-6">
                    <div class="content-box-large">
                        <div class="panel-heading">
                            <div class="panel-title">Editar datos Liga</div>
                        </div>
                        <div class="panel-body">
                            <?php
                            $resultado = $database->select("liga", "*", true);
                            foreach ($resultado as $result) {
                                echo '<form action="editLiga.php" method="post">';
                                input('Nombre', 'nombre', 'text', true, $result['nombre']);
                                selectYear($result['year']);
                                input('Descripción', 'descripcion', 'text', true, $result['descripcion']);
                                echo '<input name="actualizar" class="boton" type="submit" value="Actualizar"/>
                    <input type="hidden" name="codLiga"/>
                    <h3><a href="principal.php">Volver a datos liga</a></h3>
                  </form>';
                            }
                            ?>
                            <?php
                            //Capturamos los nuevos datos introducidos por el usuario
                            if (isset($_POST['actualizar'])) {
                                if (isset($_POST['nombre']) && isset($_POST['fecha']) && isset($_POST['descripcion'])) {
                                    $nombre = $_POST['nombre'];
                                    $anio = $_POST['fecha'];
                                    $descripcion = $_POST['descripcion'];

                                    $actualizacion = $database->update("liga", ["nombre" => $nombre, "year" => $anio, "descripcion" => $descripcion]);
                                    $result = $actualizacion->fetch();
                                    // Comprobando errores
                                    if ($result) {
                                        var_dump($database->error());
                                    } else {
                                        header('Location: principal.php');
                                        ob_end_flush();
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