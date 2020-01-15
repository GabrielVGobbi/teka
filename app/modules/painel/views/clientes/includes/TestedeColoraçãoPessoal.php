<?php
$array = array(
    'Contraste' => [
        'Baixo Claro/Escuro',
        'Baixo Claro/Escuro para Médio',
        'Médio',
        'Médio/Alto',
        'Alto',
    ],
    'Dimensoes_da_Cor' => [
        'Temperatura' => [
            'Quente',
            'Frio'
        ],
        'Intensidade' => [
            'Suave/Opaca',
            'Brilhante/Vivo'
        ],
        'Profundidade' => [
            'Claro',
            'Escuro'
        ]
    ]
);
$coloracao = $this->cliente->getColoracaoByClient($tableInfo['id_client']);
if ($coloracao) {

    $id_coloracao = $coloracao['id_coloracao'];
    $contraste    = $coloracao['col_contraste'];
    $temperatura  = $coloracao['col_temperatura'];
    $intensidade  = $coloracao['col_intensidade'];
    $profundidade  = $coloracao['col_profundidade'];
    $id_cartela  = $coloracao['id_cartela'];
    $cartela_imagem = $coloracao['car_img'];

}

?>
<br>
<div class="row">
    <form id="coloracao_client" action="<?php echo BASE_URL_PAINEL; ?>clientes/ColoracaoByClient/<?php echo $tableInfo['id_client']; ?>" method="POST">
        <input type="hidden" name="id_coloracao" name="id_coloracao" value="<?php echo (!empty($id_coloracao) ? $id_coloracao : ''); ?>"/>
        <div class="col-md-4">
            <div class="box box-default">
                <div class="box-header with-border">
                    <i class="fa fa-fw fa-certificate"></i>
                    <h3 class="box-title">Contraste</h3>
                </div>
                <div class="box-body">
                    <?php foreach ($array['Contraste'] as $con => $value) :  ?>
                        <div class="col-lg-12 margin ">
                            <div class="input-group <?php echo (isset($contraste) && $contraste == $value  ? ' has-success' : ''); ?>">
                                <span class="input-group-addon">
                                    <input type="radio" name="Contraste" <?php echo (isset($contraste) && $contraste == $value  ? 'checked' : ''); ?> id="Contraste<?php echo $con; ?>" value="<?php echo $value; ?>">
                                </span>
                                <span type="text" class="form-control"> <?php echo $value; ?> </span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="box box-default">
                <div class="box-header with-border">
                    <i class="fa fa-fw fa-certificate"></i>
                    <h3 class="box-title">Dimensões da Cor</h3>
                </div>
                <div class="box-body">
                    <?php foreach ($array['Dimensoes_da_Cor'] as $con => $value) :  ?>
                        <?php
                        if($coloracao)
                            switch ($con) {
                                case 'Temperatura':
                                    $tipo = $temperatura;
                                    break;
                                case 'Intensidade':
                                    $tipo = $intensidade;
                                    break;
                                case 'Profundidade':
                                    $tipo = $profundidade;
                                    break;
                            }

                        ?>
                        <div class="row " style="margin-bottom: 15px;">
                            <div class="col-lg-12">
                                <label><?php echo $con; ?></label>
                            </div>
                            <div class="form-group">
                                <?php foreach ($value as $val => $valor) : ?>
                                    <div class="col-lg-6 ">
                                        <div class="input-group <?php echo (isset($tipo) && $tipo == $valor  ? ' has-success' : ''); ?>">
                                            <span class="input-group-addon">
                                                <input type="radio" <?php echo (isset($tipo) && $tipo == $valor  ? 'checked' : ''); ?> name="<?php echo $con; ?>" id="<?php echo $con; ?><?php echo $val; ?>" value="<?php echo $valor; ?>">
                                            </span>
                                            <span type="text" class="form-control"> <?php echo $valor; ?> </span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
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
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Cartela</label>
                            <select class="form-control select2" style="width: 100%;" name="cartela" id="id_cartela" aria-hidden="true" required>
                                <option value="">Selecione</option>
                                <?php foreach ($paleta as $pl) : ?>
                                    <option <?php echo (isset($id_cartela) && $id_cartela == $pl['id_cartela']  ? 'selected' : ''); ?> value="<?php echo $pl['id_cartela']; ?>"><?php echo $pl['car_nome'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="text-center">
                        <img style="width: 51%" src="<?php echo (isset($cartela_imagem) && !empty($cartela_imagem)  ? $cartela_imagem : 'https://www.joinvillevagas.com.br/wp-content/uploads/2018/10/sem-foto.gif'); ?>">
                    </div>
                </div>
            </div>
            <div class="box-footer clearfix no-border">
                <div id="submit_coloracao" class="btn btn-primary pull-right">Salvar</div>
            </div>
        </div>
    </form>
</div>

<script>
    $(function() {
        $("#submit_coloracao").click(function() {
            $("#coloracao_client").submit();
        });
    });
</script>