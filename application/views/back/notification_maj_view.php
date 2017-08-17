<section id="container" class="sidebar-closed">
	<section id="main-content">
		<section class="wrapper">
			<div class="row">
				<div class="col-md-12">
					<div class="widget widget-inverse   corp-info">
						<div class="widget-body padding-bottom-none">
							<!-- Table -->
							<table class="dynamicTable ajax4 table table-bordered table-condensed table-striped table-vertical-center table-responsive">
								<!-- Table heading -->
								<thead class="bg-gray">
									<tr>
										<th>Titre</th>
										<th>Contenu</th>
										<th class="center">Qualification</th>
										<th class="center">Visible</th>
										<th><?php echo ascii_to_entities('Créateur'); ?></th>
										<th><?php echo ascii_to_entities('Création'); ?></th>
										<th>Vues</th>
										<th class="center" style="width: 150px;">Modifier</th>
										<th class="center" style="width: 150px;">Supprimer</th>
									</tr>
								</thead>
								<!-- // Table heading END -->
								<!-- Table body -->
								<tbody>
								</tbody>
								<!-- // Table body END -->
							</table>
							<!-- // Table END -->
							<!-- Affichage du modal de confirmation suppression notification -->
							<div id="affiche-suppr-notification">
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</section>
	<script type="text/javascript">
	$(document).ready(function(){
	init_evenement();
	});
	</script>