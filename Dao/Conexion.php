<?php

require_once("constantes.php");
require 'C:/xampp/htdocs/proyectosPhpStorm/phpMongoAvanzado/vendor/autoload.php';

use MongoDB\Client;

class Conexion
{
    public function getConexion(string $coleccion)
    {
        try
        {
            $clienteMongo = new Client("mongodb://".HOST.":".PUERTO."/");
            $baseDatos = $clienteMongo->selectDatabase(DB_NAME);

            return $baseDatos?->selectCollection($coleccion);
        }
        catch (Exception $error)
        {
            echo "Ha ocurrido este error $error";
        }


    }

}