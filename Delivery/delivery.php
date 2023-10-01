<?php
  //ob_start();
  require '../check_login.php';
  require 'check_delivery_permission.php';
  require '../head.php';
  $no_plans=0;
  if(isset($_GET['school']) && isset($_GET['module']) && isset($_GET['session'])){
    $school = mysqli_real_escape_string($con,$_GET['school']);
    $session = mysqli_real_escape_string($con,$_GET['session']);
    $module = mysqli_real_escape_string($con,$_GET['module']);
    $module_category_query = "SELECT category FROM module where id={$module} and delete_flag=0";
    $result = mysqli_query($con,$module_category_query) or die(mysqli_error($con));
    $category = mysqli_fetch_row($result)[0];

    $product_query = "SELECT P.*,L.language as lang,B.board_name from product as P
    LEFT JOIN languages as L on L.language_id = P.language
    LEFT JOIN boards as B on B.board_id = P.board
    where id in
    (SELECT product_id from module_product
      where module_id={$module}) and P.delete_flag=0";
    $result = mysqli_query($con,$product_query) or die(mysqli_error($con));
    while($p_row = mysqli_fetch_assoc($result)){
      $product[$p_row['id']]['name'] = $p_row['name'];
      $product[$p_row['id']]['language'] = $p_row['lang'];
      $product[$p_row['id']]['board'] = $p_row['board_name'];
    }


    $plans_query = "SELECT * from delivery_plan as D
    where D.session='{$session}'
    and D.school_id={$school} and D.module_id={$module} and D.delete_flag=0 ORDER BY id";


    $plans_result = mysqli_query($con,$plans_query) or die(mysqli_error($con));
    $no_plans=0; // for showing error in error div if no plan exists
    if(!(mysqli_num_rows($plans_result)>0)){
      $no_plans=1;
    }else{
      $plan = [];
      $grades = [];
      if ($category==0) {
        while($p = mysqli_fetch_assoc($plans_result)){
          for ($i=1; $i < 11; $i++) {
            if(is_null($p['grade_'.$i])==false){
              array_push($grades,$i);
            }
          }
          array_push($plan,$p);
        }
        $grades = array_unique($grades,SORT_NUMERIC);

      }else{
        while($p = mysqli_fetch_assoc($plans_result)){
          array_push($plan,$p);
        }
      }
      $sub_id= $plan[0]['sub_id'];

      ?>
      <script>
        var sub_id = <?php echo json_encode($sub_id); ?>;
      </script>
      <?php
      if($category == 1){
        $delivered_query = "SELECT P.product_id,D.plan_id,SUM(D.school_specific) as count from delivery_data as D
        INNER JOIN delivery_plan as P on D.plan_id=P.id
        where delivery_id in (SELECT delivery_id from delivery_status where plan_sub_id='{$sub_id}' and delete_flag=0) and D.delete_flag=0 GROUP BY plan_id ORDER BY plan_id";
      }else{
        $delivered_query = "SELECT P.product_id,D.plan_id,";
        for($i = 1; $i<11; $i++) {
          $delivered_query.="SUM(D.grade_{$i}) as grade_{$i},";
        }
        $delivered_query = trim($delivered_query,",");
        $delivered_query.="
         from delivery_data as D
        INNER JOIN delivery_plan as P on D.plan_id=P.id
        where delivery_id in (SELECT delivery_id from delivery_status where plan_sub_id='{$sub_id}' and delete_flag=0) and D.delete_flag=0 GROUP BY plan_id ORDER BY plan_id";
      }
        $delivery_res = mysqli_query($con,$delivered_query) or die(mysqli_error($con));
        //anything has been delivered or not
        if(mysqli_num_rows($delivery_res)>0){
          $del =1;
        }else{
          $del =0;
        }
      }
    }

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
<div class="container-fluid">
  <h3 class="light text-center">Initiate Delivery</h3><hr style="margin-top:0px">
  <form method="GET" action="">
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
      <button  type="submit" id="generate"  class="btn btn-md btn-success">Generate Form</button>
    </div>
  </div>
  <h3 class="text-center error_div" style="display:none"  id="error_div"></h3>
  <h3 id="error_div_2" class="text-center error_div" <?php if($no_plans==0){ ?>style="display:none" <?php } ?>  ><?php if($no_plans==1) echo "No plans found!" ?></h3>
