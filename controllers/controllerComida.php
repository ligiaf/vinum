<?php
require_once ('conecta.php');

class controllerComida
{
    public function buscaComidas()
    {
        $db = new conecta();
        $comidas = $db->buscaComidas();
        return $comidas;
    }
}