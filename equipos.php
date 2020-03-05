<!DOCTYPE html>
<html lang="es">
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
    <link href="vendors/fullcalendar/fullcalendar.css" rel="stylesheet" media="screen">
    <!-- styles -->
    <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>"/>

    <link href="css/calendar.css" rel="stylesheet">

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

                        <?php
                        $resultado = $database->select("equipos", "*", true);
                        $count = $database->count("equipos", "*", true);
                        if (($count) == 0) {
                            echo '<div class="panel-heading">
								<div class="panel-title">Datos Equipos</div>
							</div>
							  <div class="panel-body">
							  <form action="equipos.php" method="post">
								<p>Nombre: <input type="text" required name="name" /></p>
								<p>Ciudad: <input type="text" required name="ciudad" /></p>
                                <p>Num Social: <input type="text" required name="numsocial" /></p>
                                <p>Fecha: <input type="text" required name="fecha" /></p>
								<p><input type="submit" name="add" value="Guardar" /></p>
                               </form>';
                               if (isset($_POST['add'])) {
                                $name = $_POST['name'];
                                $ciudad = $_POST['ciudad'];
                                $fecha = $_POST['fecha'];
                                $numsocial =$_POST['numsocial'];


                                $actualizacion = $database->insert("equipos", array("cod_equipo"=>1,"cod_liga"=>1,"nombre" => $name, "ciudad" => $ciudad,"num_social" => $numsocial, "fecha" => $fecha));
                                $result = $actualizacion->fetch();
                               }
                        } else {
                            echo '
								<div class="panel-heading">
							<div class="panel-title">Datos Equipos</div>
							
							<div class="panel-options">
								<a href="addEquipo.php" data-rel="collapse"><i class="glyphicon glyphicon-plus"></i></a>
							</div>
						</div>
		  				<div class="panel-body">
								<table>
								<tr> 
								<th>Equipo</th>
								<th>Nombre</th>
								<th>Ciudad</th>
								<th>num_social</th>
								<th>Fecha</th>
								<th>Editar / Borrar</th>
								</tr>
								<tr> ';
                            if (isset($_GET['deleteId'])) {
                                $deleteId = $_GET['deleteId'];
                                $actualizacion = $database->delete("equipos", array("cod_equipo" => $deleteId));
                                $result = $actualizacion->fetch();
                                $comprobar = $database->count("equipos","*", array("cod_equipo" => $deleteId));
                                // Comprobando errores
                                if ($comprobar!=0) {
                                    echo "<script>
                                    alert('El equipo seleccionado tiene resultados activos. No se puede borrar .');
                                    window.location= 'equipos.php'
                                    </script>";
                                } else {
                                    echo "<script>
                                    alert('El equipo seleccionado ha sido eliminado correctamente .');
                                    window.location= 'equipos.php'
                                    </script>";
                                }

                            }
                            foreach ($resultado as $result) {

                                echo '<tr>
									<td>';
                                echo $result['cod_equipo'];
                                echo '</td><td>';
                                echo $result['nombre'];
                                echo '</td><td>';
                                echo $result['ciudad'];
                                echo '</td><td>';
                                echo $result['num_social'];
                                echo '</td><td>';
                                echo $result['fecha'];
                                echo '</td><td>';
                                echo "<a href=editEquipo.php?codEquipo=" . $result["cod_equipo"] . "><i class='glyphicon glyphicon-edit'></i></a>";
                                echo "  /  ";
                                echo "<a href=equipos.php?deleteId=" . $result["cod_equipo"] . "><i class='glyphicon glyphicon-remove'></i></a>";

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
</html>