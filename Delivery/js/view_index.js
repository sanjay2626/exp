$("#search").on("click",function(){
  var school = $("#school_select").val();
  var session = $("#session_select").val();
  if(session != "" && school != ""){
    $.ajax({
      url: "Ajax/view_table.php",
      data: {school,session},
      type: "POST",
      success: function(html){
        $("#table_div").html(html);
        delete_bind();
        modify_bind();
        initiate_bind();
      },
    });
  }

})
function delete_bind(){
$(".del").on("click",function(){
  var id = $(this).data('t');
  if(confirm("Are you sure you want to delete this entry")){
    $.ajax({
      url:"Ajax/delete_plan.php",
      type: "POST",
      data:{id},
      success: function(html){
        if(html=="success"){
          $("#search").trigger("click");
        }else{
          alert(html);
        }
      }
    }); //ajax end
  } // if end
})
} // delete_bind end

function modify_bind(){
  $(".modify").on("click",function(){
    window.open("modify_delivery_plan.php?sub_id="+$(this).data('t'),"_self");
  })
}

function initiate_bind(){
  $(".initiate").on("click",function(){
    window.open("initiate_delivery.php?id="+$(this).data('t'),"_self");
  })
}
