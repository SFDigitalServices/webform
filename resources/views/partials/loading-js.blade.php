<script>
  //GLOBALS for now
  var user_id = '<?php echo $user_id;?>';
  var api_token = '<?php echo $api_token;?>';

  $(document).ready(function(){
    $(".content").show();

    callAPI("/form/getForms", {}, loadHome);
  });

  //$(window).unload(function(){});

  window.onpopstate = function (event) {
      $('.container').hide();
      if (event.state) {
          if (event.state.formId) {
              loadContent(event.state.formId);
          } else {
              loadContent();
          }
      } else {
          goHome(true);
      }
  }
</script>