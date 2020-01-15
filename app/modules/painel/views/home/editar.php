<div class="box box-default ">
	<div class="box-header with-border">
		<h3 class="box-title">Editar</h3>
	</div>

	<div class="box-body" style="">
		<form method="POST" enctype="multipart/form-data" action="<?php echo BASE_URL ?>">
			<div class="tab-content">
				<span type="hidden" class="form-control" name="id_comercial" id="id_comercial" autocomplete="off" value="<?php echo $tableInfo['id_comercial']; ?>">
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
										<span type="text" class="form-control" name="nome_obra" id="nome_obra" value="<?php echo $tableInfo['nome_obra']; ?>" autocomplete="off">
									</div>

								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Concessionaria</label>
										<span type="text" class="form-control" disabled name="concessionaria_nome" id="concessionaria_nome" value="<?php echo $tableInfo['razao_social']; ?>" autocomplete="off">
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label>Tipo de Obra/Serviço</label>
										<span type="text" class="form-control" disabled name="servico_nome" id="servico_nome" value="<?php echo $tableInfo['sev_nome']; ?>" autocomplete="off">
									</div>
								</div>

								<div class="col-md-10" style="margin-bottom:6px;">
									<label>Cliente</label>
									<span type="text" class="form-control" disabled name="cliente_nome" id="cliente_nome" value="<?php echo $tableInfo['cliente_nome']; ?>" autocomplete="off">
								</div>

								<div class="col-md-2" style="margin-bottom:6px;">
									<label>Data de Criação</label>
									<span type="text" class="form-control" name="data_obra" id="data_obra" data-inputmask="'alias': 'dd/mm/yy'" data-mask="" value="<?php echo $tableInfo['data_envio']; ?>" autocomplete="off" required>
								</div>
							</div>
						</div>

					</div>
				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Salvar</button>
					<a href="<?php echo BASE_URL; ?>comercial" class="btn btn-danger">Voltar</a>
				</div>
			</div>
		</form>
	</div>
</div>


<script src="<?php BASE_URL ?>/views/<?php echo $viewData['pageController']; ?>/parametros/<?php echo $viewData['pageController']; ?>.js"></script>