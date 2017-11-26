<?php
require_once '../vendor/autoload.php';
include '../controllers/controllerVinho.php';
include '../controllers/controllerUsuario.php';
header('Content-type: text/html; charset=ISO-8859-1');

session_start();

if(!isset($_SESSION['nome']))
{
    header('Location:index.php');
    exit;
}

if(isset($_POST['autocomplete']))
{
    $ctrVinho = new controllerVinho();
    $vinho = $ctrVinho->buscarVinho($_POST['autocomplete']);
    $ctrUsuario = new controllerUsuario();
    $usuario = $ctrUsuario->buscaUsuarioEmail($_SESSION['email']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>VINUM</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body style="background-image: radial-gradient(#ffffff,#2e525a)">

<nav class="white" role="navigation">
    <div class="nav-wrapper container">
        <a href="index.php" class="brand-logo"><img class="responsive-img" src="../images/logo.fw.png"></a>
        <ul id="nav-mobile" class=" right hide-on-med-and-down">
            <li><a href="viewBuscarVinho.php" class="valign-wrapper"><i class="material-icons left">search</i>Buscar
                    vinhos</a></li>
            <li><a href="viewMeusVinhos.php?id=<?=$_SESSION['id']?>" class="valign-wrapper"><i class="material-icons left">dashboard</i>Meus
                    vinhos</a></li>
            <li><a href="viewVisualizarUsuario.php?id=<?=$_SESSION['id']?>" class="valign-wrapper"><i class="material-icons left">account_circle</i><?= $_SESSION['nome'] ?></a></li>
        </ul>
    </div>
</nav>

<div class="container" >
    <div class="card-panel grey lighten-3">
        <div class="row">
            <section>
                <h4>Adicione aos seus vinhos</h4>
            </section>
            <br>
            <div class="card horizontal small">
                <div class="card-image">
                    <img src="../images/vinhos/<?= $vinho['rotulo'] ?>">
                </div>
                <div class="card-stacked">
                    <h4 class="header" id="nome">&nbsp;&nbsp;<?= $vinho['nome'] ?></h4>
                    <div class="card-content">
                        <p><b>Tipo:</b> <?=$vinho['ID_tipo']?> &nbsp; <b>Estilo:</b> <?=$vinho['ID_estilo']?> &nbsp; <b>Uva:</b> <?=$vinho['ID_uva']?></p>
                        <p><b>Região:</b> <?=$vinho['regiao']?> &nbsp; <b>País de origem:</b> <?=$vinho['ID_regiao']?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <form enctype="multipart/form-data" action="viewMeusVinhos.php?id=<?=$_SESSION['id']?>" method="post" class="container grey-text">
                <div class="file-field input-field col s10">
                    <div class="btn grey">
                        <span>Rótulo: </span>
                        <input type="file" name="rotulo" >
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
                <input type="hidden" name="vinho" value="<?=$vinho['ID_vinho']?>">
                <input type="hidden" name="idUsuario" value="<?=$_SESSION['id']?>">
                <div class="col s2">
                    <input name="btnInserir" type="submit" value="Inserir" class="btn waves-effect waves-light teal darken-4">
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script type="text/javascript" src="../js/materialize.js"></script>
</body>
</html>