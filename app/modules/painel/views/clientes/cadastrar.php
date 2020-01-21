<div class="col-md-12">
    <div class="nav-tabs-custom">
        <form method="POST" id="cliete_edit" enctype="multipart/form-data" action="<?php echo BASE_URL_PAINEL; ?>clientes/action">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_dados" data-toggle="tab">Dados</a></li>
                <!--<li class=""><a href="#tab_dados" data-toggle="tab">Geral</a></li> -->
                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_dados">
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="btn btn-file text-center" style="display: block;">
                                <img class="profile-user-img img-responsive" name="preview" src="https://www.bluempregos.com.br/wp-content/uploads/2018/10/sem-foto.gif" alt="foto">
                                <input type="file" onchange="previewImagem()" id="imagem" name="fotos" multiple="">
                            </div>
                            <h3 class="profile-username text-center"></h3>
                            <p class="text-muted text-center"></p>
                            <div class="text-center">
                                <img style="max-height: 110px;min-height: 110px;">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div id="formnome" class="form-group">
                                <label>Nome</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-fw fa-user"></i>
                                    </div>
                                    <input type="text" data-name="" class="form-control" name="cli_nome" id="cli_nome" value="">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div id="formnome" class="form-group">
                                <label>Sobrenome</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-fw fa-user"></i>
                                    </div>
                                    <input type="text" class="form-control" name="cli_sobrenome" id="cli_sobrenome">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div id="foremail" class="form-group">
                                <label>Email</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <input type="text" class="form-control" name="cli_email" id="cli_email">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div id="" class="form-group">
                                <label>Data de nascimento</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <input type="text" class="form-control" name="cli_aniversario" id="cli_aniversario" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div id="" class="form-group">
                                <label>Telefone</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <input type="text" class="form-control" name="cli_telefone" id="cli_telefone" data-inputmask='"mask": "(11) 99999-9999"' data-mask>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div id="" class="form-group">
                                <label>Profissão</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-fw fa-user-secret"></i>
                                    </div>
                                    <input type="text" class="form-control" name="cli_profissao" id="cli_profissao">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div id="" class="form-group">
                                <label>Definir Senha</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-fw fa-lock"></i>
                                    </div>
                                    <input type="password" class="form-control" name="password" id="password">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="box box-default box-solid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Endereço</h3>
                                        </div>
                                        <div class="box-body" style="">
                                            <div class="col-md-2">
                                                <div class="form-group" id="forcep">
                                                    <label>CEP</label>
                                                    <input type="text" class="form-control" name="cep" id="cep" value="" size="10" maxlength="9" onblur="pesquisacep(this.value);" data-inputmask="'mask': ['99999-999']" data-mask>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Rua</label>
                                                    <input type="text" class="form-control" readonly name="rua" id="rua" value="">
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Nº</label>
                                                    <input type="text" class="form-control" name="numero" id="numero" value="">
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Complemento</label>
                                                    <input type="text" class="form-control" name="complemento" id="complemento" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <label class="popver_urgencia" style="margin-right: 17px;">
                        <input type="checkbox" class="checkbox_desgn" name="notifyEmail" value="true">
                        <span>
                            <span class="icon unchecked">
                                <span class="mdi mdi-check"></span>
                            </span>
                            Enviar Aviso por Email
                        </span>
                    </label>
                    <div id="submit" class="btn btn-primary">Salvar</div>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="<?php echo BASE_URL; ?>app/assets/js/parametros/<?php echo $viewData['pageController']; ?>.js"></script>