<?php

namespace Dao;

require_once("C:/xampp/htdocs/proyectosPhpStorm/phpMongoAvanzado/Dao/IProductosDao.php");
require_once("C:/xampp/htdocs/proyectosPhpStorm/phpMongoAvanzado/Dao/Conexion.php");
require_once("C:/xampp/htdocs/proyectosPhpStorm/phpMongoAvanzado/modelos/Producto.php");

use Conexion;
use Exception;
use modelos\Producto;
use MongoDB\BSON\ObjectId;

class ProductoDao extends Conexion implements IProductosDao
{

    public function __construct()
    {
    }

    public function verProducto(string $id): ?Producto
    {
        try
        {
            $coleccion = $this->getConexion(C_PRODUCTO);
            $resultado = $coleccion->findOne([CP_ID => new ObjectID($id)]);

            $producto = new Producto();
            $producto->setId($resultado[CP_ID]);
            $producto->setNombre($resultado[CP_NOMBRE]);
            $producto->setImagen($resultado[CP_IMAGEN]);
            $producto->setCodigo($resultado[CP_CODIGO]);
            $producto->setPrecio($resultado[CP_PRECIO]);

            return $producto;
        }
        catch (Exception $error)
        {

            echo "Ha ocurrido un error: $error";

        }
        return null;
    }

    public function verProductos(): ?array
    {
        try
        {
            $coleccion = $this->getConexion(C_PRODUCTO);
            $resultados = $coleccion->find([]);
            $productos = array();

            foreach ($resultados as $resultado)
            {
                $producto = new Producto();
                $producto->setId($resultado[CP_ID]);
                $producto->setNombre($resultado[CP_NOMBRE]);
                $producto->setImagen($resultado[CP_IMAGEN]);
                $producto->setCodigo($resultado[CP_CODIGO]);
                $producto->setPrecio($resultado[CP_PRECIO]);

                $productos[] = $producto;
            }

            return $productos;
        }
        catch (Exception $error)
        {

            echo "Ha ocurrido un error: $error";

        }
        return null;
    }

    public function addProducto(Producto $producto): ?bool
    {
        $data = [
            CP_NOMBRE => $producto->getNombre() ?? null,
            CP_PRECIO => $producto->getPrecio() ?? null,
            CP_CODIGO => $producto->getCodigo() ?? null,
            CP_IMAGEN => $producto->getImagen() ?? null
        ];

        try {

            $coleccion = $this->getConexion(C_PRODUCTO);
            $resultado =$coleccion->insertOne($data);
            return (bool)$resultado;

        }
        catch (Exception $error){

            echo "Ha ocurrido un error: $error";

        }

        return false;;
    }


}