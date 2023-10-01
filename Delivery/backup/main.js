var module_select = $("#module_select");
var school_select = $("#school_select");
var session_drop = $("#session_select");
var language_drop = $("#language_select");
var board_drop = $("#board_select");
var maps = [];
//module dropdown event
module_select.on("change",function(){
  if(module_cat[$(this).val()] == 1){
    $(".dependent").hide();
  }else{
    $(".dependent").show();
  }
})
module_select.trigger("change");

//school dropdown event
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
        language_drop.html("");
        board_drop.html("");

        $.each(json.modules,function(key,value){
          module_select.append($("<option />").val(value).text(module_name[value]));
        });

        $.each(maps,function(key,value){
          //alert(value.language_id);
          if($("#language_select option[value="+value.language_id+"]").length == 0)
          language_drop.append($("<option />").val(value.language_id).text(value.language));
        })

        $.each(maps,function(key,value){
          //alert(value.school_board);
          if($("#board_select option[value="+value.school_board+"]").length == 0)
          board_drop.append($("<option />").val(value.school_board).text(value.board_name));
        })
        //console.dir(maps);
        //each end
        module_select.trigger("change");
        $("#generate").prop("disabled",false);
      }else{
        $("#error_div").show();
        $("#error_div").html(json.error);
      }
    }//success end
  })//ajax end
})//trigger end
school_select.trigger("change");

//generate form
$(".cancel").on("click",function(){
  var form = $(this).closest(".plan-form");
  var inputs = form.find("input");
  for(var i=0; i<inputs.length;i++){
    $(inputs[i]).val("");
  }
  form.hide();
  $(".top").prop("disabled",false);
})

$(".add").on("click",function(){
  var all_empty = 1;
  var form = $(this).closest(".plan-form");
  var att = form.find("input.data");
  var fd = new FormData();
  fd.append("table","delivery_plan");
  fd.append("action","add");
  fd.append("attributes[school_id][value]",school_select.val());
  fd.append("attributes[school_id][type]","integer");
  if(module_cat[module_select.val()] == 0){
    fd.append("attributes[language_id][value]",language_drop.val());
    fd.append("attributes[language_id][type]","integer");
    fd.append("attributes[board_id][value]",board_drop.val());
    fd.append("attributes[board_id][type]","integer");
  }
  fd.append("attributes[session][value]",session_drop.val());
  fd.append("attributes[session][type]","string");
  fd.append("attributes[module_id][value]",module_select.val());
  fd.append("attributes[module_id][type]","integer");
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
    alert("Please fill atleast one field!");
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
        alert("Plan has been added!");
        for(var i=0; i<att.length;i++){
          if($(att[i]).prop('type')=="number")
          $(att[i]).val('');
        }
        $(".top").prop("disabled",false);
        form.hide();
      }  else if (html=="Already Exists") {
        alert("A delivery plan for the specified school and module already exists!");
      }
      else{
        alert("Some error occured! Please retry..(Console might have more information)");
        console.log(html);
      }
    }
  });// ajax end
})
$("#generate").on("click",function(){
  $(".top").prop("disabled",true);
  var school_id  = school_select.val();
  var module_id  = module_select.val();
  var session = session_drop.val();
  if(module_cat[module_id] == 0){
    var language = language_drop.val();
    var board = board_drop.val();
    $("#delivery-form").show();
    var inps = $("#delivery-form").find("input.data");
    for (var i = 0; i < inps.length; i++) {
      $(inps[i]).val(maps[0][""+$(inps[i]).prop("name")]);
    }
  }else{
    $("#delivery-form-2").show();
  }

})
