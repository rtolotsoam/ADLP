<!--sidebar start-->
<aside>
  <div id="sidebar"  class="nav-collapse ">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu" id="nav-accordion">
      <li class="sub-menu">
        <a href="#" class="active">
          <i class="fa  fa-chevron-circle-down"></i>
          <span>
            <?php if(!empty($menu1)){
            echo ascii_to_entities($menu1);
            }?>
          </span>
        </a>
        <ul class="sub"  id="activities">
        </ul>
      </li>
    </ul>
    <!-- sidebar menu end-->
  </div>
</aside>
<!--sidebar end-->


<!-- MODAL -->
<div class="modal fade" id="modal-accueil">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- MODAL HEADER -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">Attention</h3>
      </div>
      <!-- END MODAL HEADER -->
      <!-- MODAL BODY -->
      <div class="modal-body">
        <p class="astuce"><img src="<?php echo img_url('attention.png'); ?>" alt="logo_attention" />&nbsp;Voulez-vous vraiment revenir à l'accueil, sans terminer le processus ?</p>
      </div>
      <!--  END MODAL BODY -->
      <!-- MODAL FOOTER -->
      <div class="modal-footer">
        <a href="<?php echo site_url('front/traitement/deviation'); ?>" class="btn btn-block btn-info"> Oui</a>
      </div>
      <!--  END MODAL FOOTER -->
      
    </div>
  </div>
</div>
<!-- END MODAL -->