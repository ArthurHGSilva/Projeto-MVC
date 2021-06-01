<?php
    class Paginas extends Controller{
        
        public function index()
        {
            $this -> view('paginas/home');
        }

        public function sobre()
        {
            $this -> view('paginas/sobre');
        }
    }
?>