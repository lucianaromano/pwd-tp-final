<?php
class MenuRol extends BaseDatos
{
    private $objMenu;
    private $objrol;


    private $mensajeoperacion;


    public function __construct()
    {
        parent::__construct();
        $this->objMenu = new Menu();
        $this->objrol = new Rol();
    }
    public function setear($objMenu, $objrol)
    {
        $this->setobjMenu($objMenu);
        $this->setobjrol($objrol);
    }

    public function setearConClave($idmenu, $idjrol)
    {
        $this->getobjrol()->setidrol($idjrol);
        $this->getobjMenu()->setIdmenu($idmenu);
    }

    public function getobjMenu()
    {
        return $this->objMenu;
    }
    public function setobjMenu($objMenu)
    {
        $this->objMenu = $objMenu;
    }
    public function getobjrol()
    {
        return $this->objrol;
    }
    public function setobjrol($objrol)
    {
        $this->objrol = $objrol;
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
        $sql = "SELECT * FROM menurol WHERE idrol = " . $this->getobjrol()->getidrol() . " AND idmenu = " . $this->getobjMenu()->getidmenu() . ";";
        if ($this->Iniciar()) {
            $res = $this->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $this->Registro();

                    $obj1 = new Menu();
                    $obj1->setIdmenu($row['idmenu']);
                    $obj1->cargar();
                    $obj2 = new Rol();
                    $obj2->setidrol($row['idrol']);
                    $obj2->cargar();
                    $this->setear($obj1, $obj2);
                }
            }
        } else {
            $this->setmensajeoperacion("menurol->listar: " . $this->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $sql = "INSERT INTO menurol(idrol,idmenu)  VALUES(" . $this->getobjrol()->getidrol() . "," . $this->getobjMenu()->getIdmenu() . ");";
        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("menurol->insertar: " . $this->getError());
            }
        } else {
            $this->setmensajeoperacion("menurol->insertar: " . $this->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        return $resp;
    }



    public function eliminar()
    {
        $resp = false;
        $sql = "DELETE FROM menurol WHERE idrol=" . $this->getobjrol()->getidrol() . " AND idmenu =" . $this->getobjMenu()->getidmenu() . ";";
        if ($this->Iniciar()) {    
            if ($this->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("menurol->eliminar: " . $this->getError());
            }
        } else {
            $this->setmensajeoperacion("menurol->eliminar: " . $this->getError());
        }
        return $resp;
    }

    public function listar($parametro = "")
    {
        $arreglo = array();
        $sql = "SELECT * FROM menurol ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        if ($this->Iniciar()) {       
            $res = $this->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    while ($row = $this->Registro()) {
                        $obj = new MenuRol();

                        $obj->getobjMenu()->setIdmenu($row['idmenu']);
                        $obj->getobjrol()->setidrol($row['idrol']);
                        $obj->cargar();
                        array_push($arreglo, $obj);
                    }
                }
            } else {
                $this->setmensajeoperacion("menurol->listar: " . $this->getError());
            }
        }
        return $arreglo;
    }
}
