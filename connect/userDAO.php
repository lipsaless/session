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
        $senha = md5($senha);

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
        if (empty($senha)) {
            echo json_encode(['type' => 'error', 'msg' => 'Senha em branco']);
            exit;
        }

        $this->nome = $nome;
        $this->email = $email;
        $this->senha = md5($senha);

        $existeEmail = "SELECT * FROM usuario WHERE email = '{$this->email}';";
        $query = mysqli_query($this->conexao->getConn(), $existeEmail);
        $existe = mysqli_fetch_assoc($query);

        if ($existe) {
            echo json_encode(['type' => 'error', 'msg' => 'Usuário já está cadastrado']);
            exit;
        }

        $sql = "INSERT INTO usuario (nome, email, senha) VALUES ('{$this->nome}','{$this->email}','{$this->senha}');";
        $result = mysqli_query($this->conexao->getConn(), $sql);
        
        if ($result) {
            echo json_encode(['type' => 'success', 'msg' => 'Usuário inserido com sucesso']);
            exit;
        } else {
            echo json_encode(['type' => 'error', 'msg' => 'Erro ao inserir usuário']);
            exit;
        }
    }

    public function editarUser($id, $nome, $email, $senha, $senhaAntiga)
    {
        if (!$senha) {
            $senha = $senhaAntiga;
        } else {
            $senha = md5($senha);
        }

        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;

        $sql = "UPDATE usuario SET nome = '{$this->nome}', email = '{$this->email}', senha = '{$this->senha}' WHERE id = '{$this->id}';";
        $result = mysqli_query($this->conexao->getConn(), $sql);

        if ($result) {
            echo json_encode(['type' => 'success', 'senha' => $senha, 'msg' => 'Dados atualizados com sucesso. Clique em sair e logue novamente para que os dados possam fazer efeito.']);
            exit;
        } else {
            echo json_encode(['type' => 'error', 'msg' => 'Erro ao tentar alterar dados']);
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
            echo json_encode(['type' => 'success', 'msg' => 'Mensagem inserida com sucesso']);
            exit;
        } else {
            echo json_encode(['type' => 'error', 'msg' => 'Erro ao tentar inserir mensagem']);
            exit;
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

        $sql = "UPDATE mensagem SET nome = '{$this->nome}', assunto = '{$this->assunto}', mensagem = '{$this->mensagem}' WHERE id = '{$this->id}';";
        $result = mysqli_query($this->conexao->getConn(), $sql);

        if ($result) {
            echo json_encode(['type' => 'success', 'msg' => 'Editado com sucesso']);
            exit;
        } else {
            echo json_encode(['type' => 'error', 'msg' => 'Erro ao tentar editar cadastro']);
            exit;
        }
    }

    public function excluirMsg($id)
    {
        $this->id = $id;

        $sql = "DELETE FROM mensagem WHERE id = '{$id}';";
        $result = mysqli_query($this->conexao->getConn(), $sql) or die ('<script>alert("Falha ao excluir o registro")</script>');

        if ($result) {
            echo json_encode(['type' => 'success', 'msg' => 'Excluído com sucesso']);
            exit;
        } else {
            echo json_encode(['type' => 'error', 'msg' => 'Erro ao tentar excluir cadastro']);
            exit;
        }
    }
}