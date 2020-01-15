<?php $coloracao = $this->cliente->getColoracaoByClient($tableInfo['id_client']); ?>
<br>
<?php if ($coloracao) : ?>
    <?php
    $id_coloracao = $coloracao['id_coloracao'];
    $contraste    = $coloracao['col_contraste'];
    $temperatura  = $coloracao['col_temperatura'];
    $intensidade  = $coloracao['col_intensidade'];
    $profundidade  = $coloracao['col_profundidade'];
    $id_cartela  = $coloracao['id_cartela'];
    $cartela_imagem = $coloracao['car_img'];
    $cartela_nome = $coloracao['car_nome'];
    ?>
    <div class="row">
        <div class="col-md-4">
            <div class="box box-default">
                <div class="box-header with-border">
                    <i class="fa fa-fw fa-certificate"></i>
                    <h3 class="box-title">Dimensões da Cor</h3>
                </div>
                <div class="box-body">
                    <div class="row " style="margin-bottom: 15px;">
                        <div class="col-lg-12">
                            <label>Temperatura</label>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 ">
                                <span type="text" class="form-control"> <?php echo $temperatura; ?> </span>
                            </div>
                        </div>
                    </div>
                    <div class="row " style="margin-bottom: 15px;">
                        <div class="col-lg-12">
                            <label>Intensidade</label>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 ">
                                <span type="text" class="form-control"> <?php echo $intensidade; ?> </span>
                            </div>
                        </div>
                    </div>

                    <div class="row " style="margin-bottom: 15px;">
                        <div class="col-lg-12">
                            <label>Profundidade</label>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 ">
                                <span type="text" class="form-control"> <?php echo $profundidade; ?> </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-default">
                <div class="box-header with-border">
                    <i class="fa fa-fw fa-certificate"></i>
                    <h3 class="box-title">Contraste</h3>
                </div>
                <div class="box-body">

                    <div class="col-md-12 ">
                        <span type="text" class="form-control"><?php echo $contraste; ?> </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-default">
                <div class="box-header with-border">
                    <i class="fa fa-fw fa-certificate"></i>
                    <h3 class="box-title">Cartela</h3>
                </div>
                <div class="box-body">
                    <div class="col-md-12 ">
                        <span type="text" class="form-control"><?php echo $cartela_nome; ?> </span>
                    </div>
                    <div class="text-center" style="margin-top: 54px;">
                        <img style="width: 51%" src="<?php echo (isset($cartela_imagem) && !empty($cartela_imagem)  ? $cartela_imagem : 'https://www.joinvillevagas.com.br/wp-content/uploads/2018/10/sem-foto.gif'); ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="box-header with-border text-center">
        <i class="fa fa-fw fa-certificate"></i>
        <h3 class="box-title">Em andamento... </h3>
    </div>
    <br>
<?php endif; ?>