<?php

class vinho
{
    private $nome;
    private $rotulo;
    private $produtor;
    private $regiao;
    private $preco;
    private $idRegiao;
    private $idTipo;
    private $idEstilo;
    private $idUva;

    public function __construct($nome, $rotulo, $produtor, $regiao, $preco, $idRegiao, $idTipo, $idEstilo, $idUva)
    {
        $this->nome = $nome;
        $this->rotulo = $rotulo;
        $this->produtor = $produtor;
        $this->regiao = $regiao;
        $this->preco = $preco;
        $this->idRegiao = $idRegiao;
        $this->idTipo = $idTipo;
        $this->idEstilo = $idEstilo;
        $this->idUva = $idUva;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @return mixed
     */
    public function getRotulo()
    {
        return $this->rotulo;
    }

    /**
     * @return mixed
     */
    public function getProdutor()
    {
        return $this->produtor;
    }

    /**
     * @return mixed
     */
    public function getRegiao()
    {
        return $this->regiao;
    }

    /**
     * @return mixed
     */
    public function getPreco()
    {
        return $this->preco;
    }

    /**
     * @return mixed
     */
    public function getIdRegiao()
    {
        return $this->idRegiao;
    }

    /**
     * @return mixed
     */
    public function getIdTipo()
    {
        return $this->idTipo;
    }

    /**
     * @return mixed
     */
    public function getIdEstilo()
    {
        return $this->idEstilo;
    }

    /**
     * @return mixed
     */
    public function getIdUva()
    {
        return $this->idUva;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @param mixed $rotulo
     */
    public function setRotulo($rotulo)
    {
        $this->rotulo = $rotulo;
    }

    /**
     * @param mixed $produtor
     */
    public function setProdutor($produtor)
    {
        $this->produtor = $produtor;
    }

    /**
     * @param mixed $regiao
     */
    public function setRegiao($regiao)
    {
        $this->regiao = $regiao;
    }

    /**
     * @param mixed $preco
     */
    public function setPreco($preco)
    {
        $this->preco = $preco;
    }

    /**
     * @param mixed $idTipo
     */
    public function setIdTipo($idTipo)
    {
        $this->idTipo = $idTipo;
    }

    /**
     * @param mixed $idRegiao
     */
    public function setIdRegiao($idRegiao)
    {
        $this->idRegiao = $idRegiao;
    }

    /**
     * @param mixed $idEstilo
     */
    public function setIdEstilo($idEstilo)
    {
        $this->idEstilo = $idEstilo;
    }

    /**
     * @param mixed $idUva
     */
    public function setIdUva($idUva)
    {
        $this->idUva = $idUva;
    }
}