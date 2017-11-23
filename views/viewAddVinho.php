<?php
require_once '../vendor/autoload.php';
include '../controllers/controllerVinho.php';

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
            <li><a href="viewVisualizarUsuario.php" class="valign-wrapper"><i class="material-icons left">account_circle</i>Nome do individuo</a></li>
        </ul>
    </div>
</nav>

<div class="container" >
    <div class="card-panel grey lighten-3">

        <section class="section">
            <h4> Adicionar vinho </h4>
        </section>
        <div class="divider"></div>
        <br>
        <!--AQUI É ONDE TEM Q APARECER AS SUGESTOES DE VINHO PRA NAO CADASTRAR DNV-->
        <form id="vinho" method="post" action="viewVinhoExistente.php">
            <div class="input-field">
                <i class="material-icons prefix">local_bar</i>

                <input type="text" name="autocomplete" id="autocomplete-input" class="autocomplete">
                <label>Nome do vinho</label>

            </div>
        </form>
        <br>

        <!-- ISSO APARECE SE NAO TIVER VINHO CADASTRADO -->
        <div class="row" id="cadastro">
            <form class="col s12">
                <section>
                    <h5>Adicione um novo vinho</h5>
                </section>
                <br>
                <div class="row">
                    <div class="input-field col s6">
                        <input placeholder="" name="txtTitulo" id="txtTitulo" type="text" class="validate">
                        <label>Título</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="" name="txtVinicola" type="text" class="validate">
                        <label>Vinícola</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <select>
                            <option value="" disabled selected>Selecionar</option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                        </select>
                        <label>Região ou país de origem</label>
                    </div>
                    <div class="input-field col s6">
                        <select>
                            <option value="" disabled selected>Selecionar</option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                        </select>
                        <label>Tipo</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <select>
                            <option value="" disabled selected>Selecionar</option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                        </select>
                        <label>Estilo</label>
                    </div>
                    <div class="input-field col s6">
                        <select>
                            <option value="" disabled selected>Selecionar</option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                        </select>
                        <label>Tipo de uva</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <select multiple>
                            <option value="" disabled selected>Selecionar</option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                        </select>
                        <label>Harmonização com comidas</label>
                    </div>
                    <div class="file-field input-field col s6">
                        <div class="btn grey">
                            <span>Rótulo: </span>
                            <input type="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <button class="btn waves-effect waves-light teal darken-4 col s2 offset-s10" type="submit" name="action">Adicionar</button>
                </div>
            </form>
        </div>

        <!-- SE O VINHO JA EXISTIR APARECE O CARTAO COM O BUTAO PRA PESSOA ADICIONAR AOS 'MEUS VINHOS' -->


    </div>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script type="text/javascript" src="../js/materialize.js"></script>

<script>

    $("#autocomplete-input").change(function(){
       $("#txtTitulo").val($("#autocomplete-input").val());
    });

    $(function() {
        $('input.autocomplete').autocomplete({
            data: {
                <?php
                $ctrVinho = new controllerVinho();
                $res =  $ctrVinho->listaVinho();
                foreach ($res as $vinho){
                ?>
                "<?= $vinho['nome'] ?>": null,
                <?php } ?>
            },
            limit: 15, // The max amount of results that can be shown at once. Default: Infinity.
            onAutocomplete: function(val) {
                $('#vinho').submit();
            },
            minLength: 1 // The minimum length of the input for the autocomplete to start. Default: 1.
        });
    });
</script>

</body>
</html>