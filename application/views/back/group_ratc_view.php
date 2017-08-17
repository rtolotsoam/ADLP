<!-- MODAL -->
<div class="modal fade" id="ratc-group-<?php echo $id_group; ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- MODAL HEADER -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title">
				Rattaché catégorie au groupe <?php echo ascii_to_entities($libelle_group); ?>
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
									<label for="list_cat_<?php echo $id_group; ?>">		Catégorie à rattachée :
									</label>
									<?php
									if(isset($categories)){
									?>
									<select style="height:200px;" id="list_cat_<?php echo $id_group; ?>" class="form-control" multiple>
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
									<?php
									}else{
									?>
									<p class="label label-warning">
										Pas de catégorie libre
									</p>
									<?php
									}
									?>
									<br/>
									<div id="error_ratc_<?php echo $id_group; ?>"></div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<!--  END MODAL BODY -->
			<!-- MODAL FOOTER -->
			<div class="modal-footer">
				<button class="btn btn-block btn-info" onclick="ratc_group(<?php echo $id_group; ?>);">Rattacher
				</button>
			</div>
			<!--  END MODAL FOOTER -->
		</div>
	</div>
</div>
<!-- END MODAL -->