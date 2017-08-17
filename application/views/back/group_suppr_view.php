<!-- MODAL -->
<div class="modal fade" id="supprimer-group-<?php echo $id_group; ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- MODAL HEADER -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title">Suppression d'un groupe</h3>
			</div>
			<!-- END MODAL HEADER -->
			
			<!-- MODAL BODY -->
			<div class="modal-body">
				<div class="innerAll">
					<div id="message_error_<?php echo $id_group; ?>">
					</div>
					<p>
						<center class="astuce">
							<img src="<?php echo img_url('attention.png'); ?>" alt="logo_attention" />
						</center>
						<br/>
						<p>Voulez-vous vraiment supprimer le groupe, car tous les rattachements à ce groupe seront enlevé et le groupe supprimé :
						</p>
						<br/>
						<center>
							<span style="color:red;">
								<?php echo ascii_to_entities($libelle_group); ?>
							</span>
						</center>
					</p>
				</div>
			</div>
			<!--  END MODAL BODY -->
			<!-- MODAL FOOTER -->
			<div class="modal-footer">
				<button class="btn btn-block btn-info" onclick="supprimer_group(<?php echo $id_group; ?>);">Supprimer
				</button>
			</div>
			<!--  END MODAL FOOTER -->
			
		</div>
	</div>
</div>
<!-- END MODAL -->