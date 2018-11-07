$(document).ready(function () {
  getDepartments();
});

function getDepartments() {
  if ('XDomainRequest' in window && window.XDomainRequest !== null) {
      jQuery.ajaxSettings.xhr = function() {
          try { return new ActiveXObject("Microsoft.XMLHTTP"); }
          catch(e) { }
          jQuery.support.cors = true;
      };
  }
  
  $.ajax({
    url:"customDepartmentsModuleActions.php",
    method:"GET",
    data:{
      getDepartments: '1'
    },
    success:function(response) {
      $("#departmentsTableBody").html(response);
    },
    error:function(){
      console.log("ajax error");
    }
  });
}

function createDepartment() {
  var name = $("#depName").val();
  if ('XDomainRequest' in window && window.XDomainRequest !== null) {
      jQuery.ajaxSettings.xhr = function() {
          try { return new ActiveXObject("Microsoft.XMLHTTP"); }
          catch(e) { }
          jQuery.support.cors = true;
      };
  }
  $.ajax({
    url:"customDepartmentsModuleActions.php",
    method:"GET",
    data:{
      createDepartment: name
    },
    success:function(response) {
      getDepartments();
      $("#createDepartmentModal").modal('toggle');
    },
    error:function(){
      console.log("ajax error");
    }
  });
}

function deleteDepartment(id) {
  if ('XDomainRequest' in window && window.XDomainRequest !== null) {
      jQuery.ajaxSettings.xhr = function() {
          try { return new ActiveXObject("Microsoft.XMLHTTP"); }
          catch(e) { }
          jQuery.support.cors = true;
      };
  }
  
  $.ajax({
    url:"customDepartmentsModuleActions.php",
    method:"GET",
    data:{
      deleteDepartment: id
    },
    success:function(response) {
      getDepartments();
    },
    error:function(){
      console.log("ajax error");
    }
  });
}