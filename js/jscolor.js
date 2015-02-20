jQuery(document).ready(function($) {
  $(".wpqrcode-colorpicker").wpColorPicker();  
  $(document).ajaxSuccess(function(e, xhr, settings) {
    $(".wpqrcode-colorpicker").wpColorPicker();
  });
});