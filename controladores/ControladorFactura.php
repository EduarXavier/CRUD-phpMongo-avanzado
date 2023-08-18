<?php

namespace controladores;

require_once("C:/xampp/htdocs/proyectosPhpStorm/phpMongoAvanzado/Dao/IFacturaDao.php");
require_once("C:/xampp/htdocs/proyectosPhpStorm/phpMongoAvanzado/Dao/FacturaDao.php");
require_once("C:/xampp/htdocs/proyectosPhpStorm/phpMongoAvanzado/modelos/Factura.php");

use Dao\FacturaDao;
use Dao\IFacturaDao;
use modelos\Factura;

class ControladorFactura
{
    private IFacturaDao $iFacturaDao;

    public function __construct()
    {
        $this->iFacturaDao = new FacturaDao();
    }

    public function verFactura(string $id): ?Factura
    {
        return $this->iFacturaDao->verFactura($id);
    }

    public function verFacturas(): ?array
    {
        return $this->iFacturaDao->verFacturas();
    }

    public function verMisFacturas(string $documento): ?array
    {
        return $this->iFacturaDao->verMisFacturas($documento);
    }

    public function generarFactura(Factura $factura): ?string
    {
        return $this->iFacturaDao->generarFactura($factura);
    }

}