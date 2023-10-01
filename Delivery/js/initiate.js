$("#initiate").on("click",function(){
  var all_empty = 1;
  var form = $(this).closest("form");
  var att = form.find("input.data");
  var fd = new FormData();
  fd.append("table","delivery_data");
  fd.append("action","add");
  fd.append("attributes[id][value]",id);
  fd.append("attributes[id][type]","integer");
  for(var i=0; i<att.length;i++){
    if($(att[i]).prop('name')!=="" && $(att[i]).val()!= ""){
      all_empty=0;
      if($(att[i]).data('t')=="integer"){
        fd.append("attributes["+$(att[i]).prop('name')+"][value]",$(att[i]).val());
        fd.append("attributes["+$(att[i]).prop('name')+"][type]","integer");
      }else{
        fd.append("attributes["+$(att[i]).prop('name')+"][value]",$(att[i]).val());
        fd.append("attributes["+$(att[i]).prop('name')+"][type]","string");
      }

    }
  } //end loop
  if(all_empty == 1){
    alert("Please fill at least one field!");
    return false;
  }
  $.ajax({
    url:"Ajax/the_ajax.php",
    processData: false,
    contentType: false,
    data:fd,
    type:'POST',
    success: function(html){
      if(html=="Successful"){
        alert("Delivery initiated.. Please sign and upload the receipt!");
        
      }
      else{
        alert("Some error occured! Please retry..(Console might have more information)");
        console.log(html);
      }
    }
  });// ajax end
})
