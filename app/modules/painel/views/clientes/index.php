<div class="col-xs-12 ">
	<div class="container">
		<br>
		<div class="row">
			<?php if ($tableDados && count($tableDados) > 0) : ?>
				<?php foreach ($tableDados as $dd) : ?>
					<?php $nomecliente = str_replace(' ', '_', $dd['cli_nome']).'_'.str_replace(' ', '_', $dd['cli_sobrenome']);  ?>

					<a href="<?php echo BASE_URL_PAINEL ?>clientes/info/<?php echo $dd['id_client']; ?>">
						<div class="col-md-3">
							<div class="box box-primary" style="min-height: 340px; max-height: 340px;">
								<div class="box-body box-profile">
									<img style="max-height: 110px;min-height: 110px;" class="profile-user-img img-responsive img-circle" src="<?php echo BASE_URL ?>app/assets/images/clientes/<?php echo mb_strtolower($nomecliente,'UTF-8') ?>/<?php echo mb_strtolower($dd['cli_photo'],'UTF-8') ?>" alt="User profile picture">
									<h3 class="profile-username text-center"><?php echo ucfirst($dd['cli_nome']) . ' ' . ucfirst($dd['cli_sobrenome']); ?></h3>
									<p class="text-muted text-center"><?php echo $dd['cli_cartela']; ?></p>
									<ul class="list-group list-group-unbordered text-center">
										<li class="list-group-item ">
											<i class="fa fa-envelope"></i><b> <?php echo $dd['cli_email']; ?></b>
										</li>
										<li class="list-group-item">
											<b>Estilo</b>
										</li>
										<li class="list-group-item">
											<b>Encontro</b>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</a>
				<?php endforeach; ?>
			<?php else : ?>
				<h3> nenhum resultado encontrado </h3>
			<?php endif; ?>
		</div>
	</div>
</div>