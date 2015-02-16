jQuery(document).ready(function($) {
  $(".color").wpColorPicker();  
  $(document).ajaxSuccess(function(e, xhr, settings) {
    $(".color").wpColorPicker();
  });
});