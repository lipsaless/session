<?php 

require 'connect.php';

class UserDAO
{
    private $conexao;

    private $id;
    private $nome;
    private $assunto;
    private $mensagem;

    private $email;
    private $senha;

    public function __construct()
    {
        $this->conexao = new Connect();
    }

    public function logar($email, $senha)
    {
        $sql = "SELECT id, nome, email, senha FROM usuario WHERE email = '{$email}' AND senha = '{$senha}';";
        $executa = mysqli_query($this->conexao->getConn(), $sql);

        if (mysqli_num_rows($executa) > 0) {
            return $linha = mysqli_fetch_assoc($executa);
        } else {
            return false;
        }
    }

    public function inserirUser($nome, $email, $senha)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;

        $sql = "INSERT INTO usuario (nome, email, senha) VALUES ('{$nome}','{$email}','{$senha}');";
        $result = mysqli_query($this->conexao->getConn(), $sql);
        
        if ($result) {
            echo 'cadastrado com sucesso';

            echo json_encode(['type' => 'success']);
            exit;
        } else {
            echo 'erro no cadastro';

            echo json_encode(['type' => 'error']);
            exit;
        }
    }

    public function inserirMsg($nome, $assunto, $mensagem)
    {
        $this->nome = $nome;
        $this->assunto = $assunto;
        $this->mensagem = $mensagem;

        $sql = "INSERT INTO mensagem (nome, assunto, mensagem) VALUES ('{$nome}','{$assunto}','{$mensagem}');";
        $result = mysqli_query($this->conexao->getConn(), $sql);
        
        if ($result) {
            echo 'cadastrado com sucesso';
        } else {
            echo 'erro no cadastro';
        }
    }

    public function grid()
    {
        $sql = "SELECT * FROM mensagem;";
        $result = mysqli_query($this->conexao->getConn(), $sql) or die ('<script>alert("Falha ao editar o registro")</script>');
        
        $dados = array();
        while ($row = $result->fetch_assoc()) {
                $dados[] = $row;
        }

        return $dados;
    }

    public function editarMsg($id, $nome, $assunto, $mensagem)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->assunto = $assunto;
        $this->mensagem = $mensagem;

        $sql = "UPDATE mensagem SET nome = '{$nome}', assunto = '{$assunto}', mensagem = '{$mensagem}' WHERE id = '{$id}';";
        $result = mysqli_query($this->conexao->getConn(), $sql);

        if ($result) {
            echo 'Editado com sucesso';
        } else {
            echo 'erro ao editar';
        }
    }

    public function excluirMsg($id)
    {
        $this->id = $id;

        $sql = "DELETE FROM mensagem WHERE id = '{$id}'";
        mysqli_query($this->conexao->getConn(), $sql) or die ('<script>alert("Falha ao excluir o registro")</script>');
    }
}