<?php

namespace Dao;

require_once("C:/xampp/htdocs/proyectosPhpStorm/phpMongoAvanzado/Dao/IUsuarioDao.php");
require_once("C:/xampp/htdocs/proyectosPhpStorm/phpMongoAvanzado/Dao/Conexion.php");

use Conexion;
use Exception;
use modelos\Persona;
use MongoDB\BSON\ObjectId;

class UsuarioDao extends Conexion implements IUsuarioDao
{
    public function __construct()
    {
    }

    public function verUsuario(string $id): ?Persona
    {
        try
        {
            $coleccion = $this->getConexion(C_USUARIO);
            $resultado = $coleccion->findOne([CU_ID => new ObjectID($id)]);

            $usuario = new Persona();
            $usuario->setId($resultado[CU_ID] ?? null);
            $usuario->setNombre($resultado[CU_NOMBRE] ?? null);
            $usuario->setDocumento($resultado[CU_DOCUMENTO] ?? null);
            $usuario->setRol($resultado[CU_ROL] ?? null);
            $usuario->setTelefono($resultado[CU_TELEFONO] ?? null);
            $usuario->setDireccion($resultado[CU_DIRECCION] ?? null);
            $usuario->setCorreo($resultado[CU_CORREO] ?? null);

            return $usuario;
        }
        catch (Exception $error)
        {

            echo "Ha ocurrido un error: $error";

        }
        return null;
    }

    public function findByDocumento(?string $documento): ?Persona
    {
        try
        {
            $coleccion = $this->getConexion(C_USUARIO);
            $resultado = $coleccion->findOne([CU_DOCUMENTO => $documento]);

            $usuario = new Persona();

            $usuario->setId($resultado[CU_ID] ?? null);
            $usuario->setNombre($resultado[CU_NOMBRE] ?? null);
            $usuario->setDocumento($resultado[CU_DOCUMENTO] ?? null);
            $usuario->setRol($resultado[CU_ROL] ?? null);
            $usuario->setTelefono($resultado[CU_TELEFONO] ?? null);
            $usuario->setDireccion($resultado[CU_DIRECCION] ?? null);
            $usuario->setCorreo($resultado[CU_CORREO] ?? null);
            $usuario->setPassword($resultado[CU_PASSWORD] ?? null);

            return $usuario;
        }
        catch (Exception $error)
        {

            echo "Ha ocurrido un error: $error";

        }
        return null;
    }

    public function verUsuarios(): ?array
    {
        try
        {
            $coleccion = $this->getConexion(C_USUARIO);
            $resultados = $coleccion->find([]);
            $usuarios = array();

            foreach($resultados as $resultado)
            {
                $usuario = new Persona();

                $usuario->setId($resultado[CU_ID] ?? null);
                $usuario->setNombre($resultado[CU_NOMBRE] ?? null);
                $usuario->setDocumento($resultado[CU_DOCUMENTO] ?? null);
                $usuario->setRol($resultado[CU_ROL] ?? null);
                $usuario->setTelefono($resultado[CU_TELEFONO] ?? null);
                $usuario->setDireccion($resultado[CU_DIRECCION] ?? null);
                $usuario->setCorreo($resultado[CU_CORREO] ?? null);

                $usuarios[] = $usuario;
            }

            return $usuarios;
        }
        catch (Exception $error)
        {

            echo "Ha ocurrido un error: $error";

        }
        return null;
    }

    public function addUsuario(Persona $usuario): ?bool
    {
        $data = [
            CU_NOMBRE => $usuario->getNombre() ?? null,
            CU_TELEFONO => $usuario->getTelefono() ?? null,
            CU_CORREO => $usuario->getCorreo() ?? null,
            CU_DIRECCION => $usuario->getDireccion() ?? null,
            CU_DOCUMENTO => $usuario->getDocumento() ?? null,
            CU_ROL => $usuario->getRol() ?? null,
            CU_PASSWORD => password_hash($usuario->getPassword(), PASSWORD_DEFAULT) ?? null
        ];

        try {

            $coleccion = $this->getConexion(C_USUARIO);
            $resultado =$coleccion->insertOne($data);
            return (bool)$resultado;

        }
        catch (Exception $error){

            echo "Ha ocurrido un error: $error";

        }

        return false;

    }

