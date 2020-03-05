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
    <!-- jQuery UI -->
    <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>"/>

    <link href="css/stats.css" rel="stylesheet">

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
                    <li><a href="equipos.php"><i class="glyphicon glyphicon-calendar"></i> Equipos</a></li>
                    <li class="current"><a href="resultados.php"><i class="glyphicon glyphicon-stats"></i>
                            Resultados</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-6">
                    <div class="content-box-large">

                        <?php
                        $resultado = $database->select("resultados", "*", true);
                        $count = $database->count("resultados", "*", true);
                        if (($count) == 0) {
                            $numLiga = $database->count("liga", "*", true);
                            $numEquipos = $database->count("equipos", "*", true);
                            if ($numLiga == 0) {
                                echo "<h3>Debe crear una liga si quiere añadir los resultados de un partido</h3>";
                            } else if ($numEquipos < 2) {
                                echo "<h3>Debe tener dos equipos como mínimo para poder añadir resultados</h3>";
                            } else {
                                echo '
							  <div class="panel-body">
							  <h3>No hay resultados</h3>
							  <form action="resultados.php" method="post">
								';
                                $equipos = $database->select("equipos", "*", true);
                                selectEquipo('Equipo 1', 'equipo1', $equipos);
                                selectEquipo('Equipo 2', 'equipo2', $equipos);
                                input('Resultado del equipo 1', 'result1', 'number', true);
                                input('Resultado del equipo 2', 'result2', 'number', true);
                                selectYear();
                                echo '
								<p><input type="submit" name="add" value="Añadir" /></p>
							   </form>';
                                if (isset($_POST['add'])) {
                                    if (isset($_POST['equipo1']) && isset($_POST['equipo2']) && isset($_POST['result1']) && isset($_POST['result2']) && isset($_POST['fecha'])) {
                                        $equipo1 = $_POST['equipo1'];
                                        $equipo2 = $_POST['equipo2'];
                                        $result1 = $_POST['result1'];
                                        $result2 = $_POST['result2'];
                                        $fecha = $_POST['fecha'];
                                        if ($equipo1 === $equipo2) {
                                            echo "<script>
                                    alert('Los equipos deben ser diferentes.');
                                    window.location= 'addResultados.php'
                                    </script>";
                                        } else {
                                            $insertar = $database->insert("resultados", [
                                                "cod_equipo1" => $equipo1,
                                                "cod_equipo2" => $equipo2,
                                                "result_equipo1" => $result1,
                                                "result_equipo2" => $result2,
                                                "fecha" => $fecha
                                            ]);
                                            // Comprobando errores
                                            if ($insertar == 0) {
                                                var_dump($database->error());
                                            } else {
                                                header('Location: resultados.php');
                                                ob_end_clean();
                                            }
                                        }
                                    }
                                }
                            }
                        } else {
                            echo '
								<div class="panel-heading">
							<div class="panel-title">Resultados</div>
							<div class="panel-options">
								<a href="addResultados.php" data-rel="collapse"><i class="glyphicon glyphicon-plus"></i></a>
							</div>
		
						</div>
		  				<div class="panel-body">
								<table>
								<tr> 
								<th>Equipo 1</th>
								<th>Equipo 2</th>
								<th>Resultado 1</th>
								<th>Resultado 2</th>
								<th>Fecha</th>
								<th>Editar / Borrar</th>								
								</tr>
								<tr> ';
                            if (isset($_GET['deleteId'])) {
                                $deleteId = $_GET['deleteId'];
                                $actualizacion = $database->delete("resultados", array("id_result" => $deleteId));
                                $result = $actualizacion->fetch();
                                // Comprobando errores
                                $comprobar = $database->count("resultados", "*", array("id_result" => $deleteId));
                                // Comprobando errores
                                if ($comprobar != 0) {
                                    echo "<script>
                                    alert('El resultado seleccionado no se ha podido eliminar .');
                                    window.location= 'resultados.php'
                                    </script>";
                                } else {
                                    echo "<script>
                                    alert('El resultado seleccionado ha sido eliminado correctamente .');
                                    window.location= 'resultados.php'
                                    </script>";
                                }

                            }
                            foreach ($resultado as $result) {
                                $equipo1 = $result["cod_equipo1"];
                                $equipo2 = $result["cod_equipo2"];

                                $nombreEquipo1 = $database->select("equipos", "nombre", ["cod_equipo" => $equipo1]);
                                $nombreEquipo2 = $database->select("equipos", "nombre", ["cod_equipo" => $equipo2]);
                                echo '<tr>
									<td>';
                                echo $nombreEquipo1[0];
                                echo '</td><td>';
                                echo $nombreEquipo2[0];
                                echo '</td><td>';
                                echo $result['result_equipo1'];
                                echo '</td><td>';
                                echo $result['result_equipo2'];
                                echo '</td><td>';
                                echo $result['fecha'];
                                echo '</td><td>';
                                echo "<a href=editResultados.php?idResult=" . $result["id_result"] . "><i class='glyphicon glyphicon-edit'></i></a>";
                                echo "  /  ";
                                echo "<a href=resultados.php?deleteId=" . $result["id_result"] . "><i class='glyphicon glyphicon-remove'></i></a>";

                                echo '</td>';
                                echo '</tr>';
                            }
                            echo '</table>';

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
<script>
    function confirm_delete(id) {
        if (confirm("Are you sure you want to delete this..?") === true) {
            call;
            delete (id);

            return true;
        } else {
            return false;
        }
    }
</script>
</html>