<?php 

require '../connect/userDAO.php';

//propriedades form mensagem
$action = $_POST['action'];
$id = $_POST['id'];
$nome = $_POST['nome'];
$assunto = $_POST['assunto'];
$mensagem = $_POST['mensagem'];

//propriedades form usuario
$email = $_POST['email'];
$senha = $_POST['senha'];

var_dump($id);
var_dump($nome);
var_dump($assunto);
var_dump($mensagem);

$model = new UserDAO();

switch ($action) {
    case 'inserirUser':
        $model->inserirUser($nome, $email, $senha);
    break;

    case 'inserirMsg':
        $model->inserirMsg($nome, $assunto, $mensagem);
    break;
    
    case 'editarMsg':
        $model->editarMsg($id, $nome, $assunto, $mensagem);
    break;

    case 'excluirMsg':
        $model->excluirMsg($id);
    break;
}