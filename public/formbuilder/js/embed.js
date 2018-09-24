jQuery( document ).ready(function() {
  jQuery('#SFDSWF-Container form').validator();

  jQuery('#SFDSWF-Container .form-section-nav li').click(function(e){
    var i = jQuery(e.target).prevAll().length;
    SFDSWF_goto(i);
  });

  jQuery('#SFDSWF-Container .form-section-prev').click(function(e) {
    var i = jQuery('.form-section-nav li.active').prevAll('.form-section-nav li').length;
    SFDSWF_goto(i < 1 ? 0 : i-1);
  });

  jQuery('#SFDSWF-Container .form-section-next').click(function(e) {
    var i = jQuery('.form-section-nav li.active').prevAll('.form-section-nav li').length;
    SFDSWF_goto(i+1);
  });

  var SFDSWF_goto = function(i) {
    jQuery('#SFDSWF-Container .form-section-nav li').removeClass('active');
    jQuery('#SFDSWF-Container .form-section-nav li').eq(i).addClass('active');
    jQuery('#SFDSWF-Container .form-section').removeClass('active');
    jQuery('#SFDSWF-Container .form-section').eq(i).addClass('active');
    jQuery('#SFDSWF-Container .form-section-header').removeClass('active');
    jQuery('#SFDSWF-Container .form-section-header').eq(i).addClass('active');
    jQuery('html,body').animate({ scrollTop: 0 }, 'medium');
  }

});