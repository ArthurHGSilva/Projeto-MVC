<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container-fluid">
    <a class="navbar-brand" href="<?php echo URL?>">Livraria</a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
     
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        <li class="nav-item">
          <a class="nav-link active" href="<?php echo URL ?>/produtos/index">Produtos</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link active" href="<?php echo URL ?>/paginas/sobre">Sobre nós</a> 
        </li>
        
        <!---Se o usuário estiver logado, seu nome aparecerá no menu-->
        <?php if(isset($_SESSION['usuario_id'])): ?>
          <a class="nav-link active" href="<?php echo URL?>/usuarios/listar">Usuários</a>
          <a class="nav-link active" href="" style="margin-left:700px; margin-right: 10px">Bem vindo(a) <?php echo $_SESSION['usuario_nome'] ?>!</a>
          <a class="btn btn-outline-dark" href="<?php echo URL?>/usuarios/sair">Sair</a>
        
        <?php else: ?>
          <a class="btn btn-outline-dark" href="<?php echo URL?>/usuarios/login" style="margin-left:800px; margin-right: 10px">Entrar</a>
          <a class="btn btn-outline-dark" href="<?php echo URL?>/usuarios/cadastrar">Cadastrar</a>
        <?php endif; ?>

        <!-- listar usuários 
        pegar o id do Arthur e jogar no perfil para ser o admin-->
        


      </ul>
    </div>
  </div>
</nav>
