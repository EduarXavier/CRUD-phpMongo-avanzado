<?php

namespace controladores;

require_once("C:/xampp/htdocs/proyectosPhpStorm/phpMongoAvanzado/Dao/IProductosDao.php");
require_once("C:/xampp/htdocs/proyectosPhpStorm/phpMongoAvanzado/Dao/ProductoDao.php");
require_once("C:/xampp/htdocs/proyectosPhpStorm/phpMongoAvanzado/modelos/Producto.php");

use Dao\IProductosDao;
use Dao\ProductoDao;
use modelos\Producto;

class ControladorProducto
{
    private IProductosDao $iProductosDao;

    public function __construct()
    {
        $this->iProductosDao = new ProductoDao();
    }

    public function verProducto(string $id): ?Producto
    {
        return $this->iProductosDao->verProducto($id);
    }

    public function verProductos(): ?array
    {
        return $this->iProductosDao->verProductos();
    }

    public function addProducto(Producto $producto): ?bool
    {
        return $this->iProductosDao->addProducto($producto);
    }


}