<?php

    /*
    Classe Rota
    Cria as URL's, carrega os controladores, métodos e parâmetros
    Formato da URL- /controlador/método/parâmetro
    */
    class Rota{

        private $controlador = 'Paginas';
        private $metodo = 'index';
        private $parametros = [];

        public function __construct()
        {
            // se a url existir joga a função url na variável $url
            $url = $this->url() ? $this->url() : [0];
            // Verificando se o controlador existe
            // ucwords - converte para maiúsculas o primeiro caractere de cada palavra
            if(file_exists('../app/Controllers/'.ucwords($url[0]). '.php'))
            {
                $this->controlador = ucwords($url[0]); // se existir, seta como controlador
                unset($url[0]); // destrói a variável específicada 
            }

            require_once '../app/Controllers/'.$this->controlador. '.php'; // requere o controlador
            $this->controlador = new $this->controlador; // instancia o controlador


            // Verificando de o método existe
            if(isset($url[1]))
            {
                if(method_exists($this->controlador, $url[1])) // method_exists - checa se o método da classe existe
                {
                    $this->metodo = $url[1];
                    unset($url[1]);
                }
            }

            // Se existir retorna um array com os valores, se não retorna um array vazio
            $this->parametros = $url ? array_values($url) : [];
            call_user_func_array([$this->controlador, $this->metodo], $this->parametros);
        }
        
        private function url(){
            $url = filter_input(INPUT_GET,'url',FILTER_SANITIZE_URL);
            if(isset($url)){
                
                $url = trim(rtrim($url, '/'));
                $url = explode('/', $url);

                return $url;
            }
        }
    }

        
?>