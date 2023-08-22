<?php

namespace Dao;

require_once("C:/xampp/htdocs/proyectosPhpStorm/phpMongoAvanzado/Dao/IFacturaDao.php");
require_once("C:/xampp/htdocs/proyectosPhpStorm/phpMongoAvanzado/Dao/Conexion.php");
require_once("C:/xampp/htdocs/proyectosPhpStorm/phpMongoAvanzado/modelos/Producto.php");

use Conexion;
use Dao\IFacturaDao;
use Dao\IProductosDao;
use Dao\ProductoDao;
use modelos\Producto;
use Exception;
use modelos\Factura;
use MongoDB\BSON\ObjectId;

class FacturaDao extends Conexion implements IFacturaDao
{

    public function __construct()
    {
        date_default_timezone_set('America/Bogota');
    }

    public function verFactura(string $id): ?Factura
    {
        try
        {
            $coleccion = $this->getConexion(C_FACTURA);
            $resultados = $coleccion->find([CF_ID => new ObjectId($id)]);

            foreach ($resultados as $resultado)
            {
                $factura = new Factura();

                $factura->setId($id);
                $factura->setDocuemntoPerosna($resultado[CF_DOCUMENTO]);
                $factura->setTotal($resultado[CF_TOTAL]);
                $factura->setFecha($resultado[CF_FECHA]);
                $productos = array();

                foreach ($resultado[CF_PRODUCTOS] as $productoResult){
                    $producto = new Producto();
                    $producto->setId($productoResult[CP_ID]);
                    $producto->setNombre($productoResult[CP_NOMBRE]);
                    $producto->setImagen($productoResult[CP_IMAGEN]);
                    $producto->setCodigo($productoResult[CP_CODIGO]);
                    $producto->setPrecio($productoResult[CP_PRECIO]);

                    $productos[] = $producto;
                }

                $factura->setProductos($productos);

                return $factura;
            }

        }
        catch (Exception $error)
        {

            echo "Ha ocurrido un error: $error";

        }
        return null;
    }

    public function verFacturas(): ?array
    {
        try
        {
            $coleccion = $this->getConexion(C_FACTURA);
            $resultados = $coleccion->find([], ["limit" => 20, "sort" => [CF_FECHA => -1]]);
            $facturas = array();

            foreach ($resultados as $resultado)
            {
                $factura = new Factura();
                $factura->setId($resultado[CF_ID]);
                $factura->setDocuemntoPerosna($resultado[CF_DOCUMENTO]);
                $factura->setTotal($resultado[CF_TOTAL]);
                $factura->setFecha($resultado[CF_FECHA]);
                $productos = array();

                foreach ($resultado[CF_PRODUCTOS] as $productoResult){
                    $producto = new Producto();
                    $producto->setId($productoResult[CP_ID]);
                    $producto->setNombre($productoResult[CP_NOMBRE]);
                    $producto->setImagen($productoResult[CP_IMAGEN]);
                    $producto->setCodigo($productoResult[CP_CODIGO]);
                    $producto->setPrecio($productoResult[CP_PRECIO]);

                    $productos[] = $producto;
                }

                $factura->setProductos($productos);

                $facturas[] = $factura;
            }

            return $facturas;
        }
        catch (Exception $error)
        {

            echo "Ha ocurrido un error: $error";

        }
        return null;
    }

    public function verMisFacturas(string $documento): ?array
    {
        try
        {
            $coleccion = $this->getConexion(C_FACTURA);
            $resultados = $coleccion->find([CF_DOCUMENTO => $documento], ["limit" => 20, "sort" => [CF_FECHA => -1]]);
            $facturas = array();

            foreach ($resultados as $resultado)
            {
                $factura = new Factura();

                $factura->setId($resultado[CF_ID]);
                $factura->setDocuemntoPerosna($resultado[CF_DOCUMENTO]);
                $factura->setTotal($resultado[CF_TOTAL]);
                $factura->setFecha($resultado[CF_FECHA]);
                $productos = array();

                foreach ($resultado[CF_PRODUCTOS] as $productoResult){
                    $producto = new Producto();
                    $producto->setId($productoResult[CP_ID]);
                    $producto->setNombre($productoResult[CP_NOMBRE]);
                    $producto->setImagen($productoResult[CP_IMAGEN]);
                    $producto->setCodigo($productoResult[CP_CODIGO]);
                    $producto->setPrecio($productoResult[CP_PRECIO]);

                    $productos[] = $producto;
                }

                $factura->setProductos($productos);

                $facturas[] = $factura;
            }

            return $facturas;

        }
        catch (Exception $error)
        {

            echo "Ha ocurrido un error: $error";

        }
        return null;
    }

    public function generarFactura(Factura $factura): ?string
    {
        $productos = array();

        foreach ($factura->getProductos() as $producto)
        {
            $datos = [
                CP_ID => $producto->getId() ?? null,
                CP_NOMBRE => $producto->getNombre() ?? null,
                CP_PRECIO => $producto->getPrecio() ?? null,
                CP_CODIGO => $producto->getCodigo() ?? null,
                CP_IMAGEN => $producto->getImagen() ?? null
            ];

            $productos[] = $datos;
        }

        $data = [
            CF_DOCUMENTO => $factura->getDocuemntoPerosna() ?? null,
            CF_TOTAL => $factura->getTotal() ?? null,
            CF_FECHA => date("Y-m-d H:i:s"),
            CF_PRODUCTOS => $productos
        ];

        try {

            $coleccion = $this->getConexion(C_FACTURA);
            $resultado =$coleccion->insertOne($data);

            return $resultado->getInsertedId();

        }
        catch (Exception $error){

            echo "Ha ocurrido un error: $error";

        }

        return false;
    }
}