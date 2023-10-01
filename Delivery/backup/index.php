<?php
  require '../check_login.php';
  require '../head.php';
  $module_category_query = "SELECT * FROM module where delete_flag=0";
  $result = mysqli_query($con,$module_category_query);
  while ($row = mysqli_fetch_assoc($result)) {
    $module_cat[$row['id']] = $row['category'];
  }
?>
<style>
  h3.light{
    padding:10px;
  }
  #error_div{
    padding: 5px;
    font-size:1em;
    font-weight: 400;
    background: #eeeeee;
    margin-top: 15px !important;
  }
  #form{
    margin-bottom: 20px
  }
  input[type=number]{
    margin-bottom: 15px
  }
  .col-md-2.col-sm-3{
    margin-bottom: 15px
  }
</style>
<div class="container-fluid">
  <h3 class="light text-center">Plan Delivery</h3><hr style="margin-top:0px">
  <form id="form">
    <div style="margin-bottom:15px" class="row justify-content-center">
      <div class="col-md-2 col-sm-3">
        <h5 class="light">Select School</h5>
        <select class="form-control top" id="school_select">
          <?php foreach ($_SESSION['exp_dash_schools'] as $key => $value) { ?>
          <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="col-md-2 col-sm-3">
        <h5 class="light">Select Session</h5>
        <select id="session_select" class="form-control top">
          <option value="<?php echo date('Y', strtotime('-1 year'))."-".date('y'); ?>"><?php echo date('Y', strtotime('-1 year'))."-".date('y'); ?></option>
          <option value="<?php echo date('Y')."-".date('y', strtotime('+1 year')); ?>"><?php echo date('Y')."-".date('y', strtotime('+1 year')); ?></option>
        </select>
      </div>
      <div class="col-md-2 col-sm-3">
        <h5 class="light">Select Module</h5>
        <select class="form-control top" id="module_select">

        </select>
      </div>
      <div class="col-md-2 col-sm-3 dependent">
        <h5 class="light">Language</h5>
        <select class="form-control top" id="language_select">

        </select>
      </div>
      <div class="col-md-2 col-sm-3 dependent">
        <h5 class="light">Board</h5>
        <select class="form-control top" id="board_select">

        </select>
      </div>

    </div>
    <div class="row justify-content-center">
      <div class="col-md-2 col-sm-3">
        <button  type="button" id="generate"  class="btn btn-md btn-success">Generate Form</button>
      </div>
    </div>

  </form>
  <h3 class="text-center" style="display:none"  id="error_div"></h3>
  <div class="plan-form" style="display:none" id="delivery-form">
    <div class="container">
    <div class="row">
    <?php for($i=1;$i<11;$i++){ ?>
      <div class="col-sm-2 col-6">
        <h5 class="light">Grade <?php echo $i; ?></h5>
        <input data-t="integer" type="number" name="grade_<?php echo $i; ?>" class="form-control data"></input>
      </div>
    <?php } ?>
    </div>
    <div class="row justify-content-center">
      <button  style="margin-right:20px" type="button" class="btn btn-md btn-primary add">Add Plan</button>
      <button type="button" class="btn btn-md cancel">Cancel</button>
    </div>
  </div>
  </div>
  <div class="plan-form" style="display:none" id="delivery-form-2">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-sm-3">
          <h5 class="light">Quantity</h5>
          <input data-t="integer" class="form-control data" type="number" name="school_specific"></input>
        </div>
      </div>
      <div class="row justify-content-center">
        <button  style="margin-right:20px" type="button" class="btn btn-md btn-primary add">Add Plan</button>
        <button type="button" class="btn btn-md cancel">Cancel</button>
      </div>
    </div>
  </div>
</div>
<script>
  var module_name = <?php echo json_encode($_SESSION['module_name']); ?>;
  var module_cat = <?php echo json_encode($module_cat); ?>;
</script>
<script type="text/javascript" src="js/main.js"></script>
<?php
  require '../footer.php';
?>
