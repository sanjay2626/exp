$("#search").on("click",function(){
  all_null = 1;
  data = {};
  if($("#from").val() !== ""){
    data.from_date = $("#from").val();
  }
  if($("#to").val() !== ""){
    data.to_date = $("#to").val();
  }
  $.ajax({
    url: "fetch_table.php",
    type: "POST",
    data: data,
    success: function(html){
      $("#table").html(html);
    }
  })
})
