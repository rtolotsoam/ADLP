<script>
var url_upd_proc = "<?php echo site_url("back/processus/editer_processus")?>";
var url_ajout_proc = "<?php echo site_url("back/processus/ajouter_processus")?>";
var url_add_btn = "<?php echo site_url("back/processus/ajbtn")?>";
var url_modif_btn = "<?php echo site_url("back/processus/modif_bouton")?>";
var url_suppr_btn = "<?php echo site_url("back/processus/supprimer_bouton")?>";
var url_suppr_proc = "<?php echo site_url("back/processus/supprimer_process")?>";
var idbout_processus = 0;
</script>
<section id="container" class="">
	<section id="main-content">
		<section class="wrapper">
			<div class="widget widget-tabs widget-tabs-double widget-tabs-vertical row row-merge widget-tabs-gray">
				
				<!-- ETAPES PROCESSUS -->
				<div id="rootwizard" class="wizard">