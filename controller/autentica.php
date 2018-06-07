<?php 
    include '../connect/userDAO.php';

    $usuarioDAO = new UserDAO();

    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

    $user = $usuarioDAO->logar($email, $senha);
    
    if ($user == true) {
        session_start();

        $_SESSION['user'] = $user;

        echo json_encode(['type' => 'success']);
        exit;

        // header('Location: ../admin.php');
    } else {
        echo json_encode(['type' => 'error', 'msg' => 'Dados inválidos']);
        exit;
        // header('Location: ../index.php?erro=senha');
    }
?>