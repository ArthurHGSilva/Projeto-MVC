<?php

    class Usuarios extends Controller
    {
        public function __construct()
        {
            $this->usuarioModel = $this->model('Usuario');
        }

        public function index()
        {
            $dados = [
                'usuarios' => $this->usuarioModel->lerUsuarios()
            ];
            $this->view('usuarios/listar', $dados);
        }

        public function cadastrar()
        {   
            
            $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); //evita códigos malíciosos

            
            
            if(isset($formulario))
            {
                $dados = [
                    'nome' => trim($formulario['nome']),
                    'email' => trim($formulario['email']),
                    'senha' => trim($formulario['senha']),
                    'confirma_senha' => trim($formulario['confirma_senha']),
                    'nome_erro' => '',
                    'email_erro' => '',
                    'senha_erro' => '',
                    'confirma_erro' => '',
                    
                ];

                if(in_array("", $formulario)) // se os campos estiverem em branco, as mensagens de erro aparecerão
                {
                    if(empty($formulario['nome'])){
                        $dados['nome_erro'] = 'Preencha o campo nome';
                    }
    
                    if(empty($formulario['email'])){
                        $dados['email_erro'] = 'Preencha o campo email';
                    }
    
                    if(empty($formulario['senha'])){
                        $dados['senha_erro'] = 'Preencha o campo senha';
                    }
    
                    if(empty($formulario['confirma_senha'])){
                        $dados['confirma_erro'] = 'Confirme a senha';
                    }
                }else{ // se os campos estiverem preenchidos, serão feitas novas verificações
                    if(!preg_match('/^([áÁàÀãÃâÂéÉèÈêÊíÍìÌóÓòÒõÕôÔúÚùÙçÇaA-zZ]+)+((\s[áÁàÀãÃâÂéÉèÈêÊíÍìÌóÓòÒõÕôÔúÚùÙçÇaA-zZ]+)+)?$/', $formulario['nome'])):
                        $dados['nome_erro'] = 'O nome é inválido';

                    elseif($formulario['senha'] != $formulario['confirma_senha']):
                        $dados['confirma_erro'] = 'As senhas são diferentes';

                    elseif(!filter_var($formulario['email'], FILTER_VALIDATE_EMAIL)):
                        $dados['email_erro'] = 'O email informado é inválido';

                    elseif($this->usuarioModel->checarEmail($formulario['email'])):
                        $dados['email_erro'] = 'O email informado já existe';
                    
                    else:
                        // se os campos estiverem corretos, um hash seguro de senha será gerado
                        $dados['senha'] = password_hash($formulario['senha'], PASSWORD_DEFAULT); 

                        if($this->usuarioModel->armazenar($dados))
                        {
                            header('location: '.URL.'/usuarios/login');
                        }else{
                            die("Erro ao armazenar o usuário no banco de dados");
                        }
    
                    endif;
                }      

            }else{ 
                $dados = [
                    'nome' => '',
                    'email' => '',
                    'senha' => '',
                    'confirma_senha' => '',
                    'nome_erro' => '',
                    'email_erro' => '',
                    'senha_erro' => '',
                    'confirma_erro' => ''
                ];
            }

            $this->view('usuarios/cadastrar', $dados);
        }


        // função de login
        public function login()
        {   
            
            $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); //evita códigos malíciosos


            if(isset($formulario))
            {
                $dados = [// dados enviados pelo formulário de login
                    'email' => trim($formulario['email']),
                    'senha' => trim($formulario['senha']),
                    'email_erro' => '',
                    'senha_erro' => '',
                    
                ];

                if(in_array("", $formulario)) // se os campos estiverem em branco, as mensagens de erro aparecerão
                {
    
                    if(empty($formulario['email'])){
                        $dados['email_erro'] = 'Preencha o campo email';
                    }
    
                    if(empty($formulario['senha'])){
                        $dados['senha_erro'] = 'Preencha o campo senha';
                    }

                }else{ // se os campos estiverem preenchidos, serão feitas novas verificações
                    if(!filter_var($formulario['email'], FILTER_VALIDATE_EMAIL)):
                        $dados['email_erro'] = 'O email informado é inválido';
                    
                    else:
                        // vai checar o login do usuário
                        $usuario = $this->usuarioModel->checarLogin($formulario['email'], $formulario['senha']);

                        if($usuario)://recupera os dados do usuário
                            $this->criarSessaoUsuario($usuario);
                            header('location: '.URL.'');
                        else:

                        endif;
                    endif;
                }
                

            }else{ 
                $dados = [
                    'email' => '',
                    'senha' => '',
                    'email_erro' => '',
                    'senha_erro' => '',
                ];
            }

            $this->view('usuarios/login', $dados);
        }

        // cria a sessão e guarda todos os dados do usuário logado
        private function criarSessaoUsuario($usuario)
        {
            $_SESSION['usuario_id'] = $usuario->id;
            $_SESSION['usuario_nome'] = $usuario->nome;
            $_SESSION['usuario_email'] = $usuario->email;
            $_SESSION['usuario_permissao'] = $usuario->permissao;
        }

        // destrói a sessão
        public function sair()
        {
            unset($_SESSION['usuario_id']);
            unset($_SESSION['usuario_nome']);
            unset($_SESSION['usuario_email']);
            unset($_SESSION['usuario_permissao']);

            session_destroy();

            header('location: '.URL.'');
        }

        // função para deletar um usuário
        public function apagar()
        {
            $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 

            if(isset($formulario))
            {
                $dados = [
                    'id' => trim($formulario['id']),
                ];

                if($_SESSION['usuario_permissao'] == '1')// o único usuário que a permissão para apagar é o admin
                {
                    if($this->usuarioModel->deletar($dados))
                    {
                        header('location: '.URL.'/usuarios/listar');
                    }else{
                        die();
                    }
                }else{
                    header('location: '.URL.'/usuarios/listar');
                }
            }    
        }
    }