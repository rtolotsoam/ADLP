<section id="container" class="">
  <!--main content start-->
  <section id="main-content">
    <section class="wrapper site-min-height">
      <!-- BEGIN PAGE CONTENT-->
      <?php
if (!empty($cat_niveau1)) {
    $cpt = 0;

    foreach ($cat_niveau1 as $val_cat_niveau1) {

        $test_row = $cpt % 2;
        if ($test_row == 0) {

          if(isset($lst_cat_niveau2) && !empty($lst_cat_niveau2[$val_cat_niveau1->fte_categories_id])){

            $cat_niveau2 = $lst_cat_niveau2[$val_cat_niveau1->fte_categories_id];
            ?>
      <div class="row">

        <div id="<?php echo "row" . $val_cat_niveau1->fte_categories_id; ?>" class="col-md-6">
          <div id="<?php echo "panel" . $val_cat_niveau1->fte_categories_id; ?>" class="panel pan">
            <div class="panel-heading pan-head">
              <?php
echo ascii_to_entities($val_cat_niveau1->libelle_categories);
            ?>
              <span class="tools pull-right">
                <a href="#" class="fa fa-chevron-down"></a>
                <!-- <a href="#" class="fa fa-times"></a> -->
              </span>
            </div>
            <div class="panel-body">


              <?php
foreach ($cat_niveau2 as $val_cat_niveau2) {
                ?>

              <div class="all-jstree" id="tree-container-<?php echo $val_cat_niveau2->fte_categories_id; ?>"></div>
              <br/>
              <script type="text/javascript">
              <?php
echo "var search" . $val_cat_niveau2->root_id . " = function(searchString) {

              var search_id =\"#tree-container-" . $val_cat_niveau2->root_id . "\";

              $(search_id).jstree(true).search(searchString);
              };";
                ?>
              $(function(){

              <?php
echo "var container =\"#tree-container-" . $val_cat_niveau2->root_id . "\";";
                echo "var id = \"/" . $val_cat_niveau2->root_id . "\";";
                ?>
              var url = url_jstree+id;
              //console.log(container);
              //


              $(container).jstree({

              'plugins': ["state","wholerow","types","search"],
              'core' : {
              'data' : {
              "url" : url,
              "data" : function (node) {
              return { 'id' : node.id };
              },
              "dataType" : "json" // needed only if you do not supply JSON headers
              },
              'check_callback' : true,
              'themes' : {
              'responsive' : true
              }
              },
              "search": {
              'case_insensitive'  : true,
              'show_only_matches' : true
              }
              });
              $(container).on("changed.jstree", function (e, data) {
              if(typeof(data.selected[0]) != 'undefined'){
              var obj = $.jstree.reference(container).get_node(data.selected[0]);
              if(obj.icon == 'jstree-default jstree-file'){
              $.ajax({
              url: url_show_process,
              type : 'POST',
              data : {
              id : obj.id
              },
              success: function(result){
              var str = result;
              var res = str.split("=>")
              //console.log(res[0]+" <===> "+res[1]);
              traiter(res[0], res[1]);
              }
              });
              }
              }else{
              $.jstree.reference(container).refresh();
              }
              });
              });
              </script>
              <?php

}
}
            ?>

            </div>
          </div>
        </div>

        <?php
} else {
            $cat_niveau2 = $lst_cat_niveau2[$val_cat_niveau1->fte_categories_id];
            ?>
        <div id="<?php echo "row" . $val_cat_niveau1->fte_categories_id; ?>" class="col-md-6">
          <div id="<?php echo "panel" . $val_cat_niveau1->fte_categories_id; ?>" class="panel pan">
            <div class="panel-heading pan-head">
              <?php
echo ascii_to_entities($val_cat_niveau1->libelle_categories);
            ?>
              <span class="tools pull-right">
                <a href="#" class="fa fa-chevron-down"></a>
                <!-- <a href="#" class="fa fa-times"></a> -->
              </span>
            </div>
            <div class="panel-body">


              <?php
foreach ($cat_niveau2 as $val_cat_niveau2) {
                ?>


              <div id="tree-container-<?php echo $val_cat_niveau2->fte_categories_id; ?>"></div>
              <br/>

              <script type="text/javascript">
              <?php
echo "var search" . $val_cat_niveau2->root_id . " = function(searchString) {

              var search_id =\"#tree-container-" . $val_cat_niveau2->root_id . "\";

              $(search_id).jstree(true).search(searchString);
              };";
                ?>
              $(function(){
              <?php
echo "var container =\"#tree-container-" . $val_cat_niveau2->root_id . "\";";
                echo "var id = \"/" . $val_cat_niveau2->root_id . "\";";
                ?>
              var url = url_jstree+id;
              $(container).jstree({

              'plugins': ["state","wholerow","types","search"],
              'core' : {
              'data' : {
              "url" : url,
              "data" : function (node) {
              return { 'id' : node.id };
              },
              "dataType" : "json" // needed only if you do not supply JSON headers
              },
              'check_callback' : true,
              'themes' : {
              'responsive' : true
              }
              },
              "search": {
              'case_insensitive'  : true,
              'show_only_matches' : true
              }
              });
              $(container).on("changed.jstree", function (e, data) {
              if(typeof(data.selected[0]) != 'undefined'){
              var obj = $.jstree.reference(container).get_node(data.selected[0]);
              if(obj.icon == 'jstree-default jstree-file'){
              $.ajax({
              url: url_show_process,
              type : 'POST',
              data : {
              id : obj.id
              },
              success: function(result){
              var str = result;
              var res = str.split("=>")
              //console.log(res[0]+" <===> "+res[1]);
              traiter(res[0], res[1]);
              }
              });
              }
              }else{
              $.jstree.reference(container).refresh();
              }
              });

              });
              </script>

              <?php
}
            ?>
            </div>

          </div>
        </div>
      </div>

      <?php
}
        $cpt++;
    }
}
?>
      <div id="notification">
      </div>
      <!-- END PAGE CONTENT-->
      <script type="text/javascript">
      function search_proc() {

      var searchString = $('#search-input').val();
      //console.log(searchString);

      <?php
if (isset($lst_cat_niveau2) && $cat_niveau2) {
    foreach ($lst_cat_niveau2 as $cat_niveau2) {
        foreach ($cat_niveau2 as $val_cat_niveau2) {

            echo "search" . $val_cat_niveau2->fte_categories_id . "(searchString);";
        }
    }
}
?>
      }
      </script>
    </section>
  </section>
  <!--main content end-->
  <script type="text/javascript">
  setInterval(menu_notification, 1000);
  function menu_notification(){
  console.log('notification');
  var form_data = {
  ajax : 'notifications'
  };
  $.ajax({
  url: <?php echo "'" . site_url('front/tree/get_notification') . "',"; ?>
  type: 'POST',
  data: form_data,
  success: function(data) {
  //TRAITEMENT DES ERREURS
  if(data == 'vide'){
  $('#header_notification_bar').addClass('hidden');
  }else{
  var str = data;
  var res = str.split("||");
  $('#header_notification_bar').removeClass('hidden');
  $(".dropdown-menu .extended .notification").empty();
  $(".dropdown-menu .extended .notification").append('<div class="notify-arrow notify-arrow-yellow"></div><li><p class="yellow">Vous avez '+res[1]+' notification(s)</p></li>'+res[0]);
  $(".badge").empty();
  $(".badge").append(res[1]);
  }
  }
  });
  }
  </script>