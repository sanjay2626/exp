var module_select = $("#module_select");
var school_select = $("#school_select");
var session_drop = $("#session_select");

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
        grades = json.grades;
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
school_select.trigger("change");

//generate form
function cancel_bind(){
  $(".cancel").on("click",function(){
    $("#delivery-form").html("");
    $("#delivery-form").hide();
    $(".top").prop("disabled",false);
  })
}
function add_bind(){
$(".add").on("click",function(){
  var all_empty = 1;
  var form = $("#delivery-form table");
  var att = form.find("input.data");
  var fd = new FormData();
  fd.append("table","delivery_plan");
  fd.append("action","add");
  fd.append("school_id",school_select.val());
  fd.append("session",session_drop.val());
  fd.append("module_id",module_select.val());
  var name = "";
  for(var i=0;i<att.length;i++){
    if($(att[i]).val()!="" && $(att[i]).val()!=0){
      if(all_empty == 1)
      all_empty=0;

      name = $(att[i]).prop('name').split("~");
      fd.append("product["+name[0]+"]["+name[1]+"]",$(att[i]).val());
    }
  } //end loop
  if(all_empty == 1){
    alert("Please fill atleast one field!");
    return false;
  }
  $.ajax({
    url:"Ajax/plan_ajax.php",
    processData: false,
    contentType: false,
    data:fd,
    type:'POST',
    success: function(html){
      if(html=="successful"){
        alert("Plan has been added!");
        $(".top").prop("disabled",false);
        $("#delivery-form").html("");
        $("#delivery-form").hide();
        $(".top").prop("disabled",false);
      }
      else{
        alert("Some error occured! Please retry..(Console might have more information)");
        console.log(html);
      }
    }
  });// ajax end
})
}// Binding function end (add)


$("#generate").on("click",function(){
  $(".top").prop("disabled",true);
  var module_id  = module_select.val();
  var school_id  = school_select.val();
  var session  = session_drop.val();
  var fd = new FormData();

  fd.append("maps",JSON.stringify(maps));
  fd.append("grades",JSON.stringify(grades));
  fd.append("module_id",module_id);
  fd.append("school_id",school_id);
  fd.append("session",session);
  fd.append("category",module_cat[module_id]);
  $.ajax({
    url:"Ajax/get_plan_form.php",
    processData: false,
    contentType: false,
    data:fd,
    type:'POST',
    success: function(html){
      if (html=="Already Exists") {
       alert("A delivery plan for the specified school and module already exists!");
       $(".top").prop("disabled",false);
       return false;
      }else if(html == "No Module-Product Mapping Found"){
        alert(html);
        $(".top").prop("disabled",false);
        return false;
      }
      $("#delivery-form").html(html);
      $("#delivery-form").show();
      cancel_bind();
      add_bind();
    }
  })

})
