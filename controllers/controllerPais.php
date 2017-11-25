<?php
require_once 'conecta.php';

class controllerPais
{
    public function buscaPaises()
    {
        $db = new conecta();
        $paises = $db->buscaPaises();
        return $paises;
    }
}