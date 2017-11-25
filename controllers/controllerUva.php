<?php
require_once ('conecta.php');

class controllerUva
{
    public function buscaUvas()
    {
        $db = new conecta();
        $uvas = $db->buscaUvas();
        return $uvas;
    }
}