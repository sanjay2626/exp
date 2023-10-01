<?php
  require '../connection.php';
  require '../check_login.php';
  require '../head.php';
  date_default_timezone_set('Asia/Kolkata');
  if(isset($_GET['to_date']) && isset($_GET['from_date'])){
    $from = mysqli_real_escape_string($con,$_GET['from_date']);
    $to = mysqli_real_escape_string($con,$_GET['to_date']);
    $plans = "SELECT id,school_id,module_id,from_date,to_date from plans
    where delete_flag=0 and from_date>='{$from}' and to_date<='{$to}'";

  }else{
    $plans = "SELECT id,school_id,module_id,from_date,to_date from plans
    where delete_flag=0 and to_date>=CURDATE()";
  }

  $plans_res = mysqli_query($con,$plans);
?>
<style>
  h4{
    margin-bottom:10px;

    font-weight: 400 !important;
  }
  .view{
    color: #0074D9;
    cursor: pointer
  }
  .delete{
    color:red;
    cursor: pointer;
  }
  input.form-control,select{
    padding:5px;
    max-width: 200px
  }
  form{
    margin-bottom: 20px
  }
</style>
<div class="container">
  <h3 style="padding-top: 20px; text-align:center" class="light">View/Modify Plans</h3><hr>
  <h5 style="text-align:center" class="light">Search for plans</h5>
  <form class="row justify-content-center">
    <div class="col-sm-3">
      <h5 class="light">School</h5>
      <select id="school" class="form-control" name="school">
        <?php foreach ($_SESSION['exp_dash_schools'] as $key => $value): ?>
          <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-sm-3">
      <h5 class="light">From Date</h5>
      <input id="from_date" class="form-control" type="date" name="from_date"></input>
    </div>
    <div class="col-sm-3">
      <h5 class="light">To Date</h5>
      <input id="to_date" class="form-control" type="date" name="to_date"></input>
    </div>
    <div class="col-sm-3">
      <button id='search' type="button" style="position:relative; top:32px" class="btn btn-md btn-primary">Search</button>
    </div>

  </form>
  <div class="row justify-content-center">
    <div class="col-sm-12">
      <div class="table-responsive table-striped">
        <table class="table">
          <thead id="thead" style="display:none" class="bg-dark text-white">
            <th>Module</th>
            <th>From</th>
            <th>To</th>
            <th>Sessions</th>
            <th>View/Edit</th>
            <th>Delete</th>
          </thead>
          <tbody id="tbody">

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
    $(".delete").on('click',function(){
      var id = $(this).data("t");
      if(confirm("Are you sure you want to delete this plan")){
        window.open("delete_plan.php?id="+id,"_self");
      }
    })
    $(".view").on('click',function(){
      var id = $(this).data("t");
        window.open("view.php?plan_id="+id,"_self");
    })
    $("#same").on('click',function(){
      window.open("view_plan.php","_self");
    })

    $("#school").on('change',function(){
      data = {
        school_id: $(this).val()
      }

      $.ajax({
        url: "Ajax/fetch_latest_date.php",
        data: data,
        dataType: "json",
        type: 'POST',
        success: function(data){
          if(data["from"] !== undefined){
            $("#from_date").val(data["from"]);
            $("#to_date").val(data["to"]);
          }else{
            alert("No session planned for this school!");
          }
        }
      }) // ajax call end
    }) // school change trigger end
    $("#school").trigger("change");

    $("#search").on("click",function(){
      var data = {
        school_id: $("#school").val()
      }
      if($("#from_date").val() != ""){
        data.from_date = $("#from_date").val();
      }
      if($("#to_date").val() != ""){
        data.to_date = $("#to_date").val();
      }

      $.ajax({
        url: "Ajax/fetch_plans.php",
        data: data,
        type: 'POST',
        success: function(html){
          $('#tbody').html(html);
          $(".delete").on('click',function(){
            var id = $(this).data("t");
            if(confirm("Are you sure you want to delete this plan")){
              window.open("delete_plan.php?id="+id,"_self");
            }
          })
          $(".view").on('click',function(){
            var id = $(this).data("t");
              window.open("view.php?plan_id="+id,"_self");
          })
          $("#thead").show();
        }
      })
    })
  })
</script>
<?php
  require '../footer.php';
 ?>
