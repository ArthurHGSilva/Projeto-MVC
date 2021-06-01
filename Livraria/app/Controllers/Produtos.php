<?php

    class Produtos extends Controller
    {
        public function __construct()
        {
            if(!isset($_SESSION['usuario_id']))
            {
                header('location: '.URL.'/usuarios/login');
            }
            $this->produtoModel = $this->model('Produto');
        }

        //função para excluir os produtos
        public function exclusao()
        {
            $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 
            
            if(isset($formulario))
            {
                $dados = [
                    'id' => trim($formulario['id']),
                    'usuario_id' => trim($formulario['usuario_id']),
                    'arquivo' => trim($formulario['arquivo'])
                ];
                
                if($_SESSION['usuario_id'] == $dados['usuario_id'])
                {
                    if($this->produtoModel->excluir($dados))
                    {
                        header('location: '.URL.'/produtos/index');
                    }else{
                        die();
                    }
                }else{
                    header('location: '.URL.'/produtos/index');
                }
                    
            }
        }


        // função para listar os produtos
        public function index()
        {
            $dados = [
                'produtos' => $this->produtoModel->lerProdutos(),
            ];

            $this->view('produtos/index', $dados);
        }


        //função para cadastrar os produtos
        public function cadastrar()
        {   
            
            $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); //evita códigos malíciosos

            if(isset($formulario))
            {
                // receber o arquivo enviado e armazenar dentro da pasta, além de alterar o nome do aquivo
                $ext = strtolower(substr($_FILES['arquivo']['name'], -4));
                    $rename = md5(time()).$ext;
                    $pasta = "../public/img2/";
                    move_uploaded_file($_FILES['arquivo']['tmp_name'], $pasta.$rename);
                    $newName = 'img2/'.$rename;

                $dados = [
                    'titulo' => trim($formulario['titulo']),
                    'preco' => trim($formulario['preco']),
                    'usuario_id' => $_SESSION['usuario_id'],
                    'arquivo' => $newName,
                    'titulo_erro' => '',
                    'preco_erro' => '',
                    'arquivo_erro' => '',
                    
                ];

                if(in_array("", $formulario)) // se os campos estiverem em branco, as mensagens de erro aparecerão
                {
                    if(empty($formulario['titulo'])){ // se o valor do título for nulo
                        $dados['titulo_erro'] = 'Preencha o campo título';
                    }
    
                    if(empty($formulario['preco'])){ // se o valor do preço for nulo
                        $dados['preco_erro'] = 'Preencha o campo preço';
                    }

                    if(empty($formulario['arquivo'])){ // se o valor do arquivo for nulo
                        $dados['arquivo_erro'] = 'Nenhum arquivo selecionado';
                    }

                }else{//se os campos estiverem preenchidos, os dados serão armazenados
                    if($this->produtoModel->armazenar($dados))
                    {
                        header('location: '.URL.'/produtos/index');
                    }else{
                        die("Erro ao armazenar o produto no banco de dados");
                    }
                }
                
            }else{ 
                $dados = [
                    'id' => '',
                    'titulo' => '',
                    'preco' => '', 
                    'titulo_erro' => '',
                    'preco_erro' => '',
                    'arquivo_erro' => ''
                ];
            }


            $this->view('produtos/cadastrar', $dados);
        }


        //função para redirecionar para página de edição
        public function editar()
        {
            $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            if(isset($formulario))
            {
                $dados = [//recupera os dados do formulário
                    'id' => trim($formulario['id']),
                    'titulo' => trim($formulario['titulo']),
                    'preco' => trim($formulario['preco']),
                    'usuario_id' => trim($formulario['usuario_id']),
                    'titulo_erro' => '',
                    'preco_erro' => '',
                    
                ];

            }else{ 
                $dados = [
                    'id' => '',
                    'titulo' => '',
                    'preco' => '', 
                    'titulo_erro' => '',
                    'preco_erro' => '',
                    'usuario_id' => '',
                ];
            }
            if($_SESSION['usuario_id'] == $dados['usuario_id']){
                $this -> view('produtos/editar', $dados);
            }else{
                header('location: '.URL.'/produtos/index');
            }
            
        }

        // função para editar os produtos
        public function update()
        {   
            
            $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); //evita códigos malíciosos
            
            if(isset($formulario))
            {
                $dados = [
                    'id' => trim($formulario['id']),
                    'titulo' => trim($formulario['titulo']),
                    'preco' => trim($formulario['preco']),
                    'usuario_id' => $_SESSION['usuario_id'],
                    'titulo_erro' => '',
                    'preco_erro' => '',
                    
                ];

                if(in_array("", $formulario)) // se os campos estiverem em branco, as mensagens de erro aparecerão
                {
                    if(empty($formulario['titulo'])){
                        $dados['titulo_erro'] = 'Preencha o campo título';
                    }
    
                    if(empty($formulario['preco'])){
                        $dados['preco_erro'] = 'Preencha o campo preço';
                    }

                }else{
                    if($_SESSION['usuario_id'] == $dados['usuario_id'])
                    {
                        if($this->produtoModel->atualizar($dados))
                        {
                            header('location: '.URL.'/produtos/index');
                        }else{
                            die("Erro ao armazenar o produto no banco de dados");
                        }
                    }else{
                        header('location: '.URL.'/produtos/index');
                    }  
                }
                
            }else{ 
                $dados = [
                    'id' => '',
                    'titulo' => '',
                    'preco' => '', 
                    'titulo_erro' => '',
                    'preco_erro' => '',
                ];
            }

            $this->view('produtos/index', $dados);
        
        }
           
    }