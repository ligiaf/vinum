<?php
require_once ('conecta.php');

class controllerEstilo
{
    public function buscaEstilos()
    {
        $db = new conecta();
        $estilos = $db->buscaEstilos();
        return $estilos;
    }
}