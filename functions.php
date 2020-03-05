<?php
//Establecemos la conexión con la base de datos.
//Crea una instancia de la clase Medoo. (Se crea un objeto)

require 'Medoo.php';

use Medoo\Medoo;

$database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'baloncesto',
    'server' => 'localhost',
    'username' => 'root',
    'password' => ''
]);

session_start();

if ($_SESSION['username'] == null) {
    header("Location: index.html", true);
}

// Genera un menú dropdown con el nombre de usuario y la opción de cerrar sesión.

function headerProfileMenu()
{
    $username = $_SESSION['username'];
    echo "<div class=\"col-md-2\">
	              <div class=\"navbar navbar-inverse\" role=\"banner\">
	                  <nav class=\"collapse navbar-collapse bs-navbar-collapse navbar-right\" role=\"navigation\">
	                    <ul class=\"nav navbar-nav\">
	                      <li class=\"dropdown\">
	                        <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">$username <b class=\"caret\"></b></a>
	                        <ul class=\"dropdown-menu animated fadeInUp\">
	                          <!-- No es necesario por ahora <li><a href=\"profile.html\">Profile</a></li>-->
	                          <li><a href=\"logout.php\">Cerrar sesión</a></li>
	                        </ul>
	                      </li>
	                    </ul>
	                  </nav>
	              </div>
	           </div>";
}

// Genera un selector de los equipos existentes en la base de datos

function selectEquipo($label, $id, $equipos){
   echo "<label>$label <select id='$id' name='$id'>";
    foreach ($equipos as $equipo){
        echo "<option value='$equipo[cod_equipo]'>$equipo[nombre]</option>";
    }
   echo "</select></label>";
}

// Genera un selector de años

function selectYear($currentValue = null){
    $id = 'fecha';
    $minYear = 1900;
    echo "<label>Fecha <select id='$id' name='$id'>";
    foreach (range(date('Y'), $minYear) as $year){
        echo "<option value='$year'";
        if ($currentValue == $year){
            echo " selected";
        }
        echo ">$year</option>";
    }
    echo "</select></label>";
}

// Genera el footer

function footer()
{
    echo "<footer>
        <div class=\"container\">

            <div class=\"copy text-center\">
                Copyright 2020
            </div>

        </div>
    </footer>";
}