<?php

class Usuario
{
    private $idusuario;
    private $usnombre;
    private $uspass;
    private $usmail;
    private $usdeshabilitado;

    private $mensajeoperacion;


    public function __construct()
    {
        $this->idusuario = "";
        $this->usnombre = "";
        $this->uspass = "";
        $this->usmail = "";
        $this->usdeshabilitado = "";
        $this->mensajeoperacion = "";
    }
    public function setear($idusuario, $usnombre, $uspass, $usmail, $usdeshabilitado)
    {
        $this->setidusuario($idusuario);
        $this->setusnombre($usnombre);
        $this->setuspass($uspass);
        $this->setusmail($usmail);

        if ($usdeshabilitado = 'null')
            $usdeshabilitado = "0000-00-00 00:00:00";

        $this->setusdeshabilitado($usdeshabilitado);
    }

    public function getidusuario()
    {
        return $this->idusuario;
    }
    public function setidusuario($idusuario)
    {
        $this->idusuario = $idusuario;
    }
    public function getusnombre()
    {
        return $this->usnombre;
    }
    public function setusnombre($usnombre)
    {
        $this->usnombre = $usnombre;
    }
    public function getuspass()
    {
        return $this->uspass;
    }
    public function setuspass($uspass)
    {
        $this->uspass = $uspass;
    }
    public function getusmail()
    {
        return $this->usmail;
    }
    public function setusmail($usmail)
    {
        $this->usmail = $usmail;
    }
    public function getusdeshabilitado()
    {
        return $this->usdeshabilitado;
    }
    public function setusdeshabilitado($usdeshabilitado)
    {
        $this->usdeshabilitado = $usdeshabilitado;
    }

    public function getmensajeoperacion()
    {
        return $this->mensajeoperacion;
    }
    public function setmensajeoperacion($valor)
    {
        $this->mensajeoperacion = $valor;
    }

    public function cargar()
    {
        $resp = false;
        $db = new BaseDatos();
        $sql = "SELECT * FROM usuario WHERE idusuario = " . $this->getidusuario();
        if ($db->Iniciar()) {
            $res = $db->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $db->Registro();
                    $this->setear($row['idusuario'], $row['usnombre'], $row['uspass'], $row['usmail'], $row['usdeshabilitado']);
                }
            }
        } else {
            $this->setmensajeoperacion("usuarios->listar: " . $db->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $db = new BaseDatos();
        $sql = "INSERT INTO usuario(usnombre,uspass,usmail,usdeshabilitado)  VALUES('" . $this->getusnombre() . "','" . $this->getuspass() . "','" . $this->getusmail() . "','0000-00-00 00:00:00');";
        if ($db->Iniciar()) {
            if ($elid = $db->Ejecutar($sql)) {
                $this->setidusuario($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("usuarios->insertar: " . $db->getError());
            }
        } else {
            $this->setmensajeoperacion("usuarios->insertar: " . $db->getError());
        }
        return $resp;
    }


    public function modificar()
    {
        $resp = false;
        $db = new BaseDatos();
        $sql = "UPDATE usuario SET usnombre='" . $this->getusnombre() . "' ,uspass='" . $this->getuspass() . "',usmail='" . $this->getusmail() . "' ,usdeshabilitado='" . $this->getusdeshabilitado() . "'  " .
            " WHERE idusuario=" . $this->getidusuario();
        if ($db->Iniciar()) {
            if ($db->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("usuarios->modificar: " . $db->getError());
            }
        } else {
            $this->setmensajeoperacion("usuarios->modificar: " . $db->getError());
        }
        return $resp;
    }
    public function eliminar()
    {
        $resp = false;
        $db = new BaseDatos();
        $sql = "DELETE FROM usuario WHERE idusuario=" . $this->getidusuario();
        if ($db->Iniciar()) {
            if ($db->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("usuarios->eliminar: " . $db->getError());
            }
        } else {
            $this->setmensajeoperacion("usuarios->eliminar: " . $db->getError());
        }
        return $resp;
    }

    public function listar($parametro = "")
    {
        $arreglo = array();
        $db = new BaseDatos();
        $sql = "SELECT * FROM usuario ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        if ($db->Iniciar()) {   
            $res = $db->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    while ($row = $db->Registro()) {
                        $obj = new Usuario();
                        $obj->setidusuario($row['idusuario']);
                        $obj->cargar();
                        array_push($arreglo, $obj);
                    }
                }
            } else {
                $this->setmensajeoperacion("usuarios->listar: " . $db->getError());
            }
        }
        return $arreglo;
    }
}
