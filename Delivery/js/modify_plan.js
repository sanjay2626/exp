$("#save").on("click",function(){
  var col = $("#table");
  var d_inputs = col.find("input.data");
  var all_null = 1;
  for(var i=0;i<d_inputs.length;i++){
    if($(d_inputs[i]).val()!="" && $(d_inputs[i]).val()!=0){
      all_null=0;
      break;
    }
  }
  if(all_null==1){
    alert("Please fill at least one entry!");
    return false;
  }
  var fd = new FormData();
  var name = "";
  for(var i=0;i<d_inputs.length;i++){
    if($(d_inputs[i]).val()!="" && $(d_inputs[i]).val()!=0){
      name = $(d_inputs[i]).prop('name').split("~");
      fd.append("product["+name[0]+"]["+name[1]+"]",$(d_inputs[i]).val());
    }
  }


  //ajax
  $.ajax({
    url:"Ajax/modify.php",
    processData: false,
    contentType: false,
    data:fd,
    type:'POST',
    success: function(html){
      if(html == "Success"){
        alert("Successfully Modified!");
        location.reload();
      }else{
        console.log(html);
      }
    }
  })
})
