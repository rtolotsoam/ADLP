<!-- MODAL -->
<div class="modal fade" id="ratu-group-<?php echo $id_group; ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- MODAL HEADER -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title">
				Rattaché utilisateur au groupe <?php echo ascii_to_entities($libelle_group); ?>
				</h3>
			</div>
			<!-- END MODAL HEADER -->
			<!-- MODAL BODY -->
			<div class="modal-body">
				<form class="margin-none" role="form">
					<div class="form-group">
						<div class="row innerLR innerB">
							<div class="form-group">
								<div class="col-md-12">
									<label for="list_usr_<?php echo $id_group; ?>">		Utilisateur à rattachée :
									</label>
									<?php
									if(isset($users)){
									?>
									<select style="height:200px;" id="list_usr_<?php echo $id_group; ?>" class="form-control" multiple>
										<?php
										foreach ($users as $val_usr) {
										?>
										<option value="<?php echo $val_usr->fte_user_id; ?>">
											<?php
											echo  "--> ".$val_usr->matricule." - ".ascii_to_entities(ucfirst(strtolower($val_usr->prenom)));;
											?>
										</option>
										<?php
										}
										?>
									</select>
									<?php
									}else{
									?>
									<p class="label label-warning">
										Pas d'utilisateur libre
									</p>
									<?php
									}
									?>
									<br/>
									<div id="error_ratu_<?php echo $id_group; ?>"></div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<!--  END MODAL BODY -->
			<!-- MODAL FOOTER -->
			<div class="modal-footer">
				<button class="btn btn-block btn-info" onclick="ratu_group(<?php echo $id_group; ?>);">Rattacher
				</button>
			</div>
			<!--  END MODAL FOOTER -->
		</div>
	</div>
</div>
<!-- END MODAL -->