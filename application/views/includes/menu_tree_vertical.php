<!--sidebar start-->
<aside>
  <div id="sidebar"  class="nav-collapse ">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu" id="nav-accordion">
      <li>
        <a href="<?php echo site_url('front/tree'); ?>">
          <i class="fa fa-home"></i>
          <span>Accueil</span>
        </a>
      </li>
      <?php
      
      echo $menu;
      
      ?>
      <!--multi level menu end-->
    </ul>
    <!-- sidebar menu end-->
  </div>
</aside>
<!--sidebar end-->