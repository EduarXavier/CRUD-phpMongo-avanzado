<?php

namespace modelos;

class Producto
{
    private string $id;
    private string $codigo;
    private string $nombre;
    private string $imagen;
    private int $precio;

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

    public function getCodigo(): string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): void
    {
        $this->codigo = $codigo;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getImagen(): string
    {
        return $this->imagen;
    }

    public function setImagen(string $imagen): void
    {
        $this->imagen = $imagen;
    }

    public function getPrecio(): int
    {
        return $this->precio;
    }

    public function setPrecio(int $precio): void
    {
        $this->precio = $precio;
    }

}