var dowf = true;

function getFishingLicense() {
  if ('XDomainRequest' in window && window.XDomainRequest !== null) {
    jQuery.ajaxSettings.xhr = function() {
      try { return new ActiveXObject("Microsoft.XMLHTTP"); }
      catch(e) { }
      jQuery.support.cors = true;
    };
  }
  $.ajax({
    url:"../modules/dowfModule/actions.php",
    method:"GET",
    data:{
      getFishingLicense: '1'
    },
    success:function(response) {
      
    },
    error:function(){
      console.log("ajax error");
    }
  });
}