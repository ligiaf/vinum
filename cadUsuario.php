<?php
require_once 'vendor/autoload.php';
include 'conecta.php';

$usuario = ORM::for_table('usuario')->create();

$usuario->nome = $_GET['txtNome'];
$usuario->email = $_GET['txtEmail'];
$usuario->foto =
$usuario->senha = $_GET['txtSenha'];
$usuario->save();
