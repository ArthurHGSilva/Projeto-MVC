<div class="container py-5">

    <div class="card">
        <div class="card text-white bg-dark mb-3">
            <h4 style="margin: 10px 0 -10px 410px">Usuários do sistema</h4>
            <br>
        </div>
        <div class="card-body">
        <?php foreach($dados['usuarios'] as $usuario):?>
            <strong>Nome: </strong><p><?php echo $usuario->nome ?></p>
            <strong>Email: </strong><p><?php echo $usuario->email ?></p>
            <div style="float:right; margin-top:-5%">
               
                <form action="<?php echo URL?>/usuarios/apagar" method="POST">
                    <input type="hidden" value="<?php echo $usuario->id ?>" name="id">
                    <button class="btn btn-danger" type="submit">Excluir</button>
                </form>

            </div>
            <hr>
            <?php endforeach?>
        </div>
    </div>
</div>
