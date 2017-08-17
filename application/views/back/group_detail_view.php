<!-- MODAL -->
<div class="modal" id="detail-group-<?php echo $id_group; ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- MODAL HEADER -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title">
				Détail du groupe <?php echo ascii_to_entities($libelle_group); ?>
				</h3>
			</div>
			<!-- END MODAL HEADER -->
			<!-- MODAL BODY -->
			<div class="modal-body">
				<form class="margin-none" role="form">
					<div class="form-group">
						<div class="row innerLR innerB">
							<div class="form-group">
								<div class="col-md-6">
									<label for="detail_cat_<?php echo $id_group; ?>">		Catégorie rattachée :
									</label>
									<?php
									if(isset($categories)){
									?>
									<select style="height:200px;" id="detail_cat_<?php echo $id_group; ?>" class="form-control" multiple>
										<?php
										foreach ($categories as $val_cat) {
										?>
										<option value="<?php echo $val_cat->fte_categories_id; ?>">
											<?php
											echo  "--> ".ascii_to_entities($val_cat->libelle_categories);
											?>
										</option>
										<?php
										}
										?>
									</select>
									<br/>
									<a herf="#" class="btn btn-block btn-danger" onclick="detc(<?php echo $id_group; ?>); return false;">
										Détachée catégorie
									</a>
									<br/>
									<div id="error_cat_<?php echo $id_group; ?>"></div>
									<?php
									}else{
									?>
									<p class="label label-warning">
										Pas de catégorie rattachée à ce groupe
									</p>
									<?php
									}
									?>
								</div>
								<div class="col-md-6">
									<label for="detail_usr_<?php echo $id_group; ?>">		utilisateur rattachée :
									</label>
									<?php
									if(isset($users)){
									?>
									<select style="height:200px;" id="detail_usr_<?php echo $id_group; ?>" class="form-control" multiple>
										<?php
										foreach ($users as $val_usr) {
										?>
										<option value="<?php echo $val_usr->fte_user_id; ?>">
											<?php
											echo "--> ".ascii_to_entities($val_usr->matricule). " - ".ascii_to_entities(ucfirst(strtolower($val_usr->prenom)));
											?>
										</option>
										<?php
										}
										?>
									</select>
									<br/>
									<a herf="#" class="btn btn-block btn-danger" onclick="detu(<?php echo $id_group; ?>); return false;">
										Détachée utilisateur
									</a>
									<br/>
									<div id="error_usr_<?php echo $id_group; ?>"></div>
									<?php
									}else{
									?>
									<p class="label label-warning">
										Pas d'utilisateur rattachée à ce groupe
									</p>
									<?php
									}
									?>
									
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<!--  END MODAL BODY -->
			<!-- MODAL FOOTER -->
			<div class="modal-footer">
				<button class="btn btn-block btn-info" onclick="detail_group(<?php echo $id_group; ?>);">Vue
				</button>
			</div>
			<!--  END MODAL FOOTER -->
		</div>
	</div>
</div>
<!-- END MODAL -->