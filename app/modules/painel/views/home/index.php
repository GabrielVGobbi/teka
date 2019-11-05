<div class="col-xs-12">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Exemplo</h3>
			<div class="box-tools pull-right">
				<div class="has-feedback">
					<button class="btn btn-sm btn-info pop" onclick="getModalFiltro('<?php echo $viewData['pageController']; ?>')">
						<i class="glyphicon glyphicon-search"></i>
					</button>
					<a href="http://www2.cena.com.br/comercial" type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></a>
					<a href="http://www2.cena.com.br/comercial/add" type="button" class="btn btn-default btn-sm"><i class="fa fa-fw fa-plus-circle"></i> Novo</a>
				</div>
			</div>
		</div>

		<div class="box-body no-padding">
			<?php require("filtro.php"); ?>
			<div class="table-responsive mailbox-messages">
				<div class="box">
					<div class="box-body table-responsive no-padding">
					</div>
				</div>
				<table class="table table-hover">
					<?php if (count($tableDados) > 0) : ?>
						<tbody>
							<div class="box">
								<div class="box-body table-responsive no-padding">
									<table class="table table-hover">
										<tbody>
											<tr>
												<th style="width: 10%;">Ações</th>
												<th>ID</th>
												<th>Nome da Obra</th>
												<th>Responsável</th>
												<th>Concessionaria</th>
												<th>Serviço</th>
												<th style="width: 10%;" class="text-center">Status</th>
											</tr>
											<?php foreach ($tableDados as $inf) : ?>
												<tr>
													<td>
													<!-- botão -->
													</td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>

												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</tbody>
					<?php else : ?>
						<tr>
							<td style="width: 50%;text-align: center;"> Não foram encontrados resultados </td>
						</tr>
					<?php endif; ?>
				</table>
			</div>
		</div>
	</div>
	<div class="pull-left" style="right: 10px;">
		<p> Total: 0 </p>
	</div>
</div>

<div class="box-footer no-padding">
	<div class="mailbox-controls">
		<ul class="pagination pagination-sm pull-right">
			<li class="active ">
				<a href="http://www2.cena.com.br/comercial?p=url=comercial&amp;p=1">1</a>
			</li>
		</ul>
	</div>
</div>