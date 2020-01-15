<?php $comentario = $this->getComentarioByEtapaById(EXERCICIODEIMAGEM, $tableInfo['id_client']); ?>
<br>
<div class="row">
    <input type="hidden" name="id_cliente" id="id_cliente" value="<?php echo $tableInfo['id_client']; ?>">
    <input type="hidden" name="id_etapa" id="id_etapa" value="<?php echo EXERCICIODEIMAGEM; ?>">
    <div class="col-md-12">
        <div class="box box-default collapsed-box">
            <a type="button" data-widget="collapse" href="javascript(void)">
                <div class="box-header with-border">
                    <i class="fa fa-fw fa-file-picture-o"></i>
                    <h3 class="box-title" align="center">Ela é assim</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
            </a>
            <div class="box-body">
                <div class="col-md-12 col-sm-12" id="" style="display:">
                    <ul class="mailbox-attachments clearfix preview" id="previewInUsed">
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="box box-default collapsed-box">
            <a type="button" data-widget="collapse" href="javascript(void)">

                <div class="box-header with-border">
                    <i class="fa fa-fw fa-file-picture-o"></i>
                    <h3 class="box-title" align="center">Ela gostaria de ser assim</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
            </a>

            <div class="box-body">
                <div class="col-md-12 col-sm-12" id="" style="display:">
                    <ul class="mailbox-attachments clearfix preview" id="previewInLike">
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="box box-default collapsed-box">
            <a type="button" data-widget="collapse" href="javascript(void)">
                <div class="box-header with-border">
                    <i class="fa fa-fw fa-file-picture-o"></i>
                    <h3 class="box-title" align="center">Ela nunca seria assim</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
            </a>
            <div class="box-body">
                <div class="col-md-12 col-sm-12" id="" style="display:">
                    <ul class="mailbox-attachments clearfix preview" id="previewNotUsed">
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border text-center">
                <i class="fa fa-fw fa-pencil"></i>
                <h3 class="box-title">Comentarios</h3>
            </div>
            <div class="box-body">
                <div class="col-md-12 col-sm-12" id="" style="display:">
                    <textarea style="width: 100%; height: 150px; resize: none;" name="" id="comenty"><?php echo $comentario; ?></textarea>
                </div>
            </div>
            <div class="box-footer ">
                <span id="saveding" style="color:#000; display: none;"> salvando...</span>
                <span id="saved" style="color:#000; display: none;"> salvo</span>
            </div>

        </div>
    </div>

</div>

<script type="text/javascript">
    var submitButton = document.querySelector('#submit-all');
    var temporiza;

    $(document).ready(function() {

        list_image_inUsed();
        list_image_inLike();
        list_image_notUsed();

        function list_image_inUsed() {
            var type = 'inUsed';
            $('.preview').hide();
            $.ajax({
                url: BASE_URL_PAINEL + "ajax/getImagesByCliente/" + type + "/<?php echo $tableInfo['id_client']; ?>/<?php echo $nomecliente; ?>",
                success: function(data) {
                    $('#previewInUsed').show();
                    $('#previewInUsed').html(data);
                }
            });
        }

        function list_image_inLike() {
            var type = 'inLike';
            $('.preview').hide();
            $.ajax({
                url: BASE_URL_PAINEL + "ajax/getImagesByCliente/" + type + "/<?php echo $tableInfo['id_client']; ?>/<?php echo $nomecliente; ?>",
                success: function(data) {
                    $('#previewInLike').show();
                    $('#previewInLike').html(data);
                }
            });
        }

        function list_image_notUsed() {
            var type = 'notUsed';
            $('.preview').hide();
            $.ajax({
                url: BASE_URL_PAINEL + "ajax/getImagesByCliente/" + type + "/<?php echo $tableInfo['id_client']; ?>/<?php echo $nomecliente; ?>",
                success: function(data) {
                    $('#previewNotUsed').show();
                    $('#previewNotUsed').html(data);
                }
            });
        }
    });
</script>