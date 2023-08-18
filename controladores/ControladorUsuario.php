<?php
namespace controladores;

require_once("C:/xampp/htdocs/proyectosPhpStorm/phpMongoAvanzado/Dao/IUsuarioDao.php");
require_once("C:/xampp/htdocs/proyectosPhpStorm/phpMongoAvanzado/Dao/UsuarioDao.php");
require_once("C:/xampp/htdocs/proyectosPhpStorm/phpMongoAvanzado/modelos/Persona.php");

use Dao\IUsuarioDao;
use Dao\UsuarioDao;
use Exception;
use modelos\Persona;

class ControladorUsuario
{
    private IUsuarioDao $iUsuarioDao;

    public function __construct()
    {
        $this->iUsuarioDao = new UsuarioDao();
    }

    public function verUsuario(string $id) : ?Persona
    {
        $persona = $this->iUsuarioDao->verUsuario($id);
        return $persona ?? null;
    }

    public function findByDocumento(?string $id) : ?Persona
    {
        $persona = $this->iUsuarioDao->findByDocumento($id);
        return $persona ?? null;
    }

    public function verUsuarios() : ?array
    {
        $personas = $this->iUsuarioDao->verUsuarios();
        return $personas ?? null;
    }

    public function addUsuario(Persona $usuario): ?bool
    {
        return $this->iUsuarioDao->addUsuario($usuario);
    }


    /**
     * @throws Exception
     */
    public function actualizarUsuario(Persona $usuario): ?bool
    {
        return $this->iUsuarioDao->actualizarUsuario($usuario);
    }

    /**
     * @throws Exception
     */
    public  function eliminarUsuario(string $id): ?bool
    {
        return $this->iUsuarioDao->eliminarUsuario($id);
    }

    public  function verClientes(): ?array
    {
        $clientes = $this->iUsuarioDao->verClientes();
        return $clientes ?? null;
    }

    public function login(string $user, string $password): ?Persona
    {
        return $this->iUsuarioDao->login($user, $password);
    }

}