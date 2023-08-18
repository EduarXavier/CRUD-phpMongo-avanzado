<?php

namespace modelos;


class Factura
{
    private string $id;
    private string $docuemntoPerosna;
    private int $total;
    private array $productos;
    private string $fecha;

    public function getFecha(): string
    {
        return $this->fecha;
    }

    public function setFecha(string $fecha): void
    {
        $this->fecha = $fecha;
    }

    public function __construct()
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getDocuemntoPerosna(): string
    {
        return $this->docuemntoPerosna;
    }

    public function setDocuemntoPerosna(string $docuemntoPerosna): void
    {
        $this->docuemntoPerosna = $docuemntoPerosna;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function setTotal(int $total): void
    {
        $this->total = $total;
    }

    public function getProductos(): array
    {
        return $this->productos;
    }

    public function setProductos(array $productos): void
    {
        $this->productos = $productos;
    }


}