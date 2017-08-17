<!-- MODAL -->
<div class="modal fade" id="ajout_group">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- MODAL HEADER -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title">Ajouter Nouveau Groupe</h3>
			</div>
			<!-- END MODAL HEADER -->
			<!-- MODAL BODY -->
			<div class="modal-body">
				<div class="innerAll">
					<p id="message_error"></p>
					<form class="margin-none innerLR inner-2x">
						<div class="row">
							<div class="col-md-12">
								<p id="libelle_group_error"></p>
								<div class="form-group">
									<label for="group">Entrer libelle</label>
									<input type="text" class="form-control" id="group" placeholder="Entrer libelle du groupe" />
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!--  END MODAL BODY -->
			<!-- MODAL FOOTER -->
			<div class="modal-footer">
				<button class="btn btn-block btn-info" onclick="ajout_group();">Ajouter groupe</button>
			</div>
			<!--  END MODAL FOOTER -->
		</div>
	</div>
</div>
<!-- END MODAL -->