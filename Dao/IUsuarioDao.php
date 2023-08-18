<?php

namespace Dao;

use modelos\Persona;

interface IUsuarioDao
{
    public function verUsuario(string $id) : ?Persona;
    public function findByDocumento(?string $documento): ?Persona;
    public function verClientes() : ?array;
    public function verUsuarios() : ?array;
    public function addUsuario(Persona $usuario): ?bool;
    public function actualizarUsuario(Persona $usuario): ?bool;
    public  function eliminarUsuario(string $id): ?bool;
    public function login(string $correo, string $clave): ?Persona;

}