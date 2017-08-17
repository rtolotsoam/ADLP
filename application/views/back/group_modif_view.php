<!-- MODAL -->
<div class="modal fade" id="modifier-group-<?php echo $id_group; ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- MODAL HEADER -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title">Modifier Groupe</h3>
			</div>
			<!-- END MODAL HEADER -->
			<!-- MODAL BODY -->
			<div class="modal-body">
				<div class="innerAll">
					<p id="message_error_<?php echo $id_group; ?>"></p>
					<form class="margin-none innerLR inner-2x">
						<div class="row">
							<div class="col-md-12">
								<p id="libelle_group_error_<?php echo $id_group; ?>"></p>
								<div class="form-group">
									<label for="group_<?php echo $id_group; ?>">Modifier libelle</label>
									<input type="text" class="form-control" id="group_<?php echo $id_group; ?>" placeholder="Modifier libelle du groupe" value="<?php echo $libelle_group; ?>"/>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!--  END MODAL BODY -->
			<!-- MODAL FOOTER -->
			<div class="modal-footer">
				<button class="btn btn-block btn-info" onclick="modifier_group(<?php echo $id_group; ?>);">Modifier groupe</button>
			</div>
			<!--  END MODAL FOOTER -->
		</div>
	</div>
</div>
<!-- END MODAL -->