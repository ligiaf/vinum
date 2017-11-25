<?php

namespace classes;

class resenha
{
    private $idUsuario;
    private $idVinho;
    private $resenha;
    private $datahora;

    public function __construct( $idUsuario, $idVinho, $resenha, $datahora)
    {
        $this->idUsuario = $idUsuario;
        $this->idVinho = $idVinho;
        $this->resenha = $resenha;
        $this->datahora = $datahora;
    }

    /**
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * @return mixed
     */
    public function getIdVinho()
    {
        return $this->idVinho;
    }

    /**
     * @return mixed
     */
    public function getResenha()
    {
        return $this->resenha;
    }

    /**
     * @return mixed
     */
    public function getDatahora()
    {
        return $this->datahora;
    }

    /**
     * @param mixed $idUsuario
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    /**
     * @param mixed $idVinho
     */
    public function setIdVinho($idVinho)
    {
        $this->idVinho = $idVinho;
    }

    /**
     * @param mixed $resenha
     */
    public function setResenha($resenha)
    {
        $this->resenha = $resenha;
    }

    /**
     * @param mixed $datahora
     */
    public function setDatahora($datahora)
    {
        $this->datahora = $datahora;
    }
}