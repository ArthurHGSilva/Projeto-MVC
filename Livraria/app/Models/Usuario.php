<?php

    class Usuario{
        private $db;

        public function __construct()
        {
            $this->db = new Database();
        }

        public function checarEmail($email)
        {
            $this->db->query("SELECT email FROM usuario WHERE email = :e");

            $this->db->bind(":e", $email);

            if($this->db->resultado()){
                return true;
            }else{
                return false;
            }
        }

        public function armazenar($dados)
        {
            $this->db->query("INSERT INTO usuario(nome, email, senha) VALUES (:nome, :email, :senha)");

            $this->db->bind("nome", $dados['nome']);
            $this->db->bind("email", $dados['email']);
            $this->db->bind("senha", $dados['senha']);

            if($this->db->executa())
            {
                return true;
            }else{
                return false;
            }
        }

        public function checarLogin($email, $senha)
        {
            $this->db->query("SELECT * FROM usuario WHERE email = :e");

            $this->db->bind(":e", $email);

            if($this->db->resultado())
            {    
                $resultado = $this->db->resultado();
                if(password_verify($senha, $resultado->senha))
                {
                    return $resultado;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        public function lerUsuarios(){
            $this->db->query("SELECT * FROM usuario");
            return $this->db->resultados();

        }

        public function deletar($dados)
        {
            $this->db->query("DELETE FROM usuario WHERE id = :id");

            $this->db->bind("id", $dados['id']);

            if($this->db->executa()):
                return true;
            else:
                return false;
            endif;
        }
    }