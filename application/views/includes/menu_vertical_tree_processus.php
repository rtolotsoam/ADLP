<!--sidebar start-->
<aside>
  <div id="sidebar"  class="nav-collapse ">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu" id="nav-accordion">
      <li class="sub-menu">
        <a href="#" class="active">
          <i class="fa  fa-chevron-circle-down"></i>
          <span>
            <?php echo ascii_to_entities($traitement); ?>
          </span>
        </a>
        <ul class="sub">
          <?php
          $i_tab = 0;
          foreach ($lst_proc as $val_proc) {
          $i_tab += 1;
          ?>
          <li <?php if($i_tab == 1){ echo "class=\"active\"";} ?>>
            <a href="#tab<?php echo $val_proc->fte_process_id; ?>" data-toggle="tab" id="lien<?php echo $val_proc->fte_process_id; ?>">
              <?php echo $val_proc->alias;?>
            </a>
          </li>
          <?php
          }
          ?>
        </ul>
      </li>
    </ul>
    <!-- sidebar menu end-->
  </div>
</aside>
<!--sidebar end-->
<style type="text/css" media="screen">
.active .dcjq-icon {
background: none !important;
}
.dcjq-icon {
background: none !important;
}
</style>