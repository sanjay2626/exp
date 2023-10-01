<?php
  //ob_start();
  require '../check_login.php';
  require 'check_delivery_permission.php';
  require '../head.php';
?>
<style>
h3.light{
  padding:10px;
}
.row{
  margin-bottom: 20px
}
.error_div{
  padding: 5px;
  font-size:1em;
  font-weight: 400;
  background: #eeeeee;
  margin-top: 15px !important;
}
th{
  white-space: nowrap;
}
</style>
<h3 class="light text-center">View Deliveries</h3><hr style="margin-top:0px">
<form method="GET" action="">
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-sm-3">
      <h6 class="light">School</h6>
      <select name="school" class="form-control top" id="school_select">
        <?php foreach ($_SESSION['exp_dash_schools'] as $key => $value) { ?>
        <option <?php
          if(isset($school) && $school == $key){
            echo "selected";
          }
         ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="col-sm-3">
      <h6 class="light">Module</h6>
      <select name="module" class="form-control top" id="module_select">

      </select>
    </div>
    <div class="col-sm-3">
      <h6 class="light">Session</h6>
      <select name="session" id="session_select" class="form-control top">
        <option value="<?php echo date('Y', strtotime('-1 year'))."-".date('y'); ?>"><?php echo date('Y', strtotime('-1 year'))."-".date('y'); ?></option>
        <option value="<?php echo date('Y')."-".date('y', strtotime('+1 year')); ?>"><?php echo date('Y')."-".date('y', strtotime('+1 year')); ?></option>
      </select>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-md-2 col-sm-3">
      <button  type="button" id="generate"  class="btn btn-md btn-success">Search</button>
    </div>
  </div>
</div>
<h3 class="text-center error_div" style="display:none"  id="error_div"></h3>
<h3 id="error_div_2" class="text-center error_div" style="display:none"></h3>
</form>

<div class="plan-form container" style="display:none" id="delivery-form"></div>
<script>
  var module_name = <?php echo json_encode($_SESSION['module_name']); ?>;
</script>
<script type="text/javascript" src="js/view_delivery.js"></script>
<?php
  require '../footer.php';
?>
