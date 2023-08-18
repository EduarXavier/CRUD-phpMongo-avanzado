<?php

namespace Dao;

use modelos\Producto;

interface IProductosDao
{
    public function verProducto(string $id): ?Producto;
    public function verProductos(): ?array;
    public function addProducto(Producto $producto): ?bool;

}