    public function actualizarUsuario(Persona $usuario): ?bool
    {
        $usuarioFound = $this->findByDocumento($usuario->getDocumento());

        $data = [
            CU_NOMBRE => $usuario->getNombre() ?? $usuarioFound->getNombre(),
            CU_TELEFONO => $usuario->getTelefono() ?? $usuarioFound->getTelefono(),
            CU_CORREO => $usuario->getCorreo() ?? $usuarioFound->getCorreo(),
            CU_DIRECCION => $usuario->getDireccion() ?? $usuarioFound->getDireccion(),
            CU_DOCUMENTO => $usuario->getDocumento() ?? $usuarioFound->getDocumento(),
            CU_ROL => $usuario->getRol() ?? $usuarioFound->getRol(),
            CU_PASSWORD => $usuario->getPassword() ?
                password_hash($usuario->getPassword(), PASSWORD_DEFAULT)
                    :
                $usuarioFound->getPassword()
        ];

        try {

            $coleccion = $this->getConexion(C_USUARIO);
            $coleccion->updateOne([CU_ID=> new ObjectID($usuario->getId())], [SET => $data]);

            return true;
        }
        catch (Exception $error){

            echo "Ha ocurrido un error: $error";

        }

        return false;
    }

    public function eliminarUsuario(string $id): ?bool
    {
        try {
            $coleccion = $this->getConexion(C_USUARIO);
            $coleccion->deleteOne([CU_ID=> new ObjectID($id)]);

            return true;
        }
        catch (Exception $error){

            echo "Ha ocurrido un error: $error";

        }

        return false;
    }

    public function verClientes(): ?array
    {
        try
        {
            $coleccion = $this->getConexion(C_USUARIO);
            $resultados = $coleccion->find(['rol' => 2]);
            $usuarios = array();

            foreach($resultados as $resultado)
            {
                $usuario = new Persona();

                $usuario->setId($resultado[CU_ID] ?? null);
                $usuario->setNombre($resultado[CU_NOMBRE] ?? null);
                $usuario->setDocumento($resultado[CU_DOCUMENTO] ?? null);
                $usuario->setRol($resultado[CU_ROL] ?? null);
                $usuario->setTelefono($resultado[CU_TELEFONO] ?? null);
                $usuario->setDireccion($resultado[CU_DIRECCION] ?? null);
                $usuario->setCorreo($resultado[CU_CORREO] ?? null);

                $usuarios[] = $usuario;
            }

            return $usuarios;
        }
        catch (Exception $error)
        {

            echo "Ha ocurrido un error: $error";

        }
        return null;
    }

    public function login(string $correo, string $clave): ?Persona
    {
        try
        {
            $coleccion = $this->getConexion(C_USUARIO);
            $resultado = $coleccion->findOne([CU_CORREO => $correo]);

            $usuario = new Persona();
            $usuario->setId($resultado[CU_ID] ?? null);
            $usuario->setNombre($resultado[CU_NOMBRE] ?? null);
            $usuario->setDocumento($resultado[CU_DOCUMENTO] ?? null);
            $usuario->setRol($resultado[CU_ROL] ?? null);
            $usuario->setTelefono($resultado[CU_TELEFONO] ?? null);
            $usuario->setDireccion($resultado[CU_DIRECCION] ?? null);
            $usuario->setCorreo($resultado[CU_CORREO] ?? null);

            if(password_verify($clave, $resultado[CU_PASSWORD]))
            {
                return $usuario;
            }

        }
        catch (Exception $error)
        {

            echo "Ha ocurrido un error: $error";

        }
        return null;
    }

}