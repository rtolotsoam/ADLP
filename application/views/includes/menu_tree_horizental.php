<!--header start-->
<header class="header white-bg">
  <?php
  if (($titre == "ACCUEIL" && isset($level) && $level == "user") || ($titre == "PROCESSUS" && $level == "admin")) {
  ?>
  <div class="sidebar-toggle-box">
    <i class="fa fa-bars"></i>
  </div>
  <?php
  }
  ?>
  <!--logo start-->
  <a href="#" class="logo-tree" >
    <img alt="logo-OAA" src="<?php echo img_url('adlp_logo.png'); ?>">
  </a>
  <!--logo end-->
  <div class="nav notify-row" id="top_menu">
    <ul class="nav top-menu">
      <!-- settings start -->
      <li class="dropdown">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
          <i class="fa fa-th"></i>
        </a>
        <ul class="dropdown-menu extended tasks-bar">
          <div class="notify-arrow notify-arrow-green"></div>
          <li>
            <center><p class="green">Vos liens</p></center>
          </li>
          <?php
          if ($titre != "ACCUEIL") {
          if (isset($level) && $level == "user") {
          ?>
          <li>
            <a href="<?php echo site_url('front/tree'); ?>">
              <center>
              <i class="fa fa-home"></i>
              Accueil
              </center>
            </a>
          </li>
          <?php
          } else {
          ?>
          <?php if ($gest_g == 1) {?>
          <li>
            <a href="<?php echo site_url('back/accueil_admin/normal'); ?>">
              <center>
              <i class="fa fa-home"></i>
              Accueil
              </center>
            </a>
          </li>
          <?php
          }
          }
          }
          ?>
          <?php
          if ($titre != "HISTORIQUES") {
          ?>
          <li>
            <a href="<?php echo site_url('front/historique'); ?>">
              <center>
              <i class="fa fa-pencil-square-o"></i>
              Historique
              </center>
            </a>
          </li>
          <?php
          }
          ?>
          <?php
          if ($titre != "UTILISATEUR" && $level == "admin") {
          ?>
          <?php if ($gest_u == 1) {?>
          <li>
            <a href="<?php echo site_url('back/utilisateur'); ?>">
              <center>
              <i class="fa fa-user"></i>
              Utilisateurs
              </center>
            </a>
          </li>
          <?php
          }
          }
          ?>
          <?php
          if ($titre != "NOTIFICATION" && $level == "admin") {
          ?>
          <li>
            <a href="<?php echo site_url('back/notification'); ?>">
              <center>
              <i class="fa fa-bullhorn"></i>
              Notification
              </center>
            </a>
          </li>
          <?php
          }
          ?>
        </ul>
      </li>
      <!-- settings end -->
      <?php
      if (isset($notifications) && !empty($notifications)) {
      ?>
      <!-- notification dropdown start-->
      <li id="header_notification_bar" class="dropdown">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
          <i class="fa fa-bell-o"></i>
          <span class="badge bg-warning"><?php echo count($notifications); ?></span>
        </a>
        <ul class="dropdown-menu extended notification">
          <div class="notify-arrow notify-arrow-yellow"></div>
          <li>
            <center>
            <p class="yellow">
              Vous avez <?php echo count($notifications); ?> notification(s)
            </p>
            </center>
          </li>
          <?php
          $i = 0;
          foreach ($notifications as $notification) {
          $i++;
          if ($i == 5) {
          break;
          }
          if ($notification->couleur == "danger") {
          $date_creat = datetime_fr($notification->date_creation);
          ?>
          <li>
            <a href="#" onclick="notification(<?php echo $notification->fte_notification_maj_id; ?>); return false;">
              <span class="label label-danger"><i class="fa fa-bolt"></i></span>
              <?php echo ascii_to_entities(substr($notification->titre, 0, 20)) . " ..."; ?>
              <span class="small italic">[ <?php echo $date_creat; ?> ]</span>
            </a>
          </li>
          <?php
          }
          if ($notification->couleur == "warning") {
          $date_creat = datetime_fr($notification->date_creation);
          ?>
          <li>
            <a href="#" onclick="notification(<?php echo $notification->fte_notification_maj_id; ?>); return false;">
              <span class="label label-warning"><i class="fa fa-bell"></i></span>
              <?php echo ascii_to_entities(substr($notification->titre, 0, 20)) . " ..."; ?>
              <span class="small italic">[ <?php echo $date_creat; ?> ]</span>
            </a>
          </li>
          <?php
          }
          if ($notification->couleur == "info") {
          $date_creat = datetime_fr($notification->date_creation);
          ?>
          <li>
            <a href="#" onclick="notification(<?php echo $notification->fte_notification_maj_id; ?>); return false;">
              <span class="label label-info"><i class="fa fa-bullhorn"></i></span>
              <?php echo ascii_to_entities(substr($notification->titre, 0, 20)) . " ..."; ?>
              <span class="small italic">[ <?php echo $date_creat; ?> ]</span>
            </a>
          </li>
          <?php
          }
          }
          ?>
        </ul>
      </li>
      <!-- notification dropdown end -->
      <?php
      }
      ?>
    </ul>
  </div>
  <?php
  if (isset($prenom)) {
  ?>
  <div class="top-nav ">
    <ul class="nav pull-right top-menu">
      <?php
      if ($titre == "ACCUEIL") {
      ?>
      <li>
        <?php
        if ($level == "user") {
        ?>
        <input type="text" id="search-input" onkeyup="search_proc();" class="form-control search" placeholder="Chercher">
        <?php
        } else {
        ?>
        <input type="text" id="search-input-admin" onkeyup="search_proc_admin();" class="form-control search" placeholder="Chercher">
        <?php
        }
        ?>
      </li>
      <?php
      }
      ?>
      <!-- user login dropdown start-->
      <li class="dropdown">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
          <!-- <img alt="" src="img/avatar1_small.jpg"> -->
          <span class="username">
            <?php
            $prenom = ucfirst(strtolower($prenom));
            echo ascii_to_entities($prenom);
            ?>
          </span>
          <b class="caret"></b>
        </a>
        <ul class="dropdown-menu extended logout">
          <div class="log-arrow-up"></div>
          <center>
          <li>
            <a href="#profil_user" data-toggle="modal">
              <i class=" fa fa-eye"></i>
              Votre profil
            </a>
          </li>
          </center>
          <!-- <li><a href="#"><i class="fa fa-bell-o"></i> Notification</a></li> -->
          <li>
            <a href="<?php echo site_url('front/deconnexion'); ?>">
              <i class="fa fa-key"></i>
            Déconnexion</a>
          </li>
        </ul>
      </li>
      <!-- user login dropdown end -->

      <?php if($titre != "TRAITEMENT" && $titre != "PROCESSUS"){ ?>
      <li class="sb-toggle-right">
        <i class="fa  fa-keyboard-o"></i>
      </li>
      <?php } ?>
    </ul>
  </div>
  <?php
  } else if (($titre == "UTILISATEUR" || $titre == "PROCESSUS") && $level == "admin" && isset($prenom_admin)) {
  ?>
  <div class="top-nav ">
    <ul class="nav pull-right top-menu">
      <li class="dropdown">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
          <!-- <img alt="" src="img/avatar1_small.jpg"> -->
          <span class="username">
            <?php
            $prenom = ucfirst(strtolower($prenom_admin));
            echo ascii_to_entities($prenom);
            ?>
          </span>
          <b class="caret"></b>
        </a>
        <ul class="dropdown-menu extended logout">
          <div class="log-arrow-up"></div>
          <center>
          <li>
            &nbsp;
          </li>
          </center>
          <li>
            <a href="<?php echo site_url('front/deconnexion'); ?>">
              <i class="fa fa-key"></i>
              Déconnexion
            </a>
          </li>
        </ul>
      </li>
      <?php if($titre != "TRAITEMENT" && $titre != "PROCESSUS"){ ?>
      <li class="sb-toggle-right">
        <i class="fa  fa-keyboard-o"></i>
      </li>
      <?php } ?>
    </ul>
  </div>
  <?php
  }
  ?>
</header>
<!--header end -->