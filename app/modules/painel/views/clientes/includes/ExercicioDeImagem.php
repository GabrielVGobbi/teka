<?php $comentario = $this->getComentarioByEtapaById(EXERCICIODEIMAGEM, $tableInfo['id_client']); ?>
<br>
<div class="row">
	<input type="hidden" name="id_cliente" id="id_cliente" value="<?php echo $tableInfo['id_client']; ?>">
	<input type="hidden" name="id_etapa" id="id_etapa" value="<?php echo EXERCICIODEIMAGEM; ?>">
	<div align="center">
		<a class="btn btn-app" onclick="openPhoto(this)" id="inLike">
			<i class="fa fa-heart-o"></i> Eu Gostaria de ser assim
		</a>
		<a class="btn btn-app" onclick="openPhoto(this)" id="notUsed" style="width: 12%">
			<i class="fa  fa-close"></i> Nunca seria assim
		</a>
		<a class="btn btn-app" onclick="openPhoto(this)" id="inUsed" style="width: 12%">
			<i class="fa  fa-user"></i> Eu sou assim
		</a>
	</div>

	<div style="display:none" class="col-md-12" id="photo">
		<div class="box box-solid">
			<div class="box-header with-border">
				<i class="fa fa-fw fa-file-picture-o"></i>

				<h3 class="box-title box-title-dropzone"></h3>
			</div>
			<div class="box-body">
				<div>
					<div action="" class="dropzone" style="display:none" id="myDropinUsed"></div>
					<div action="" class="dropzone" style="display:none" id="myDropinLike"></div>
					<div action="" class="dropzone" style="display:none" id="myDropnotUsed"></div>

					<br>
					<span class="title-max-foto"></span>

					<div align="center">
						<button type="submit" class="btn btn-info" id="submit-all" style="display:none">Enviar</button>
					</div>
				</div>
				<div class="col-md-12 col-sm-12" id="">
					<ul class="mailbox-attachments clearfix" style="display:none" id="previewinUsed">
					</ul>

					<ul class="mailbox-attachments clearfix" style="display:none" id="previewinLike">
					</ul>

					<ul class="mailbox-attachments clearfix" style="display:none" id="previewnotUsed">
					</ul>
				</div>
			</div>
		</div>
	</div>

	<br>
	<br>

	<div class="col-md-12">
		<div class="box box-solid">
			<div class="box-header with-border text-center">
				<i class="fa fa-fw fa-pencil"></i>
				<h3 class="box-title">Comentarios</h3>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-12" id="" style="display:">
						<textarea style="width: 100%; height: 150px; resize: none;" placeholder="É aqui que fazemos o Exercicio de imagem, Você bota 5.... (explicação)" name="" id="comenty" rows="10"><?php echo $comentario; ?></textarea>
					</div>
				</div>
			</div>
			<div class="box-footer ">
				<span id="saveding" style="color:#000; display: none;"> salvando...</span>
				<span id="saved" style="color:#000; display: none;"> salvo</span>
			</div>

		</div>
	</div>



	<script type="text/javascript">
		Dropzone.autoDiscover = false;
		Dropzone.options.myAwesomeDropzone = false
		var submitButton = document.querySelector('#submit-all');

		function openPhoto(v) {
			Dropzone.autoDiscover = false;
			Dropzone.options.myAwesomeDropzone = false
			var type = '';
			switch (v.id) {
				case 'inUsed':
					type = "Eu sou assim"
					maxFoto = ""
					break;
				case 'notUsed':
					type = "Eu nunca seria assim"
					maxFoto = "Max foto: 5"
					break;
				case 'inLike':
					type = "Eu gostaria de ser assim"
					maxFoto = "Max foto: 5"
					break;
			}
			$("#photo").show();
			$(".box-title-dropzone").html(type);
			$(".title-max-foto").html(maxFoto);


			$('.dropzone').hide();
			list_image(v.id);
			list_dropzone(v.id);

		}

		function list_dropzone(type) {
			Dropzone.options.myAwesomeDropzone = false
			Dropzone.autoDiscover = false;

			$('#myDrop' + type).show();

			var myDropzone = new Dropzone("div#myDrop" + type, {
				url: BASE_URL_PAINEL + "ajax/addPhotoClient/" + type + "/<?php echo $tableInfo['id_client']; ?>",
				autoProcessQueue: false,
				dictDefaultMessage: "Arraste suas fotos para cá!",
				acceptedFiles: ".png,.jpg,.jpeg",
				dictRemoveFile: "Remover",
				addRemoveLinks: true,
				parallelUploads: 5,
				init: function() {
					var submitButton = document.querySelector('#submit-all');
					this.on("addedfile", function(event) {

						submitButton.style.display = 'list-item';

					});
					myDropzone = this;
					submitButton.addEventListener("click", function() {
						myDropzone.processQueue();
					});
					this.on("queuecomplete", function() {
						if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {

							var _this = this;
							_this.removeAllFiles();
						}
						list_image(type);
						submitButton.style.display = 'none';
					});
				}
			});
		}

		function list_image(type) {
			$('.clearfix').hide();
			$.ajax({
				url: BASE_URL_PAINEL + "ajax/getImagesByCliente/" + type + "/<?php echo $tableInfo['id_client']; ?>/<?php echo $nomecliente; ?>",
				success: function(data) {
					$('#preview' + type).show();
					$('#preview' + type).html(data);
				}
			});
		}

		function toastAlertDelete(id_image, id_cliente) {
			href = BASE_URL_PAINEL + 'home/deleteFotoCliente/' + id_image + '/' + id_cliente
			toastr.options = {
				"closeButton": true,
				"debug": false,
				"newestOnTop": false,
				"progressBar": false,
				"positionClass": "toast-top-right",
				"preventDuplicates": true,
				"onclick": null,
				"showDuration": "300",
				"hideDuration": "1000",
				"timeOut": 0,
				"extendedTimeOut": 0,
				"showEasing": "swing",
				"hideEasing": "linear",
				"showMethod": "fadeIn",
				"hideMethod": "fadeOut",
				"tapToDismiss": true
			}
			toastr.warning("<br><a type='button' href='" + href + "' class='btn btn-danger btn-flat'>Sim</a>", "Deseja deletar esse documento")

		}
	</script></div>
	