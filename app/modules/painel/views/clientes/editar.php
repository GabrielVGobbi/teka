<?php

$nomecliente = str_replace(' ', '_', $tableInfo['cli_nome']);
$idade = 0;
if ($tableInfo['cli_aniversario'] != '') {
	$data = $tableInfo['cli_aniversario'];

	// Separa em dia, mês e ano
	list($dia, $mes, $ano) = explode('/', $data);

	// Descobre que dia é hoje e retorna a unix timestamp
	$hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
	// Descobre a unix timestamp da data de nascimento do fulano
	$nascimento = mktime(0, 0, 0, $mes, $dia, $ano);

	// Depois apenas fazemos o cálculo já citado :)
	$idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
}




?>
<div class="col-md-12">
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab_dados" data-toggle="tab">Dados</a></li>
			<li class=""><a href="<?php echo BASE_URL_PAINEL; ?>clientes/entrevista/<?php echo $tableInfo['id_client']; ?>">Entrevista</a></li>

			<?php $permissions = array();
			foreach ($tableInfo['permissions'] as $perm => $value) : ?>
				<li class="
					<?php #echo $value == 'Teste de Coloração Pessoal' ? 'active' : '' 
					?>
				"><a href="#<?php echo str_replace(' ', '', $value); ?>" data-toggle="tab"><?php echo $value; ?></a></li>
				<?php $permissions[] = $value; ?>
			<?php endforeach; ?>

			<!-- <li class="active"><a href="#tab_geral" data-toggle="tab">Geral</a></li>-->

			<!-- <div class="btn-group pull-right">
				<button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					<i class="fa fa-wrench"></i>
				</button>
				<ul class="dropdown-menu" role="menu">
					<li> <a href="<?php echo BASE_URL_PAINEL; ?>clientes/entrevista/<?php echo $tableInfo['id_client']; ?>">Entrevista </a></li>
				</ul>
			</div>-->
		</ul>
		<div class="tab-content">

			<div class="tab-pane active " id="tab_dados">
				<br>
				<form method="POST" id="edit_client" action="<?php echo BASE_URL_PAINEL; ?>clientes/action" enctype="multipart/form-data">
					<input type="hidden" id="id" name="id" value="<?php echo $tableInfo['id_client']; ?>" />
					<div class="row">
						<div class="col-md-2">
							<button type="button" class="close pull-left" data-dismiss="modal" aria-label="Close">
							</button>
							<?php $nomecliente = str_replace(' ', '_', $tableInfo['cli_nome']) . '_' . str_replace(' ', '_', $tableInfo['cli_sobrenome']);  ?>
							<div class="btn btn-file text-center" style="display: block;">
								<img style="max-height: 110px;min-height: 110px;" name="preview" class="profile-user-img img-responsive" src="<?php echo BASE_URL ?>app/assets/images/clientes/<?php echo mb_strtolower($tableInfo['id_client'], 'UTF-8') ?>/<?php echo mb_strtolower($tableInfo['cli_photo'], 'UTF-8') ?>" alt="">
								<input type="file" onchange="previewImagem()" id="imagem" name="fotos" multiple="">
							</div>

							<h3 class="profile-username text-center"><?php echo ucfirst($tableInfo['cli_nome']) . ' ' . ucfirst($tableInfo['cli_sobrenome']); ?></h3>
							<p class="text-muted text-center"><?php echo $tableInfo['cli_cartela']; ?></p>
							<div class="text-center">
								<img style="max-height: 110px;min-height: 110px;">
							</div>
						</div>
						<div class="col-md-5">
							<div id="formnome" class="form-group">
								<label>Nome</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-fw fa-user"></i>
									</div>
									<input type="text" data-name="<?php echo $tableInfo['cli_nome']; ?>" class="form-control" name="cli_nome" id="cli_nome" value="<?php echo $tableInfo['cli_nome']; ?>">
								</div>
							</div>
						</div>

						<div class="col-md-5">
							<div id="formnome" class="form-group">
								<label>Sobrenome</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-fw fa-user"></i>
									</div>
									<input type="text" data-name="<?php echo $tableInfo['cli_sobrenome']; ?>" class="form-control" name="cli_sobrenome" id="cli_sobrenome" value="<?php echo $tableInfo['cli_sobrenome']; ?>">
								</div>
							</div>
						</div>



						<div class="col-md-10">
							<div id="formnome" class="form-group">
								<label>Email</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-envelope"></i>
									</div>
									<input type="text" class="form-control" name="cli_email" id="cli_email" value="<?php echo $tableInfo['cli_email']; ?>">
								</div>
							</div>
						</div>

						<div class="col-md-2">
							<div id="formnome" class="form-group">
								<label>Data de nascimento</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-envelope"></i>
									</div>
									<input type="text" class="form-control" name="cli_aniversario" id="cli_aniversario" value="<?php echo $tableInfo['cli_aniversario']; ?>" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">
								</div>
							</div>
						</div>

						<div class="col-md-2">
							<div id="formnome" class="form-group">
								<label>Idade</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-fw fa-birthday-cake"></i>
									</div>
									<input type="text" class="form-control" name="idade" id="idade" value="<?php echo $idade; ?>">
								</div>
							</div>
						</div>

						<div class="col-md-2">
							<div id="formnome" class="form-group">
								<label>Telefone</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-phone"></i>
									</div>
									<input type="text" class="form-control" name="cli_telefone" id="cli_telefone" value="<?php echo $tableInfo['cli_telefone']; ?>" data-inputmask='"mask": "(11) 99999-9999"' data-mask>
								</div>
							</div>
						</div>

						<div class="col-md-2">
							<div id="formnome" class="form-group">
								<label>Profissão</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-fw fa-user-secret"></i>
									</div>
									<input type="text" class="form-control" name="cli_profissao" id="cli_profissao" value="<?php echo $tableInfo['cli_profissao']; ?>">
								</div>
							</div>
						</div>






						<div class="col-md-10">
							<div class="box box-default box-solid">
								<div class="row">
									<div class="col-md-12">
										<div class="box-header with-border">
											<h3 class="box-title">Endereço</h3>
										</div>
										<div class="box-body" style="">
											<input type="hidden" class="form-control" name="end" id="end" value="<?php echo $tableInfo['id_endereco']; ?>">

											<div class="col-md-2">
												<div class="form-group">
													<label>CEP</label>
													<input type="text" class="form-control" name="cep" id="cep" size="10" maxlength="9" onblur="pesquisacep(this.value);" data-inputmask="'mask': ['99999-999']" data-mask autocomplete="off" value="<?php echo $tableInfo['cep']; ?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Rua</label>
													<input type="text" readonly class="form-control" name="rua" id="rua" autocomplete="off" value="<?php echo $tableInfo['rua']; ?>">
												</div>
											</div>

											<div class="col-md-3">
												<div class="form-group">
													<label>Bairro</label>
													<input type="text" readonly class="form-control" name="bairro" id="bairro" autocomplete="off" value="<?php echo $tableInfo['bairro']; ?>">
												</div>
											</div>

											<div class="col-md-3">
												<div class="form-group">
													<label>Cidade</label>
													<input type="text" readonly class="form-control" name="cidade" id="cidade" autocomplete="off" value="<?php echo $tableInfo['cidade']; ?>">
												</div>
											</div>

											<div class="col-md-3">
												<div class="form-group">
													<label>Municipio</label>
													<input type="text" readonly class="form-control" name="municipio" id="municipio" autocomplete="off" value="<?php echo $tableInfo['municipio']; ?>">
												</div>
											</div>

											<div class="col-md-3">
												<div class="form-group">
													<label>Estado</label>
													<input type="text" readonly class="form-control" name="estado" id="estado" autocomplete="off" value="<?php echo $tableInfo['estado']; ?>">
												</div>
											</div>

											<div class="col-md-2">
												<div class="form-group">
													<label>Nº</label>
													<input type="text" class="form-control" name="numero" id="numero" autocomplete="off" value="<?php echo $tableInfo['numero']; ?>">
												</div>
											</div>

											<div class="col-md-3">
												<div class="form-group">
													<label>Complemento</label>
													<input type="text" class="form-control" name="complemento" id="complemento" autocomplete="off" value="<?php echo $tableInfo['complemento']; ?>">
												</div>
											</div>

											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="box-footer clearfix no-border">
						<div id="submit_edit" class="btn btn-primary pull-right">Salvar</div>
					</div>
				</form>
			</div>


			<br>
			<?php foreach ($tableInfo['permissions'] as $perm => $value) : ?>
				<div class="tab-pane <?php #echo $value == 'Teste de Coloração Pessoal' ? 'active' : '' 
										?>" id="<?php echo str_replace(' ', '', $value); ?>">
					<?php include_once('includes/' . str_replace(' ', '', $value) . '.php'); ?>
				</div>

			<?php endforeach; ?>



		</div>
	</div>
</div>

<script>
	$(function() {
		$("#submit_permission").click(function() {
			$("#permissions_client").submit();
		});

		$("#submit_edit").click(function() {
			$("#edit_client").submit();
		});
	});
</script>
<script src="<?php echo BASE_URL; ?>app/assets/js/parametros/<?php echo $viewData['pageController']; ?>.js"></script>