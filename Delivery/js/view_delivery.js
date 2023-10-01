var module_select = $("#module_select");
var school_select = $("#school_select");
var session_drop = $("#session_select");

$("#school_select,#session_select").on("change",function(){
  $("#generate").prop("disabled",true);
  var school_id = school_select.val();
  var session = session_drop.val();
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
        //console.dir(maps);
        $.each(json.modules,function(key,value){
          module_select.append($("<option />").val(value).text(module_name[value]));
        });

        module_select.trigger("change");
        $("#generate").prop("disabled",false);
      }else{
        $("#error_div").show();
        $("#error_div").html(json.error);
      }
    }//success end
  })//ajax end
})//trigger end

$("#generate").on("click",function(){

  var module_id  = module_select.val();
  var school_id = school_select.val();
  var session = session_drop.val();

  var fd = new FormData();
  fd.append("module_id",module_id);
  fd.append("school_id",school_id);
  fd.append("session",session);

  $.ajax({
    url:"Ajax/get_deliveries.php",
    processData: false,
    contentType: false,
    data:fd,
    type:'POST',
    success: function(html){
      $("#delivery-form").html(html);
      $("#delivery-form").show();
    }
  })

})
school_select.trigger("change");
