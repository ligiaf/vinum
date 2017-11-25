<?php
require_once '../vendor/autoload.php';
include '../controllers/controllerUsuario.php';
header('Content-type: text/html; charset=ISO-8859-1');

session_start();

if(!isset($_SESSION['nome']))
{
    header('Location:index.php');
    exit;
}

if(isset($_GET['id']))
{
    $ctrUsuario = new controllerUsuario();
    $usuario = $ctrUsuario->buscaUsuarioID($_GET['id']);
    $resenhas = $ctrUsuario->buscaResenhaUsuario($_GET['id']);
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

<div class="container">
    <div class="col s10">
        <div class="card-panel grey lighten-3">
            <div class="row">
                <div class="col s4 offset-s4">
                    <div class="card-panel white" style="padding-top: 10px; padding-bottom: 8px">
                        <img src="../images/users/<?php if($usuario['foto']) { echo $usuario['foto'];
                                                        }else {echo "perfil.png";} ?>" alt="" class="responsive-img">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 center">
                    <h5><b><?=$usuario['nome'];?></b></h5>
                </div>
            </div>
            <div class="divider"> </div>
            <br/>
            <div class="row">
                <section>
                    <h5>Resenhas</h5>
                </section>
            </div>
            <?php foreach ($resenhas as $resenha){ ?>
                <div class="row">
                    <p><a href="viewVisualizarVinho.php?id=<?=$resenha['ID_vinho']?>" class="black-text"><b><?=$resenha['nomeVinho']?></b></a><small><?=$resenha['datahora'] ?></small></p>
                </div>
                <div class="row">
                    <blockquote>
                        <p class="light"><?=$resenha['resenha']?></p>
                    </blockquote>
                </div>
                <div class="divider"> </div>
            <?php } ?>
        </div>
    </div>
</div>

<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="../js/materialize.js"></script>
<script src="../js/init.js"></script>
</body>
</html>