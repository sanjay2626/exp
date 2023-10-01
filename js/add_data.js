function disable_top_row(){
  $(".top_row").find("select").prop("disabled",true);
}
function enable_top_row(){
  $(".top_row").find("select").prop("disabled",false);
}
var lock = 1;
var counter = 'a';
var session_success = "<div style='display:flex; background-color:#2ECC40; color:white; height:600px; align-items: center;justify-content: center;'><h2 class='light' align='center'>Session Saved Successfully!</div>";
var session_cancel = "<div style='display:flex; background-color:#9FA8DA; color:white; height:600px; align-items: center;justify-content: center;'><h2 class='light' align='center'>Session Cancelled!</div>";
function add_session(program,
  category,
  project,
  board,
  language,
  school,
  module_name){
  if(lock==0){
    alert("Please Submit or Cancel the current session entry first!");
    return;
  }
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1;
var yyyy = today.getFullYear();

if(dd<10) {
    dd = '0'+dd
}

if(mm<10) {
    mm = '0'+mm
}

today = yyyy + '-' + mm + '-' + dd;
  //form 
  var form = '<div style="padding:20px; margin-bottom:15px;" class="session_form shadow">'+
  '<h5 class="light" align="center">Fill Session Details</h5><hr>'+
  '<form data-session="'+category+'" enctype="multipart/form-data" id="form-'+counter+'_'+program+'_'+project+'_'+board+'_'+language+'_'+school+'_'+module_name+'" action="" method="post">'+
'<div class="row justify-content-center">\
  <div class="col-sm-4 form_pad col-md-3"  >\
    <h5 class="light">Start Date</h5>\
    <input name="s_date" value="'+today+'" class="form-control" type="date" required></input>\
  </div>\
    <div class="col-sm-4 form_pad col-md-3">\
      <h5 class="light">End Date</h5>\
      <input name="e_date" value="'+today+'" class="form-control" type="date" required></input>\
    </div>\
</div>\
<div class="row justify-content-center">\
   \
    <div class="row">\
      <div class="col-sm-6">\
      <h5 class="light">Session Summary</h5>\
        <textarea style="min-height:150px !important" name="summary" col="10" class="form-control" required></textarea>\
      </div>\
      <div class="col-sm-6" style="padding-top:32px" align="center" >\
        <div class="form-control" style="min-height:150px">\
        <h5 class="light" align="center">(Click Browse to upload image/video from your system)</h5><hr>\
        <div class="row">\
          <div class="col-sm-4">\
            <input onchange="file_list(this)" type="file" multiple accept="image/*" id="file-'+counter+'" name="files[]" style="display:none" multiple/>\
            <input style="margin-bottom:10px" type="button" class="btn btn-primary btn-lg" value="Browse" onclick="file_click(this)" />\
          </div>\
          <div class="col-sm-8">\
            <h5 class="light" align="center">Your Uploads</h5>\
            <ul style="padding-left:15px" class="uploads_list">\
            </ul>\
          </div>\
        </div>\
      </div>\
      </div>\
    </div>\
  <div style="text-align:center; width:100%"><button type="button" onclick="f_submit(this)" class="btn btn-success btn-lg">Submit</button><button style="margin-left:20px" type="button" onclick="cancel_form(this)" class="btn btn-danger btn-lg">Cancel</button></div>\
  </form>\
  </div><hr style="margin-top:0px">';
//adding form to the top of container div
  $(form).prependTo("#content").hide().slideDown(700).fadeIn(700);
  
  //Copy session code
    if(typeof cp !== undefined){
        $("#start_time").val(cp["from_time"].substr(0,5));
        $("#end_time").val(cp["to_time"].substr(0,5));
        $("#grade").val(cp["grade"]);
        $("#section").val(cp["section"]);
        // $('#section option[value="'+cp['section']+'"]').prop("selected", "selected");
        $("#topic").val(cp["topic_chapter"]);
        $("#batch_size").val(cp["batch_size"]);
        $("#student_count").val(cp["student_count"]);
        $("#activity").val(cp["activity"]);
    }
  //Copy session code
  lock = 0;
  disable_top_row();
  $('#form-'+counter+'_'+program+'_'+project+'_'+board+'_'+language+'_'+school+'_'+module_name).validate({
    ignore: [],
    rules:{
      summary: "required",
      s_date:"required",
      from_time:"required",
      to_time:"required",
      grade:"required",
      section:"required",
      module:"required",
      product:"required",
      activity:"required",
      batch_size:"required",
      student_count:"required",
      rate:"required",
      "files[]  ":{
        extension:"avi|mov|wmv|mp4|webm|flv|png|bmp|gif|tiff|jpeg|jpg"
      }
    },
    messages:{
      "files[]":{
        extension:"Invalid Format! Use one of the following:-<br>avi|mov|wmv|mp4|webm|flv|png|bmp|gif|tiff|jpeg|jpg"
      }
    }
  });
  //$('#form-'+counter+'_'+program+'_'+category_name).find("select[name='module']").trigger("change");
counter = String.fromCharCode(counter.charCodeAt(0) + 1);
}


