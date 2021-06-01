<div class="container py-5" style="width:40%">

    <div class="card">
        <div class="card text-white bg-dark mb-3">
            <h4 style="margin: 10px 0 -10px 100px">Conheça nossos produtos</h4>
            <br>
        </div>
        <div class="card-body">
            <?php foreach($dados['produtos'] as $produto):?>
            <strong style="margin-left:45%">Nome: </strong><p style="margin-left:45%"><?php echo $produto->titulo ?></p>
            <strong style="margin-left:45%">Valor: </strong><p style="margin-left:45%">R$</p><p style="margin-top:-8.4%; margin-left:48.8%"><?php echo $produto->preco ?></p>


            <img style="width:190px; height:220px; border-radius:10px; margin-top:-28%"src="../<?php echo $produto->arquivo?>" alt="arquivo">
            
            <!-- formulário de exclusão -->
            <form action="<?php echo URL?>/produtos/exclusao" method="POST">
                <input type="hidden" value="<?php echo $produto->id ?>" name="id">
                <input type="hidden" value="<?php echo $produto->usuario_id?>" name="usuario_id">
                <input type="hidden" value="<?php echo $produto->arquivo?>" name="arquivo">
                <div style="float:right; margin-top:-21%">
                    <button class="btn btn-danger" type="submit">Excluir</button>
                </div>
            </form>
            
            <form action="<?php echo URL.'/produtos/editar/'.$produto->id?>" method="POST">
                <input type="hidden" value="<?php echo $produto->id ?>" name="id">
                <input type="hidden" value="<?php echo $produto->usuario_id?>" name="usuario_id">
                <input type="hidden" value="<?php echo $produto->titulo?>" name="titulo">
                <input type="hidden" value="<?php echo $produto->preco?>" name="preco">
                <div style="margin-left:86%; margin-top:-30%">
                    <button class="btn btn-info" style="color:white" type="submit">Editar</button>
                </div>
            </form>
            
            
            <br><br>

            <a class="btn btn-primary" href="https://www.paypal.com/br/webapps/mpp/home?kid=p40536688811&gclid=EAIaIQobChMImeDEsdPU8AIVVgWRCh1apQhREAAYASAAEgK7YPD_BwE&gclsrc=aw.ds" style="margin-left:40%;margin-top:15%">Comprar</a>

            <hr>
            <?php endforeach?>

            <div style="margin-left:43%;">
                <a href="<?php echo URL?>/produtos/cadastrar" class="btn btn-outline-dark">Cadastrar</a>
            </div>
        </div>
    </div>
</div>
