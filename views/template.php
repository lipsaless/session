<?php 
    require '../connect/userDAO.php';

    $model = new UserDAO();

    $dados = $model->grid();

    session_start();    

    if (!$_SESSION['user']) {
        header('Location: ./template.php');
    }
?>

<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="css/template.css">

<style>
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
    #tab-cadastro-msg, #tab-visualiza-msg {
        background-color: white;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    #tab-cadastro-msg p, #tab-visualiza-msg p {
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
</style>

<div class="wrapper">
  <!-- Sidebar Holder -->
  <nav id="sidebar">
    <div class="sidebar-header">
      <h3>Admin</h3>
    </div>
    <hr style="background-color: white;">
    <ul class="list-unstyled components">
        <p>Seja bem-vindo(a), <?php echo $_SESSION['user']['nome']; ?></p>
        <hr style="background-color: white;">
        <li>
            <a href="#tab-cadastro-msg">Cadastrar mensagem</a>
        </li>
        <li>
            <a id="vm" href="#tab-visualiza-msg">Visualizar mensagens</a>
        </li>
    </ul>
  </nav>

  <!-- Page Content Holder -->
  <div id="content">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" id="sidebarCollapse" class="btn btn-primary navbar-btn">
                    <i class="glyphicon glyphicon-align-left"></i>
                    <span><</span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a id="sair" href="../controller/logout.php">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

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
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Assunto</th>
                    <th>Mensagem</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dados as $key => $value): ?>
                <tr data-id="<?php echo $value['id']?>">
                    <td>#<?php echo $value['id']; ?></td>
                    <td class="about" data-name="nome"><?php echo $value['nome']; ?></td>
                    <td class="about" data-name="assunto"><?php echo $value['assunto']; ?></td>
                    <td class="about" data-name="mensagem"><?php echo $value['mensagem']; ?></td>
                    <td>
                        <button class="btn btn-primary btn-editar-msg">Editar</button>
                        <button class="btn btn-danger btn-excluir-msg">Excluir</button>
                        <button class="btn btn-success btn-save-msg" action="../controller/crud.php" style="display:none;">Salvar</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!--=========================================================-->
                        <!--FIM CONTEÚDO-->
    <!--=========================================================-->
</div>

<!-- ===================================================== -->
<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="js/template.js"></script>

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

            //DISABLE NO INPUT APÓS SALVAR
            $inputsDaTr.closest('.field').addClass('disabled')

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
                dataType: 'json'
            }).done(function(data) {
                $($trClicadaQuandoSalvar).find('.btn-editar-msg').show();
                $($trClicadaQuandoSalvar).find('.btn-excluir-msg').show();
                //MOSTRAR SAVE
                $($trClicadaQuandoSalvar).find('.btn-save-msg').hide();
            })
        });

    });

        $('[href="#tab-cadastro-msg"]').click(function(){
            $('#tab-cadastro-msg').css('display', 'block');
            $('#tab-visualiza-msg').hide();
        });

        $('[href="#tab-visualiza-msg"]').click(function(){
            $('#tab-visualiza-msg').css('display', 'block');
            $('#tab-cadastro-msg').hide();
        });
</script>