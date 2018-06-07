<?php 

class UserDAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = new Connect();
    }

    public function logar($email, $senha)
    {
        $sql = "SELECT * FROM usuario WHERE email = " .$email. "AND senha = " .$senha. ";";
        $executa = mysqli_query($this->conexao->getConn(), $sql);
        
        if (mysqli_num_rows($executa) > 0) {
            return true;
        } else {
            return false;
        }
    }
}