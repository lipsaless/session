<?php 
    require '../connect/userDAO.php';

    $model = new UserDAO();

    $dados = $model->grid();

    session_start();    

    if (!$_SESSION['user']) {
        header('Location: ./template.php');
    }
?>

<link rel="icon" type="image/png" href="../images/icons/favicon.ico"/>
<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../vendor/semantic/semantic.css">
<link rel="stylesheet" href="css/template.css">
<link rel="stylehseet" type="text/css" href="../vendor/toastr/jquery.toast.css">
<link rel="stylehseet" type="text/css" href="../vendor/toastr/jquery.toast.min.css">
<link rel="stylesheet" href="../vendor/dataTable/dataTable.semanticui.css">
<link rel="stylesheet" type="text/css" href="../vendor/font-awesome/fontawesome-all.css">

<style>
    h4 {
        text-align: center;
    }
    button {
        cursor: pointer;
    }
    fieldset {
        border:1px solid #ccc;
        border-radius:5px;
        padding:20px;
        background-color: #cecccc3b;
    }
    textarea {
        width: 100%;
        border-radius: 5px;
    }
    #content #bem-vindo {
        text-align:center;
        font-size: 15pt;
        color: #0e62ad;
    }
    #tab-cadastro-msg, #tab-visualiza-msg, #tab-perfil {
        background-color: white;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    #tab-cadastro-msg p, #tab-visualiza-msg p, #tab-perfil p {
        text-align: center;
    }
    #tab-cadastro-msg div .container {
        margin-right: 0;
        margin-left: 0;
        padding-right: 0;
        padding-left: 0;
    }
    #tab-cadastro-msg div .container {
        max-width: 100%;
    }
    .navbar-header {
        position: absolute;
    }
    .sidebar-header img {
        margin-left: 38%;
    }
    .about {
        word-wrap: break-word;
        max-width: 350px;
    }
</style>

<div class="wrapper">
  <!-- Sidebar Holder -->
  <nav id="sidebar">
    <div class="sidebar-header">
        <h4>Mensagens</h4>
      <img src="../images/Gmail-Logo.png" alt="" width="50">
    </div>
    
    <ul class="list-unstyled components">
        <hr style="background-color: white;">
        <li>
            <a href="#tab-cadastro-msg">Cadastrar mensagem</a>
        </li>
        <li>
            <a id="vm" href="#tab-visualiza-msg">Visualizar mensagens</a>
        </li>
        <li>
            <a href="#tab-perfil">Perfil</a>
        </li>
    </ul>
  </nav>

  <!-- Page Content Holder -->
  <div id="content">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" id="sidebarCollapse" class="btn btn-dark navbar-btn">
                    <i class="glyphicon glyphicon-align-left"></i>
                    <span><</span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a id="sair" href="../controller/logout.php">Sair <i class="glyphicon glyphicon-arrow-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- BEM-VINDO -->
    <p id="bem-vindo">Seja bem-vindo(a), <?php echo $_SESSION['user']['nome']; ?></p>

    <!--=========================================================-->
                        <!--CONTEÚDO-->
    <!--=========================================================-->
    <div id="tab-cadastro-msg" style="display:none;">
        <p>Cadastrar mensagem</p>
        <div class="container-fluid">
            <form id="form-cad-msg" class="container" id="needs-validation">
                <input type="hidden" name="id" value="id">
                <input type="hidden" name="action" value="">
                <fieldset>
                    <legend style="width:auto;">dados</legend>
                <div class="form-group">
                    <label for="exampleInputPassword1">Nome</label>
                    <input type="text" class="form-control" name="nome">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Assunto</label>
                    <input type="text" class="form-control" name="assunto">
                </div>
                <label for="msg">Mensagem</label>
                <div class="form-group">
                    <textarea rows="10" name="mensagem"></textarea>
                </div>
                <button class="btn btn-success" type="submit">Cadastrar</button>
                </fieldset>
            </form>
        </div>
        <!-- /.container -->
    </div>

    <div id="tab-visualiza-msg" style="display:none;">
        <p>Mensagens</p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <!-- <th>Id</th> -->
                    <th>Nome</th>
                    <th>Assunto</th>
                    <th>Mensagem</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dados as $key => $value): ?>
                <tr data-id="<?php echo $value['id']?>">
                    <!-- <td>#<?php echo $value['id']; ?></td> -->
                    <td class="about" data-name="nome"><?php echo $value['nome']; ?></td>
                    <td class="about" data-name="assunto"><?php echo $value['assunto']; ?></td>
                    <td class="about" data-name="mensagem"><?php echo $value['mensagem']; ?></td>
                    <td>
                        <button class="ui blue button btn-editar-msg">Editar</button> 
                        <button class="ui red button btn-excluir-msg" action="../controller/crud.php">Excluir</button>
                        <button class="btn btn-success btn-save-msg" action="../controller/crud.php" style="display:none;">Salvar</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div id="tab-perfil" style="display:none;">
        <p>Perfil</p>
        <div class="container-fluid">
            <form id="form-perfil" class="container" id="needs-validation">
                <input type="hidden" name="id" value="<?php echo $_SESSION['user']['id']; ?>">
                <input type="hidden" name="action" value="">
                <div class="alert alert-success" style="display:none;">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    <strong></strong>
				</div>
                <fieldset>
                    <legend style="width:auto;">dados</legend>
                <div class="form-group">
                    <label>Nome</label>
                    <input type="text" class="form-control" name="nome" value="<?php echo $_SESSION['user']['nome']; ?>">
                </div>
                <div class="form-group">
                    <label>E-mail</label>
                    <input type="text" class="form-control" name="email" value="<?php echo $_SESSION['user']['email']; ?>">
                </div>
                <div class="form-group">
                    <label>Senha</label>
                    <input type="password" class="form-control" name="senha">
                    <input type="hidden" class="form-control" name="senhaAntiga" value="<?php echo $_SESSION['user']['senha']; ?>">
                </div>
                <button class="btn btn-success" type="submit">Salvar</button>
                </fieldset>
            </form>
        </div>
        <!-- /.container -->
    </div>
    <!--=========================================================-->
                        <!--FIM CONTEÚDO-->
    <!--=========================================================-->
