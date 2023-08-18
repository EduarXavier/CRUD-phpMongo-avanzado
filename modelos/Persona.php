<?php

namespace modelos;

class Persona
{
    private ?string $id;
    private ?string $nombre;
    private ?string $telefono;
    private ?string $correo;
    private ?string $direccion;
    private ?string $documento;
    private ?int $rol;
    private ?string $password;

    public function __construct()
    {
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): void
    {
        $this->telefono = $telefono;
    }

    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    public function setCorreo(?string $correo): void
    {
        $this->correo = $correo;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(?string $direccion): void
    {
        $this->direccion = $direccion;
    }

    public function getDocumento(): ?string
    {
        return $this->documento;
    }

    public function setDocumento(?string $documento): void
    {
        $this->documento = $documento;
    }

    public function getRol(): ?int
    {
        return $this->rol;
    }

    public function setRol(?int $rol): void
    {
        $this->rol = $rol;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }


}