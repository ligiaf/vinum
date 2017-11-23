<?php
require_once '../vendor/autoload.php';
include '../controllers/conecta.php';
header('Content-type: text/html; charset=ISO-8859-1');
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
    <link href="css/nouislider.css.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body style="background-image: radial-gradient(#ffffff,#2e525a)">

<!-- NAO LOGADO -->
<!--
<nav class="white" role="navigation">
  <div class="nav-wrapper container">
    <a id="logo-container" href="#" class="brand-logo"><img class="responsive-img" src="images/logo.fw.png"></a>
    <ul class="right hide-on-med-and-down">
      <li><a href="viewBuscarVinho.html" class="valign-wrapper"><i class="material-icons left">search</i>Buscar vinhos</a></li>
      <li>
<a class="modal-trigger valign-wrapper" href="#modal1">Login</a>
</li>
<div id="modal1" class="modal">
    <div class="modal-content">
        <h4 class="black-text">Login</h4>
        <form class="container grey-text col s6">
            <div class="row">
                <div class="input-field ">
                    <input type="email" name="txtLoginEmail"/>
                    <label>Email: </label>
                </div>
            </div>
            <div class="row">
                <div class="input-field ">
                    <input type="password" name="txtLoginSenha"/>
                    <label>Senha: </label>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action waves-effect waves-green btn-flat" type="submit">Entrar</a>
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
            </div>
        </form>
    </div>
</div>
<li>
    <a class="modal-trigger valign-wrapper" href="#modal2">Cadastre-se</a>
</li>
<div id="modal2" class="modal">
    <div class="modal-content">
        <h4 class="black-text">Cadastro</h4>
        <form class="container grey-text">
            <div class="row">
                <div class="input-field">
                    <input type="text" name="txtNome" class="validate"/>
                    <label>Nome: </label>
                </div>
            </div>
            <div class="row">
                <div class="input-field ">
                    <input type="email" name="txtEmail" class="validate"/>
                    <label>Email: </label>
                </div>
            </div>
            <div class="row">
                <div class="input-field ">
                    <input type="password" name="txtSenha" class="validate"/>
                    <label>Senha: </label>
                </div>
            </div>
            <div class="row valign-wrapper">
                <div class="modal-footer">
                    <a name="btnCadastrar" href="#!" class="modal-action waves-effect waves-green btn-flat">Entrar</a>
                    <a href="#!" class="modal-action modal-close waves-effect waves-green  btn-flat">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
    </ul>
    <ul id="nav-mobile" class="side-nav">
        <li><a href="#">Login</a></li>
        <li><a href="#">Entrar</a></li>
    </ul>
    <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
</div>
</nav>
-->

<!-- LOGADO -->

<nav class="white" role="navigation">
    <div class="nav-wrapper container">
        <a href="index.php" class="brand-logo"><img class="responsive-img" src="../images/logo.fw.png"></a>
        <ul id="nav-mobile" class=" right hide-on-med-and-down">
            <li><a href="viewBuscarVinho.php" class="valign-wrapper"><i class="material-icons left">search</i>Buscar vinhos</a></li>
            <li><a href="viewMeusVinhos.php" class="valign-wrapper"><i class="material-icons left">dashboard</i>Meus vinhos</a></li>
            <li><a href="#!" class="valign-wrapper"><i class="material-icons left">account_circle</i>Nome do individuo</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="col s10">
        <div class="card-panel grey lighten-3">
            <div class="row col s12">
                <div class="card-panel white center col s3" style="padding-top: 10px; padding-bottom: 8px">
                    <img src="../images/vinho1.jpg" alt="" class="responsive-img">
                </div>
                <div class="col s9 valign-wrapper">
                    <div class="col s4 offset-s1 left-align">
                        <h4><b>Titulo vinho</b></h4>
                    </div>
                    <div class="right-align col col s4">
                        <form>
                            <a href="#"><i class="material-icons grey-text">star</i></a>
                            <a href="#"><i class="material-icons grey-text">star</i></a>
                            <a href="#"><i class="material-icons grey-text">star</i></a>
                            <a href="#"><i class="material-icons grey-text">star</i></a>
                            <a href="#"><i class="material-icons grey-text">star</i></a>
                        </form>
                    </div>
                </div>
                <div class="col s8 offset-s1">
                    <div class="row">
                        <p class="light" style="font-size:30px"><i class="material-icons left yellow-text text-darken-2" style="font-size: 28px">star</i>4.5</p>
                        <p> blablbala tipo</p>
                        <p> blablbala estilo</p>
                        <p> blablbala região</p>
                    </div>
                </div>
            </div>
            <div class="divider"> </div>
            <div class="row">
                <section>
                    <h5>Resenhas</h5>
                </section>
            </div>
            <div class="row">
                <p><a href="viewVisualizarUsuario.php" class="black-text"><b>Nome do usuario</b></a> <small>12/05/1017</small></p>
            </div>
            <div class="row">
                <blockquote>
                    <p class="light">This is an example quotation that uses the blockquote tag.</p>
                </blockquote>
            </div>
            <div class="divider"> </div>
            <div class="row">
                <p><a href="viewVisualizarUsuario.php" class="black-text"><b>Nome do usuario</b></a> <small>12/05/1017</small></p>
            </div>
            <div class="row">
                <blockquote>
                    <p class="light">This is an example quotation that uses the blockquote tag.</p>
                </blockquote>
            </div>
            <div class="divider"> </div>
            <div class="row">
                <p><a href="viewVisualizarUsuario.php" class="black-text"><b>Nome do usuario</b></a> <small>12/05/1017</small></p>
            </div>
            <div class="row">
                <blockquote>
                    <p class="light">This is an example quotation that uses the blockquote tag.</p>
                </blockquote>
            </div>
            <div class="divider"> </div>
            <br>
            <div class="row">
                <form class="col s12">
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea id="textarea1" class="materialize-textarea"></textarea>
                            <label for="textarea1">Resenha</label>
                        </div>
                    </div>
                    <button class="btn waves-effect waves-light center teal darken-4 col s2 offset-s10" type="submit" name="btnResenha">Publicar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="../js/materialize.js"></script>
<script src="../js/init.js"></script>
<script src="../js/nouislider.js"></script>
</body>
</html>