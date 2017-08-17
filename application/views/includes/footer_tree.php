</section>

      <!-- Right Slidebar start -->
      <div class="sb-slidebar sb-right sb-style-overlay">
          <center><h5 class="side-title"><?php echo ascii_to_entities('Ajouter des remontées'); ?></h5></center>
          <center>
            <div id="error_remonter">
            </div>
            <br/>
            <div id="remonter"></div>
          </center>
          <br/>
          <center>
            <button class="btn btn-info" onclick="remonter();">
              Envoyer
            </button>
          </center>
          <br/>
          <div id="success_remonter">
          </div>
          
          

          <script type="text/javascript">
          $(document).ready(function() {
              $('#remonter').summernote({
                  height: 300,
                  width : 200,
                  minHeight : null,
                  maxHeight : null,
                  placeholder : 'Tapez ici les remontées puis cliquez sur envoyer',
                  focus : true,
                  toolbar: [
                      // [groupName, [list of button]]
                      ['style', ['bold', 'italic', 'underline', 'clear']],
                      ['color', ['color']],
                      ['para', ['paragraph']]
                    ]
              });
          });

          function remonter(){
            var val_remonter = $('#remonter').summernote('code');

            $('#error_remonter').empty();

            if(typeof val_remonter.code() != null && val_remonter.code() != ''){

                var form_data = {
                    remonter: val_remonter.code(),
                };
                $.ajax({
                    url: <?php echo "'" . site_url('remonter') . "'"; ?>,
                    type: 'POST',
                    data: form_data,
                    success: function(data) {

                        console.log(data);

                        if(data == 'success'){

                            $('#success_remonter').html('<div class="alert alert-success" align="center">Remonté ajouter avec succès !</div>');


                            setTimeout(function(){  

                              $('#success_remonter').empty();  

                              $('#remonter').code('');

                            }, 2000);


                        }else{

                          $('#error_remonter').html('<div class="alert alert-warning" align="center">Merci de réessayer ultérieurement !</div>');

                          setTimeout(function(){  

                            $('#error_remonter').empty();  

                          }, 2000);

                        }

                    }
                });

            }else{

              $('#error_remonter').html('<div class="alert alert-danger" align="center">Le champ remonté est obligatoire !</div>');

                setTimeout(function(){  

                  $('#error_remonter').empty();  

                }, 2000);

                
            }

          }
          </script>

      </div>
      <!-- Right Slidebar end -->

<!-- CONFIGURATION GOBAL -->
<script>
  var basePath   = '',
  commonPath     = '../assets/',
  rootPath       = '../';
</script>
<!-- END CONFIGURATION GOBAL -->
<script src="<?php echo js_url('js/bootstrap.min.js'); ?>"></script>
<script class="include" type="text/javascript" src="<?php echo js_url('js/jquery.dcjqaccordion.2.7.js'); ?>"></script>
<script src="<?php echo js_url('js/jquery.scrollTo.min.js'); ?>"></script>
<script src="<?php echo js_url('js/jquery.nicescroll.js'); ?>" type="text/javascript"></script>
<script src="<?php echo js_url('js/respond.min.js'); ?>" ></script>
<!--right slidebar-->
<script src="<?php echo js_url('js/slidebars.min.js'); ?>"></script>
<!--common script for all pages-->
<script src="<?php echo js_url('js/common-scripts.js'); ?>"></script>
<!-- form wizard -->
<script src="<?php echo js_url('modules/admin/forms/wizards/assets/lib/jquery.bootstrap.wizard.js'); ?>"></script>
<script src="<?php echo js_url('modules/admin/forms/wizards/assets/custom/js/form-wizards.init.js'); ?>"></script>
<!-- slim scroll -->
<script src="<?php echo js_url('plugins/slimscroll/jquery.slimscroll.js'); ?>"></script>
<script src="<?php echo js_url('modules/admin/widgets/widget-scrollable/assets/js/widget-scrollable.init.js'); ?>"></script>
<!-- datatable -->
<script src="<?php echo js_url('modules/admin/tables/datatables/assets/lib/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo js_url('modules/admin/tables/datatables/assets/lib/extras/TableTools/media/js/TableTools.min.js'); ?>"></script>
<script src="<?php echo js_url('modules/admin/tables/datatables/assets/lib/extras/ColVis/media/js/ColVis.min.js'); ?>"></script>
<script src="<?php echo js_url('modules/admin/tables/datatables/assets/custom/js/DT_bootstrap.js'); ?>"></script>
<script src="<?php echo js_url('modules/admin/tables/datatables/assets/custom/js/datatables.init.js'); ?>"></script>
<!-- pour les selection -->
<script src="<?php echo js_url('modules/admin/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js'); ?>"></script>
<script src="<?php echo js_url('modules/admin/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js'); ?>"></script>
<!-- time picker -->
<script src="<?php echo js_url('modules/admin/forms/elements/bootstrap-timepicker/assets/lib/js/bootstrap-timepicker.js'); ?>"></script>
<script src="<?php echo js_url('modules/admin/forms/elements/bootstrap-timepicker/assets/custom/js/bootstrap-timepicker.init.js'); ?>"></script>
<!-- date picker -->
<script src="<?php echo js_url('modules/admin/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js'); ?>"></script>
<script src="<?php echo js_url('modules/admin/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js'); ?>"></script>
<!-- Summernote remonter-->
<script src="<?php echo js_url('js/summernote.min.js'); ?>"></script>
</body>
</html>