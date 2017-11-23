<?php
require_once '../vendor/autoload.php';
include '../controllers/controllerVinho.php';
header('Content-type: text/html; charset=ISO-8859-1');

if(isset($_POST['autocomplete']))
{
    $ctrVinho = new controllerVinho();
    $vinho = $ctrVinho->buscarVinho($_POST['autocomplete']);
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
            <li><a href="viewBuscarVinho.php" class="valign-wrapper"><i class="material-icons left">search</i>Buscar vinhos</a></li>
            <li><a href="viewMeusVinhos.php" class="valign-wrapper"><i class="material-icons left">dashboard</i>Meus vinhos</a></li>
            <li><a href="viewVisualizarUsuario.php" class="valign-wrapper"><i class="material-icons left">account_circle</i>Nome do individuo</a></li>
        </ul>
    </div>
</nav>

<div class="container" >
    <div class="card-panel grey lighten-3">
        <div class="col s12" id="existente">
            <section>
                <h5>Adicione aos seus vinhos</h5>
            </section>
            <br>
            <div class="card horizontal small">
                <div class="card-image">
                    <img src="../images/<?= $vinho['rotulo'] ?>">
                </div>
                <div class="card-stacked">
                    <h4 class="header" id="nome">&nbsp; <?= $vinho['nome'] ?></h4>
                    <div class="card-content">
                        <p>Tipo: <?= $vinho['ID_tipo'] ?></p>
                        <p>Estilo: <?= $vinho['ID_estilo'] ?></p>
                        <p>Regi�o: <?= $vinho['regiao'] ?></p>
                        <p>Pa�s: <?= $vinho['ID_regiao'] ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <h4 class="black-text">Insira o seu r�tulo</h4>
                <form class="container grey-text">
                    <div class="file-field input-field col s10">
                        <div class="btn grey">
                            <span>R�tulo: </span>
                            <input type="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>
                    <div class="col s2 valign-wrapper">
                        <input name="btnInserir" type="submit" value="Inserir" class="waves-effect waves-green btn-flat">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>