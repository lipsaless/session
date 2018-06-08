<?php 

require '../connect/userDAO.php';

$action = $_POST['action'];

$model = new UserDAO();

switch ($action) {
    case 'inserirUser':
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $model->inserirUser($nome, $email, $senha);
    break;

    case 'editarUser':
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $senhaAntiga = $_POST['senhaAntiga'];
        $model->editarUser($id, $nome, $email, $senha, $senhaAntiga);
    break;

    case 'inserirMsg':
        $nome = $_POST['nome'];
        $assunto = $_POST['assunto'];
        $mensagem = $_POST['mensagem'];
        $model->inserirMsg($nome, $assunto, $mensagem);
    break;
    
    case 'editarMsg':
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $assunto = $_POST['assunto'];
        $mensagem = $_POST['mensagem'];
        $model->editarMsg($id, $nome, $assunto, $mensagem);
    break;

    case 'excluirMsg':
        $id = $_POST['id'];
        $model->excluirMsg($id);
    break;
}