</form>
<!-- Top form end -->
    <?php
    if(isset($_GET['school']) && isset($_GET['module']) && isset($_GET['session']) && $no_plans==0){
        while($delivery = mysqli_fetch_assoc($delivery_res)){
          $delivered[$delivery['product_id']]['name'] = $product[$delivery['product_id']]['name'];;
          $delivered[$delivery['product_id']]['language'] = $product[$delivery['product_id']]['language'];
          $delivered[$delivery['product_id']]['board'] = $product[$delivery['product_id']]['board'];
          if($category == 1){
            $delivered[$delivery['product_id']]['count'] = $delivery['count'];
          }else{
            foreach($grades as $grade) {
              $delivered[$delivery['product_id']]['grade_'.$grade] = $delivery['grade_'.$grade];
            }
          }
        }
        // print_r($delivered);
      ?>
        <div style="margin-top:20px" class="row">
          <div class="col-sm-12">
            <h4 class="light text-center">Delivery Table</h4>
            <h5 class="light text-center">School: <span class="school"></span> , Module: <?php echo $_SESSION['module_name'][$module]; ?> , Session: <?php echo $session; ?></h5>
            <div style="margin-bottom:20px" class="table-responsive">
              <table style="margin-bottom:0px" class="table table-bordered shadow">
                <thead class="table-dark text-white">
                  <tr>
                    <th>Products</th>
                    <th>Language</th>
                    <th>Board</th>
                    <?php if($category == 0){

                      foreach($grades as $grade) {

                        ?>
                        <th>Grade <?php echo $grade; ?></th>

                    <?php } }else{ ?>
                      <th>Quantity</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    foreach($plan as $plan){
                  ?>
                  <tr>
                    <td><?php echo $product[$plan['product_id']]['name']; ?></td>
                    <td><?php echo $product[$plan['product_id']]['language']; ?></td>
                    <td><?php echo $product[$plan['product_id']]['board']; ?></td>
                  <?php
                    if($category == 1){
                      echo "<td><input type='number' class='form-control data' name='{$plan['id']}~school_specific' min='0' ";
                      if(isset($delivered[$plan['product_id']]['count'])){
                        $diff = $plan['school_specific'] - $delivered[$plan['product_id']]['count'];
                        echo " value={$diff} ";
                        if ($diff == 0){
                          echo "disabled ";
                        }
                      }else{
                        echo " value={$plan['school_specific']} ";
                      }

                      echo "/></td>";
                    }else{
                      foreach($grades as $grade) {
                        echo "<td><input style='padding:5px' type='number' class='form-control data' name='{$plan['id']}~grade_{$grade}' min='0'";
                        if(isset($delivered[$plan['product_id']]['grade_'.$grade])){
                          $diff = $plan['grade_'.$grade] - $delivered[$plan['product_id']]['grade_'.$grade];
                          echo " value={$diff} ";
                          if ($diff == 0){
                            echo "disabled ";
                          }
                        }else{
                          echo " value={$plan['grade_'.$grade]} ";
                        }

                         echo " /></td>";
                      }
                    }
                  ?>
                  </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <div class="row justify-content-center">
              <button data-school="<?php echo $school; ?>" type="button" class="initiate btn btn-md btn-success">Initiate</button>
            </div>
          </div>
          <!-- Delivery Table end -->
          <!-- Already Delivered Start -->
          <?php if($del == 1){ ?>
          <div class="col-sm-12">

              <h4 class="light text-center">Delivered Table</h4>
              <h5 class="light text-center">School: <span class="school"></span> , Module: <?php echo $_SESSION['module_name'][$module]; ?> , Session: <?php echo $session; ?></h5>
              <div style="margin-bottom:20px" class="table-responsive">
                <table style="margin-bottom:0px" class="table table-bordered shadow">
                  <thead class="table-dark text-white">
                    <tr>
                      <th>Products</th>
                      <th>Language</th>
                      <th>Board</th>
                      <?php if($category == 0){

                        foreach($grades as $grade) {

                          ?>
                          <th>Grade <?php echo $grade; ?></th>

                      <?php } }else{ ?>
                        <th>Quantity</th>
                      <?php } ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach($delivered as $delivered){
                    ?>
                    <tr>
                      <td><?php echo $delivered['name']; ?></td>
                      <td><?php echo $delivered['language']; ?></td>
                      <td><?php echo $delivered['board']; ?></td>
                    <?php
                      if($category == 1){
                        echo "<td>{$delivered['count']}</td>";
                      }else{
                        foreach($grades as $grade) {
                          echo "<td>{$delivered['grade_'.$grade]}</td>";
                        }
                      }
                    ?>
                    </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
          </div>
        <?php }else{ ?>
          <h3 style="width:100%; "  class="text-center error_div">No deliveries so far!</h3>
        <?php  } ?>
        </div>
        <?php

      }  ?>

</div>
<script>
  var module_name = <?php echo json_encode($_SESSION['module_name']); ?>;
  <?php
  if(isset($module)){
    ?>
    module_get = <?php echo $module; ?>;
    <?php
  }
  ?>
  $(".school").html($("#school_select option:selected").text());
</script>
<script type="text/javascript" src="js/delivery.js"></script>

<?php
  require '../footer.php';
?>