</div>

<!-- ===================================================== -->
<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="js/template.js"></script>
<script src="../vendor/toastr/jquery.toast.min.js"></script>
<script src="../vendor/toastr/jquery.toast.js"></script>
<script src="../vendor/principal/principal.js"></script>
<script src="../vendor/dataTable/dataTables.js"></script>

<script>
    $(document).ready(function() {
        $('[href="#tab-visualiza-msg"]').click();

        //CADASTRAR
        $('#form-cad-msg').unbind('submit').submit(function(e) {
            e.preventDefault();

            $('[name="action"]').val('inserirMsg');

            let dadosForm = $(this).serialize;

            $.ajax({
                type: 'POST',
                url: '../controller/crud.php',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(json) {
                    if (json.type == 'success') {
                    //    $.toast('Toast message to be shown')
                        window.location.href = 'template.php';
                    }
                }
            });
        });

        //CADASTRAR
        $('#form-perfil').unbind('submit').submit(function(e) {
            e.preventDefault();

            $('[name="action"]').val('editarUser');

            let dadosForm = $(this).serialize;

            $.ajax({
                type: 'POST',
                url: '../controller/crud.php',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(json) {
                    if (json.type == 'success') {
                        $('.alert-success').css('display','block');
                        $('.alert-success strong').html(json.msg);
                        $('[name="senhaAntiga"]').val(json.senha);
                    }
                }
            });
        });

        //EDITAR
        $('.btn-editar-msg').unbind('click').click(function(e) {
            e.preventDefault();

            let $trClicada = $(e.target).closest('tr');

            $.each($trClicada.find('td.about'), function(key, rs) { 
                $td = $(rs);

                valorAEditar = $td.text();
                
                $td.html('<div class="field"><input class="form-control" width="50" name="'+$td.attr('data-name')+'" value="'+valorAEditar+'"></div>')
                $($trClicada).find('.btn-editar-msg').hide();
                $($trClicada).find('.btn-excluir-msg').hide();
                //MOSTRAR SAVE
                $($trClicada).find('.btn-save-msg').show();
            });
        });

        //SALVAR
        $('.btn-save-msg').unbind('click').click(function(e) {
            //EVITAR MAIS DE UMA REQUISIÇÃO
            e.stopImmediatePropagation();

            let $trClicadaQuandoSalvar = $(e.target).closest('tr');
            let $inputsDaTr = $trClicadaQuandoSalvar.find('input')

            //VARIAVEL QUE VAI NO DATA DO AJAX
            let objMensagem = {}
            
            //VARRENDO INPUTS DA TR CLICADA
            $.each($inputsDaTr, function (key, rs) {
                let $input = $(rs)
                let nomeInput = $input.attr('name')

                //PEGANDO VALORES DA PROPRIEDADE NAME
                objMensagem[nomeInput] = $input.val()
            })

             objMensagem.id = $trClicadaQuandoSalvar.attr('data-id')
             objMensagem.action = 'editarMsg';

            //AJAX
            $.ajax({
                type: 'POST',
                url: $('.btn-save-msg').attr('action'),
                data: objMensagem,
                dataType: 'json',
                success: function(json) {
                    if (json.type == 'success') {
                        //DISABLE NO INPUT APÓS SALVAR
                        $inputsDaTr.closest('.field').css('opacity', '0.4');
                        $($trClicadaQuandoSalvar).find('.btn-save-msg').css('opacity', '0.4');

                        window.location.href = 'template.php';
                    }
                }
            });
        });
        
        $('.btn-excluir-msg').unbind('click').click(function(e) {
            e.preventDefault();
            var idMsg = $(e.target).closest('tr').attr('data-id');

            $.ajax({
                type: 'POST',
                url: $('.btn-excluir-msg').attr('action'),
                data: {
                    id: idMsg,
                    action: 'excluirMsg'
                },
                dataType: 'json',
                success: function(json) {
                    $(e.target).closest('tr').hide()
                }
            });
        });
    });

    //TAB-CADASTRO
    $('[href="#tab-cadastro-msg"]').click(function(){
        $('#tab-cadastro-msg').css('display', 'block');
        $('#tab-visualiza-msg').hide();
        $('#tab-perfil').hide();
    });

    //TAB-VISUALIZA-MSG
    $('[href="#tab-visualiza-msg"]').click(function(){
        $('#tab-visualiza-msg').css('display', 'block');
        $('#tab-cadastro-msg').hide();
        $('#tab-perfil').hide();
    });

    //TAB-PERFIL
    $('[href="#tab-perfil"]').click(function(){
        $('#tab-perfil').css('display', 'block');
        $('#tab-cadastro-msg').hide();
        $('#tab-visualiza-msg').hide();
    });
</script>