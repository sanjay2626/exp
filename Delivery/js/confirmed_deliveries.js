school_drop = $("#school_select");
session_drop = $("#session_select");
$("#search").on('click',function(){
  
  $.ajax({
    url: "Ajax/confirmed_search.php",
    type: "POST",
    data: {school:school_drop.val(), session: session_drop.val()},
    success: function(html){
      $("#table_div").html(html);
    }
  })
})
