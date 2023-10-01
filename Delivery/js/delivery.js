var module_select = $("#module_select");
var school_select = $("#school_select");
var session_drop = $("#session_select");
var maps = "";

$("#school_select,#session_select").on("change",function(){
  $("#generate").prop("disabled",true);

  var school_id = school_select.val();
  var session = session_drop.val();

  if (typeof module_get === 'undefined') {
    $("#error_div_2").hide();
  }
  $.ajax({
    url: "Ajax/get_modules.php",
    dataType: "json",
    type : "POST",
    data: {school_id:""+school_id ,session: ""+session},
    success: function(json){
      if(json.error == ""){
        module_select.html("");
        $("#error_div").hide();
        $("#error_div").html("");
        maps = json.mappings;
        $.each(json.modules,function(key,value){
          module_select.append($("<option />").val(value).text(module_name[value]));
        });
        if (typeof module_get !== 'undefined' && module_get != "") {
          $("#module_select option[value="+module_get+"]").prop("selected",true);
          delete module_get;
        }
        $("#generate").prop("disabled",false);
      }else{
        $("#error_div").show();
        $("#error_div").html(json.error);
      }
    }//success end
  })//ajax end
})//trigger end
school_select.trigger("change");


$(".initiate").on("click",function(){
  var col = $(this).closest(".col-sm-12");
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
  fd.append("plan_sub_id",sub_id);

  //ajax
  $.ajax({
    url:"Ajax/delivery_ajax.php",
    processData: false,
    contentType: false,
    data:fd,
    type:'POST',
    success: function(html){
      if(html == "Success"){
        alert("Successfully Added!");
        location.reload();
      }else{
        console.log(html);
      }
    }
  })
})