//fills product dropdown
/*function fill_product(elem){
  mod = $(elem).val();
  $.ajax({
    method:'GET',
    url:"Ajax_pages/get_product.php",
    data:{modl: mod},
    success: function(html){
      $(elem).parent().next().find('select[name="product"]').html(html);
      //alert((elem).closest("select[name='section']").prop('name'));
    },
    error: function(jqXHR){
      alert("error: "+jqXHR.responseText);
      console.log(jqXHR.responseText);
    }
  });
}*/
//function for submitting form
function f_submit(button){
  $(button).text("Uploading..Please Wait...");
  $(button).prop("class","btn btn-basic btn-lg");
  $(button).prop("disabled",true);
  var form_data = $(button).closest("form").prop("id");
  if($("#"+form_data).valid()){
    //if form is valid
    var fd = new FormData();
    var f = document.getElementById(form_data);
    //selecting all the inputs within the form
    var elements = f.querySelectorAll("input");
    var textareas = f.querySelectorAll("textarea");

    for(var inp of elements){
      // if input type is button dont send value in form
      if($(inp).prop("type")=="button"){
        continue;
      }
      // if input type is file upload all the files to an array
      if($(inp).prop("type")=="file"){
       var file_id = $(inp).prop("id");
       var ins = document.getElementById(file_id).files.length;
       for (var x = 0; x < ins; x++) {
         fd.append("files[]", document.getElementById(file_id).files[x]);
        }
        continue;
      }
      fd.append($(inp).prop("name"),$(inp).val());
    }
    //adding session to form data
    fd.append("session",$("#"+form_data).data("session"));
    var selects = f.querySelectorAll("select");
    for(var inp of selects){
      fd.append($(inp).prop("name"),$(inp).val());
    }

    for(var ta of textareas){ 
      fd.append($(ta).prop("name"),$(ta).val());
    }

 
  fd.append('id',form_data);
     $.ajax({
      url:"Ajax_pages/upload_form.php",
      processData: false,
      contentType: false,
      data: fd,
      cache: false,
      type: 'POST',
      success: function(html){
        if(html=="success"){
          $("#"+form_data).parent().next().hide();
          $("#"+form_data).closest(".session_form").html(session_success).delay(500).fadeOut(700,function(){  $("#content").html(''); });
          lock=1;
          enable_top_row();
        }else if(html == "file extension error"){
          alert("Invalid File Format:\n Use one of the following:- png|gif|jpeg|jpg ");
           $(button).prop("disabled",false);
            $(button).text("Submit");
            $(button).prop("class","btn btn-success btn-lg");
        }else{
           alert("Something went wrong!\nError: "+html);
           $(button).prop("disabled",false);
            $(button).text("Submit");
            $(button).prop("class","btn btn-success btn-lg");
        }
      }
    });
    //form valid end
        }
        else {
            alert('Entries are not valid!!');
            $(button).prop("disabled",false);
            $(button).text("Submit");
            $(button).prop("class","btn btn-success btn-lg");
 
        }
      }
//form cancel
function cancel_form(button){
  var form_data = $(button).closest("form").prop("id");
  $("#"+form_data).parent().next().hide()
  $("#"+form_data).closest(".session_form").html(session_cancel).delay(500).fadeOut(700,function(){  $("#content").html(''); });
  lock=1;
  enable_top_row();
}

// function for opening browse on input type file
function file_click(but){
  $(but).parent().find("input[type='file']").trigger("click");
}
//function for showing the uploaded files
function file_list(inp){
  var list = $(inp).parent().next().find("ul");
  list.html("");
  var files = inp.files;
  var file;
  for (var i = 0; i < files.length; i++) {
    file = files[i];
    $(list).append("<li>"+file.name+"</li>");
  }
}
