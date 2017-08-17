      <!-- Right Slidebar start -->
      <div class="sb-slidebar sb-right sb-style-overlay">
          <center><h5 class="side-title"><?php echo ascii_to_entities('Ajouter des remontées'); ?></h5></center>
          <center>
            <div id="remonter">
            </div>
          </center>
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
                      ['font', ['strikethrough', 'superscript', 'subscript']],
                      ['fontsize', ['fontsize']],
                      ['color', ['color']],
                      ['para', ['ul', 'ol', 'paragraph']],
                      ['height', ['height']]
                    ]
              });
          });
          </script>
          
      </div>
      <!-- Right Slidebar end -->