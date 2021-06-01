<?php

    class Produto{
        private $db;

        public function __construct()
        {
            $this->db = new Database();
        }

        // irá ler todos os produtos gravados no banco de dados
        public function lerProdutos(){
            $this->db->query("SELECT * FROM produtos");
            return $this->db->resultados();

        }

        // função para armazenar os produtos no banco de dados
        public function armazenar($dados)
        {
            $this->db->query("INSERT INTO produtos(titulo, preco, usuario_id, arquivo) VALUES (:titulo, :preco, :usuario_id, :arquivo)");

            $this->db->bind("titulo", $dados['titulo']);
            $this->db->bind("preco", $dados['preco']);
            $this->db->bind("usuario_id", $dados['usuario_id']);
            $this->db->bind("arquivo", $dados['arquivo']);

            if($this->db->executa())
            {
                return true;
            }else{
                return false;
            }
        }

        // função para excluir os produtos do banco de dados
        public function excluir($dados)
        {   
            $this->db->query("DELETE FROM produtos WHERE id = :id");

            $this->db->bind("id", $dados['id']);
            
            if($this->db->executa())
            {
                unlink($dados['arquivo']); // deletar a imagem da pasta
                return true;
            }else{
                return false;
            }
        }

        /*
        public function lerProdutoPorId($id){
            $this->db->query("SELECT * FROM produtos WHERE id = :id");

            $this->db->bind('id', $id);

            return $this->db->resultado();
        }
        */


        // função de alterar os dados dos produtos no banco de dados
        public function atualizar($dados)
        {
            $this->db->query("UPDATE produtos SET titulo = :titulo, preco = :preco WHERE id = :id");

            $this->db->bind("titulo", $dados['titulo']);
            $this->db->bind("preco", $dados['preco']);
            $this->db->bind("id", $dados['id']);

            if($this->db->executa()):
                return true;
            else:
                return false;
            endif;
        }
    }