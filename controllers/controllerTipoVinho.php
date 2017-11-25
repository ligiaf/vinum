<?php
require_once ('conecta.php');

class controllerTipoVinho
{
    public function buscaTipos()
    {
        $db = new conecta();
        $tipos = $db->buscaTipos();
        return $tipos;
    }
}