<?php
class Session
{

    // Constructor
    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    /**
     * Actualiza las variables de sesión con los valores ingresados.
     */
    public function iniciar($nombreUsuario, $psw)
    {
        $resp = false;
        $obj = new ABMUsuario();
        $param['usnombre'] = $nombreUsuario;
        $param['uspass'] = $psw;
        $param['usdeshabilitado'] = '0000-00-00 00:00:00';

        $resultado = $obj->buscar($param);
        if (count($resultado) > 0) {
            $usuario = $resultado[0];
            $_SESSION['idusuario'] = $usuario->getidusuario();
            $resp = true;
        } else {
            $this->cerrar();
        }
        return $resp;
    }

    /**
     * Valida si la sesión actual tiene usuario y psw válidos. Devuelve true o false.
     */
    public function validar()
    {
        $resp = false;
        if ($this->activa() && isset($_SESSION['idusuario']))
            $resp = true;
        return $resp;
    }

    /**
     *Devuelve true o false si la sesión está activa o no.
     */
    public function activa()
    {
        $activa = false;
        if (isset($_SESSION['usnombre'])) {
            $activa = true;
        }
        return $activa;
    }

    /**
     * Devuelve el usuario logeado.
     */
    public function getUsuario()
    {
        $usuario = null;
        if ($this->validar()) {
            $obj = new ABMUsuario();
            $param['idusuario'] = $_SESSION['idusuario'];
            $resultado = $obj->buscar($param);
            if (count($resultado) > 0) {
                $usuario = $resultado[0];
            }
        }
        return $usuario;
    }

    /**
     * Devuelve el rol del usuario logeado.
     */
    public function getRol()
    {
        $list_rol = null;
        if ($this->validar()) {
            $obj = new ABMUsuario();
            $param['idusuario'] = $_SESSION['idusuario'];
            $resultado = $obj->darRoles($param);
            if (count($resultado) > 0) {
                $list_rol = $resultado;
            }
        }
        return $list_rol;
    }

    /**
     *Cierra la sesión actual.
     */
    public function cerrar()
    {
        $resp = true;
        session_destroy();
        //$_SESSION['idusuario']=null;
        return $resp;
    }
}
