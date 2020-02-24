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