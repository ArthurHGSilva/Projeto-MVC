<div class="col-xl-4 col-md-6 mx-auto p-5">
    <div class="card">
        <div class="card-body">

            <h2 style="font-size:20px">Login</h2>
            
            <form name="Login" method="POST" action="<?php echo URL?>/usuarios/login" class="mt-4">
                
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" name="email" id="email" value="<?php echo $dados['email']?>" class="form-control <?= $dados['email_erro'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= $dados['email_erro']?> 
                    </div>
                </div>

                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" name="senha" id="senha" value="<?php echo $dados['senha']?>" class="form-control <?= $dados['senha_erro'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= $dados['senha_erro']?> 
                    </div>
                </div>


                <br>
                
                <div class="row">
                    <div class="col">
                        <input type="submit" value="Login" class="btn btn-primary" style="padding: 10px 50px">
                    </div>

                    <div class="col">
                        <a href="<?php echo URL?>/usuarios/cadastrar">Não tem uma conta? Cadastre-se</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

