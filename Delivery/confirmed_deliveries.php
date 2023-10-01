<?php
  require 'check_login_confirm.php';
  require '../head.php';
  $query = "SELECT id,name from school where id in(".$_SESSION['school_id'].") and delete_flag=0";
  $school_names = mysqli_query($con,$query) or die(mysqli_error($con));
  while($sch = mysqli_fetch_assoc($school_names)){
    $school_name[$sch['id']]=$sch['name'];
  }
  // echo $query;
  // print_r($school_name);
?>
<style>
  td,th{
    text-align: center;
  }
</style>
<div class="container-fluid">
  <h3 class="light text-center" style="padding:20px">Confirmed deliveries</h3><hr style="margin-top:0px">
  <div class="container">

    <div class="row justify-content-center">
      <div style="margin-bottom:20px" class="col-sm-3">
        <h6 class="light">School</h6>
        <select name="school" class="form-control top" id="school_select">
          <?php foreach ($school_name as $key => $value) { ?>
            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
          <?php } ?>
        </select>
      </div>
      <div style="margin-bottom:20px" class="col-sm-3">
        <h6 class="light">Session</h6>
        <select name="session" id="session_select" class="form-control top">
          <option value="<?php echo date('Y', strtotime('-1 year'))."-".date('y'); ?>"><?php echo date('Y', strtotime('-1 year'))."-".date('y'); ?></option>
          <option value="<?php echo date('Y')."-".date('y', strtotime('+1 year')); ?>"><?php echo date('Y')."-".date('y', strtotime('+1 year')); ?></option>
        </select>
      </div>
    </div>
    <div style="margin-bottom:20px" class="row justify-content-center">
      <button id="search" type="button" class="btn btn-success btn-md">Search</button>
    </div>
    <div id="table_div" class="table-responsive">

     </div>
   </div>
  </div>
  <script type="text/javascript" src="js/confirmed_deliveries.js"></script>
<?php
  require '../footer.php';
?>
