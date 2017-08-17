<!--header start-->
<header class="header white-bg">
	<div class="sidebar-toggle-box">
		<i class="fa fa-bars"></i>
	</div>
	<!--logo start-->
	<a href="#" class="logo-tree" >
		<img alt="logo-OAA" src="<?php echo img_url('adlp_logo.png'); ?>">
	</a>
	<!--logo end-->
	<div class="top-nav ">
		<ul class="nav pull-right top-menu">
			<li>
				<a href="#modal-accueil" data-toggle="modal">
					<i class="fa fa-home"></i>
					Accueil
				</a>
			</li>
			<?php if($titre != "TRAITEMENT" && $titre != "PROCESSUS"){ ?>
			<li class="sb-toggle-right">
				<i class="fa  fa-keyboard-o"></i>
			</li>
			<?php } ?>
		</ul>
	</div>
</header>
<!--header end -->