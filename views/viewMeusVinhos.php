<?php
require_once '../vendor/autoload.php';
require_once '../controllers/controllerVinho.php';
require_once '../controllers/controllerUsuario.php';
header('Content-type: text/html; charset=ISO-8859-1');

session_start();

if(!isset($_SESSION['nome']))
{
    header('Location:index.php');
    exit;
}
$ctrUsuario = new controllerUsuario();
$ctrVinho = new controllerVinho();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['vinho']) && isset($_POST['idUsuario']) && isset($_FILES['arquivo'])) {

        if ($ctrUsuario->verificaMeusVinhos($_POST['idUsuario'], $_POST['$vinho'])) {
            echo "<script language='JavaScript'>alert('Vinho já adicionado a sua coleção!');</script>";
        } else {
            $rotulo = $_POST['idUsuario'].$_POST['vinho'];
            $destino = '../images/vinhos/'.$rotulo;
            $arquivo_tmp = $_FILES['arquivo']['tmp_name'];
            move_uploaded_file($arquivo_tmp, $destino);

            $ctrUsuario->addMeuVinho($_POST['idUsuario'], $_POST['vinho'], $rotulo);
        }
    }
}

$vinhos = array();

if(isset($_GET['id']))
{
    $meusvinhos = $ctrUsuario->buscaMeusVinhos($_GET['id']);

    foreach ($meusvinhos as $meuvinho)
    {
        $vinhos = $ctrVinho->buscaVinhoID($meuvinho['ID_vinho']);
    }

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
        <div class="card-panel grey lighten-3" style="padding-right:3%">
            <div class="row">
                <h4 class="black-text col s10">Meus vinhos</h4>
                <a href="viewAddVinho.php" class="btn-floating btn-large waves-effect waves-light teal darken-4"><i class="material-icons">add</i></a>
            </div>
            <div class="row">
                <?php
                if($vinhos) {
                    foreach ($vinhos as $vinho) { ?>
                        <div class="card small hoverable col s3">
                            <div class="card-image">
                                <img class="responsive-img" src="../images/vinhos/<?= $_GET['id'].$vinho['ID_vinho'] ?>">
                                <a href="#" class="card-title"><?= $vinho['nome'] ?></a>
                            </div>
                            <div class="card-content">
                                <p><b>Tipo:</b> <?= $vinho['ID_tipo'] ?> &nbsp;</p>
                                <p><b>Estilo:</b> <?= $vinho['ID_estilo'] ?> </p>
                                <p><b>Uva:</b> <?= $vinho['ID_uva'] ?></p>
                                <p><b>Região:</b> <?= $vinho['regiao'] ?> </p>
                                <p><b>País de origem:</b> <?= $vinho['ID_regiao'] ?></p>
                            </div>
                        </div>
                    <?php }
                }else{
                    echo "<h4>Você ainda não adicionou nenhum vinho!</h4>";
                }?>
            </div>
        </div>
    </div>
</div>

<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="../js/materialize.js"></script>
<script src="../js/init.js"></script>

</body>
</html>