<div class="box box-default ">
    <div class="box-header with-border">
        <h3 class="box-title">Cadastrar</h3>
    </div>

    <div class="box-body" style="">
        <form method="POST" enctype="multipart/form-data" action="<?php echo BASE_URL; ?>">
            <div class="box box-default box-solid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-header with-border">
                            <h3 class="box-title">Dados</h3>
                        </div>
                        <div class="box-body" style="">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nome da Obra</label>
                                    <input type="text" class="form-control" name="obra_nome" id="obra_nome" autocomplete="off" required>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Descrição</label>
                                    <input type="text" class="form-control" name="comercial_descricao" id="comercial_descricao" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>       

            <div class="pull-right">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</div>

<script src="<?php BASE_URL?>/views/<?php echo $viewData['pageController'];?>/parametros/<?php echo $viewData['pageController'];?>.js"></script>
