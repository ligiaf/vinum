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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/10.1.0/nouislider.min.css" />
</head>
<body style="background-image: radial-gradient(#ffffff,#2e525a)">

<!-- NAO LOGADO -->
<!--
<nav class="white" role="navigation">
    <div class="nav-wrapper container">
        <a id="logo-container" href="#" class="brand-logo"><img class="responsive-img" src="images/logo.fw.png"></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="viewBuscarVinho.php" class="valign-wrapper"><i class="material-icons left">search</i>Buscar vinhos</a></li>
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
            </div>
        </ul>
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
            <li><a href="viewVisualizarUsuario.php" class="valign-wrapper"><i class="material-icons left">account_circle</i>Nome do individuo</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="col s12">
        <div class="card-panel grey lighten-3">
            <div class="row">
                <div class="col s4">
                    <section>
                        <h5>Filtros</h5>
                    </section>
                    <div class="divider"></div>
                    <br>
                    <section>
                        <b>Tipo do vinho</b>
                    </section>
                    <br>
                    <?php
                    $tiposVinho = ORM::for_table('tipo_vinho')->find_many();
                    foreach ($tiposVinho as $tipo){
                        echo '<a href="#"><div class="chip">'.$tipo['nome'].'</div></a>';
                    }
                    //QUANDO SELECIONADO OS CHIPS FICAM NESSA COR <a href="#"><div class="chip teal white-text">'.$tipo['nome'].'</div></a>
                    ?>
                    <br>
                    <br>
                    <section>
                        <b>Faixa de preço</b>
                    </section>
                    <br><br>
                    <div id="sliderPreco"></div>
                    <br>
                    <div class="input-field">
                        <section>
                            <b>Avaliação dos usuários</b>
                        </section>
                        <br><br>
                        <div id="sliderAvaliacao"></div>
                    </div>
                    <br>
                    <section>
                        <b>Uva</b>
                    </section>
                    <br>
                    <?php
                    $uvas = ORM::for_table('uva')->find_many();
                    foreach ($uvas as $uva){
                        echo '<a href="#"><div class="chip">'.$uva['tipo'].'</div></a>';
                    }
                    ?>
                    <br>
                    <br>
                    <section>
                        <b>País de origem</b>
                    </section>
                    <br>
                    <div class="chip">Brasil</div>
                    <?php
                    $regioes = ORM::for_table('regiao')->find_many();
                    foreach ($regioes as $regiao){
                        echo '<a href="#"><div class="chip">'.$regiao['nome'].'</div></a>';
                    }
                    ?>
                    <br>
                    <br>
                    <section>
                        <b>Estilo do vinho</b>
                    </section>
                    <br>
                    <?php
                    $estilos = ORM::for_table('estilo')->find_many();
                    foreach ($estilos as $estilo){
                        echo '<a href="#"><div class="chip">'.$estilo['nome'].'</div></a>';
                    }
                    ?>
                    <br>
                    <br>
                    <section>
                        <b>Harmonização com comidas</b>
                    </section>
                    <br>
                    <?php
                    $comidas = ORM::for_table('comida')->find_many();
                    foreach ($comidas as $comida){
                        echo '<a href="#"><div class="chip">'.$comida['nome'].'</div></a>';
                    }
                    ?>
                    <br>
                </div>
                <div class="col s8">
                    <section>
                        <h5>Resultados</h5>
                    </section>
                    <div class="divider"></div>
                    <br>
                    <div class="card horizontal small">
                        <div class="card-image">
                            <img class="responsive-img" src="../images/vinho6.jpg">
                        </div>
                        <div class="card-stacked">
                            <a href="viewVisualizarVinho.php"> <h4 class="header teal-text">&nbsp; Nome vinho</h4> </a>
                            <div class="card-content">
                                <p><i class="material-icons left yellow-text text-darken-2">star</i>4.5</p>
                                <p>Tipo do vinho.</p>
                                <p>Estilo do vinho.</p>
                                <p>Região do vinho.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card horizontal small">
                        <div class="card-image">
                            <img class="responsive-img" src="../images/vinho7.jpg">
                        </div>
                        <div class="card-stacked">
                            <a href="viewVisualizarVinho.php"> <h4 class="header teal-text">&nbsp; Nome vinho</h4> </a>
                            <div class="card-content">
                                <p><i class="material-icons left yellow-text text-darken-2">star</i>3.0</p>
                                <p>Tipo do vinho.</p>
                                <p>Estilo do vinho.</p>
                                <p>Região do vinho.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--  Scripts-->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="../js/materialize.js"></script>
    <script src="../js/init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/10.1.0/nouislider.min.js"></script>
    <script src="../wnumb-1.1.0/wNumb.js"></script>
    <script>
        var sliderPreco = document.getElementById('sliderPreco');

        noUiSlider.create(sliderPreco, {
            start: [300, 1000],
            connect: true,
            tooltips: [wNumb({ decimals: 0 }), wNumb({ decimals: 0 })],
            range: {
                'min': 0,
                'max': 1300
            }
        });

        var sliderAv = document.getElementById('sliderAvaliacao');

        noUiSlider.create(sliderAv, {
            start: [3],
            connect: [false, true],
            tooltips: [wNumb({ decimals: 1 })],
            range: {
                'min': 1,
                'max': 5
            }
        });
    </script>
</body>
</html>