<!DOCTYPE html>
<html>
<head>
<style type="text/css">
	body{
		font-family:Arial, Helvetica;
		font-size: 12px;
	}

</style>
</head>
	<body>
		<strong>
			Bonjour <?php echo ucfirst(strtolower($prenom)); ?>
		</strong>
		<br/><br/>
		<p>
			<?php
if (isset($statut) && $statut == '1') {
    ?>

				Votre compte a été créé pour l'utilisation de l'outil d'aide à l'agent ADLP

			<?php
} else if (isset($statut) && $statut == '0') {
    ?>

				Votre compte a été créé pour l'utilisation de l'outil d'aide à l'agent ADLP.
				</p>
				<p>Mais il n'est pas encore activé, veuillez aviser votre N+1 pour l'activer.

			<?php
} else if (isset($statut) && $statut == 'mail_renseigne') {
    ?>

				Merci d'avoir renseigner votre adresse E-mail, pour utiliser l'outil d'aide à l'agent ADLP.

			<?php
} else if (isset($statut) && $statut == 'modif_pass_mail') {
    ?>

				Merci d'avoir renseigner votre adresse E-mail et votre mot de passe est modifier, pour utiliser l'outil d'aide à l'agent ADLP.

			<?php
}
?>
		</p>
		<p>
			Ci-après les détails
		</p>
		<h4>
			Information sur votre compte :
		</h4>
		<ol>
			<li>Matricule : <?php echo $matricule; ?></li>
			<li>Mot de passe : <?php echo $pass; ?></li>
			<li>Lien : <a href="http://aide-agent.vivetic.com:8888/ADLP">http://aide-agent.vivetic.com:8888/ADLP</a></li>
		</ol>
		<p>Cordialement,</p>
		<hr size="0" style="
						border-bottom-width: 1px;
						border-top-style: none;
						border-right-style: none;
						border-bottom-style: solid;
						border-left-style: none;
						border-bottom-color: #eaeaea;
						margin-bottom:15px;"
		/>
		<p>
			<h4>
				ADMIN
				<br/>
				<span style="color: #3C8DBC;">
					ADMINISTRATION VIVETIC
				</span>
			</h4>
			<br />
			<img src="cid:logo_mail" alt="vivetic" border="0" />
		</p>

	</body>
</html>