	<!-- MODAL -->
	<div class="modal fade" id="affiche-not-<?php echo $id_not; ?>">
		<div class="modal-dialog">
			<div class="modal-content">


				<!-- MODAL HEADER -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title">Notification</h3>
				</div>
				<!-- END MODAL HEADER -->
				
				<!-- MODAL BODY -->
				<div class="modal-body">
					<div class="innerAll">

					<?php

					if($notifications[0]->couleur == 'danger'){

					?>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-danger" style="
													border: 2px solid #F2DEDE;    border-radius: 4px;
												    border-top-left-radius: 4px;
												    border-top-right-radius: 4px;
												    border-bottom-right-radius: 4px;
												    border-bottom-left-radius: 4px;">
									<div class="panel-heading">
										<?php 
											echo ascii_to_entities(strtoupper($notifications[0]->titre));
										?>
									</div>
									<div class="panel-body">
										<?php 
											echo ascii_to_entities($notifications[0]->corps);
										?>
									</div>
								</div>
							</div>
						</div>
					
					<?php
					}
					?>

					<?php

					if($notifications[0]->couleur == 'info'){

					?>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-info" style="
													border: 2px solid #D9EDF7;    border-radius: 4px;
												    border-top-left-radius: 4px;
												    border-top-right-radius: 4px;
												    border-bottom-right-radius: 4px;
												    border-bottom-left-radius: 4px;">
									<div class="panel-heading">
										<?php 
											echo ascii_to_entities($notifications[0]->titre);
										?>
									</div>
									<div class="panel-body">
										<?php 
											echo ascii_to_entities($notifications[0]->corps);
										?>
									</div>
								</div>
							</div>
						</div>
					
					<?php
					}
					?>

					<?php

					if($notifications[0]->couleur == 'warning'){

					?>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-warning" style="
													border: 2px solid #FCF8E3;    border-radius: 4px;
												    border-top-left-radius: 4px;
												    border-top-right-radius: 4px;
												    border-bottom-right-radius: 4px;
												    border-bottom-left-radius: 4px;">
									<div class="panel-heading">
										<?php 
											echo ascii_to_entities($notifications[0]->titre);
										?>
									</div>
									<div class="panel-body">
										<?php 
											echo ascii_to_entities($notifications[0]->corps);
										?>
									</div>
								</div>
							</div>
						</div>
					
					<?php
					}
					?>

					</div>
				</div>
				<!--  END MODAL BODY -->

				<!-- MODAL FOOTER -->
				<div class="modal-footer">
					<button class="btn btn-block btn-info" onclick="marquer_notification(<?php echo $id_not; ?>);">Marquer comme lu.</button>
				</div>
				<!--  END MODAL FOOTER -->
			
			</div>
		</div> 
	</div>
	<!-- END MODAL -->