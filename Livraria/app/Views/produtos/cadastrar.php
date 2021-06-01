<div class="col-xl-4 col-md-6 mx-auto p-5">
    <div class="card">
        <div class="card-body">

            <h2 style="font-size:20px">Cadastrar produtos</h2>
            
            <form name="Login" method="POST" action="<?php echo URL?>/produtos/cadastrar" class="mt-4" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label for="titulo">Titulo:</label>
                    <input type="text" name="titulo" id="titulo" value="<?php echo $dados['titulo']?>" class="form-control <?= $dados['titulo_erro'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= $dados['titulo_erro']?> 
                    </div>
                </div>

                <div class="form-group">
                    <label for="preco">Preco:</label>
                    <input type="text" name="preco" id="preco" value="<?php echo $dados['preco']?>" class="form-control <?= $dados['preco_erro'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= $dados['preco_erro']?> 
                    </div>
                </div>

                <br>

                <input type="file" name="arquivo" id="arquivo"  value="" class="form-control<?= $dados['arquivo_erro'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= $dados['arquivo_erro']?> 
                    </div>

                <br>

                <div class="row">
                    <div class="col">
                        <input type="submit" value="Cadastrar" class="btn btn-primary" style="padding: 10px 50px">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

