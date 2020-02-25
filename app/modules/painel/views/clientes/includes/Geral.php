<div class="row">
    <div class="col-md-3">
        <div class="box-body no-padding">
            <ul class="nav  nav-stacked">
                <li class=""><a style="cursor: pointer;" onclick="geralMode('dados')"><i class="fa fa-fw fa-user-md"></i> Dados</a></li>

                <li class="">
                    <a style="cursor: pointer;" onclick="geralMode('pagamento')"><i class="fa fa-fw fa-money"></i> Pagamento
                        <span class="label-warning fa fa-fw fa-warning yellow pull-right"></span>
                    </a>
                </li>

                <li><a style="cursor: pointer;" onclick="geralMode('permissoes')"><i class="glyphicon glyphicon-lock"></i> Permissões</a></li>
            </ul>
        </div>
    </div>

    <!-- Dados -->
    <div class="col-md-9" id="dados" style="display:none">
        <div class="box box-default box-solid">
            <div class="row">
                <div class="col-md-12">
                    <div class="box-header with-border">
                        <h3 class="box-title">Estou pensando o que vai ter aqui *</h3>
                    </div>
                    <div class="box-body" style="">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Tipo de Conta</label>
                                <input type="" class="form-control" name="tipo_conta" id="tipo_conta" value="<?php echo $tableInfo['usr_info']; ?>">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Status</label>
                                <input type="" class="form-control" name="status" id="status" value="<?php echo $tableInfo['usu_ativo'] == 1 ? 'ativado' : 'destativado' ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagamento -->
    <div class="col-md-9" id="pagamento" style="display:none">
        <div class="box box-default box-solid">
            <div class="row">
                <div class="col-md-12">
                    <div class="box-header with-border">
                        <h3 class="box-title">Estou pensando em como salvar ainda *</h3>
                    </div>
                    <div class="box-body" style="">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Formas de Pagamento</label>
                                <input type="text" class="form-control" name="formas_pagamento" id="formas_pagamento">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Valor Bruto</label>
                                <input type="text" class="form-control" name="valor_bruto" id="valor_bruto" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Desconto</label>
                                <input type="text" class="form-control" name="desconto" id="desconto" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Valor Liquido</label>
                                <input type="text" readonly="" class="form-control" name="valor_liquido" id="valor_liquido" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Permissoes -->
    <div class="col-md-9" id="permissoes" style="display:none">
        <div class="box box-default box-solid">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <form method="POST" id="permissions_client" action="<?php echo BASE_URL_PAINEL; ?>clientes/actionPermissions">
                            <input type="hidden" class="form-control" name="id_cliente" id="id_cliente" autocomplete="off" value="<?php echo $tableInfo['id_client']; ?>">
                            <div class="box-header ui-sortable-handle">
                                <i class="ion ion-clipboard"></i>
                                <h3 class="box-title">Permissões</h3>
                                <div class="btn-group pull-right">
                                    <button type="button" class="btn btn-box-tool dropdown-toggle " data-toggle="dropdown" aria-expanded="true">
                                        <i class="fa fa-wrench"></i>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a id="marcarTodos">Marcar todos</a></li>
                                        <li><a id="desmarcarTodos">Desmarcar Todos</a></li>

                                    </ul>
                                </div>
                            </div>

                            <div class="box-body">
                                <ul class="todo-list ui-sortable">
                                    <?php foreach ($permissons_all as $pma) : ?>
                                        <li>
                                            <input type="checkbox" name="permissions[]" <?php echo ($this->user->hasPermissionByidSearch($pma['name'], '', $tableInfo['id_company'], $tableInfo['id_client']) ? "checked" : ""); ?> class="check" value="<?php echo $pma['id']; ?>">
                                            <span class="text"><?php echo $pma['name']; ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="box-footer clearfix no-border">
                                <div id="submit_permission" class="btn btn-primary pull-right">Salvar</div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    function geralMode(tela) {
        switch (tela) {
            case 'dados':
                $('#' + tela).slideToggle("slow");
                $('#permissoes').hide();
                $('#pagamento').hide();
                break;
            case 'permissoes':
                $('#' + tela).slideToggle("slow");
                $('#dados').hide();
                $('#pagamento').hide();
                break;
            case 'pagamento':
                $('#' + tela).slideToggle("slow");
                $('#dados').hide();
                $('#permissoes').hide();
                break;
        }
    }
</script>