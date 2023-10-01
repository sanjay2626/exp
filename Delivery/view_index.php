<?php
  require '../check_login.php';
  require 'check_delivery_permission.php';
  require '../head.php';

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
  .modify{
    color: #0074D9;
    cursor: pointer
  }
  .del{
    color:red;
    cursor: pointer
  }
  .initiate{
    color:green;
    cursor: pointer
  }
  #table_div{
    margin-top: 20px
  }
</style>
<div class="container-fluid">
  <h3 class="light text-center">View Delivery Plans</h3><hr style="margin-top:0px">
  <form id="form">
    <div style="margin-bottom:15px" class="row justify-content-center">
      <div class="col-md-3 col-sm-4">
        <h5 class="light">Select School</h5>
        <select style="margin-bottom:15px" class="form-control top" id="school_select">
          <?php foreach ($_SESSION['exp_dash_schools'] as $key => $value) { ?>
          <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="col-md-3 col-sm-4">
        <h5 class="light">Select Session</h5>
        <select id="session_select" class="form-control top">
          <option value="<?php echo date('Y', strtotime('-1 year'))."-".date('y'); ?>"><?php echo date('Y', strtotime('-1 year'))."-".date('y'); ?></option>
          <option value="<?php echo date('Y')."-".date('y', strtotime('+1 year')); ?>"><?php echo date('Y')."-".date('y', strtotime('+1 year')); ?></option>
        </select>
      </div>
      <div class="col-md-3 col-sm-4">
        <button style=" margin-top:32px" id="search" type="button" class="btn btn-primary btn-md">Search</button>
      </div>
    </div>
  </form>
    <div id="table_div" class="container-fluid table-responsive"></div>
</div>
  <script type="text/javascript" src="js/view_index.js"></script>

<?php
  require '../footer.php';
?> 
