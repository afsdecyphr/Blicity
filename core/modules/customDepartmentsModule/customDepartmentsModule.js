function getDepartments() {
  $.ajax({
    url:"actions.php",
    method:"GET",
    data:{
      getDepartments: '1'
    },
    success:function(response) {
      $('#departmentsTableBody').html(response);
    },
    error:function(){
      console.log("ajax error");
    }
  });
}