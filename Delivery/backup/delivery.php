<?php
  //ob_start();
  require '../check_login.php';
  require '../head.php';
  $no_plans=0;
  if(isset($_GET['school']) && isset($_GET['module']) && isset($_GET['session'])){
    $school = mysqli_real_escape_string($con,$_GET['school']);
    $session = mysqli_real_escape_string($con,$_GET['session']);
    $module = mysqli_real_escape_string($con,$_GET['module']);
    $module_category_query = "SELECT category FROM module where module_id={$module} and delete_flag=0";
    $result = mysqli_query($con,$module_category_query);
    $category = mysqli_fetch_row($result)[0];

    $plans_query = "SELECT D.*,L.language,L.language_id,B.board_name,B.board_id from delivery_plan as D
    LEFT JOIN languages as L on D.language_id = L.language_id
    LEFT JOIN boards as B on D.board_id =  B.board_id
    where D.session='{$session}'
    and D.school_id={$school} and D.module_id={$module} and D.delete_flag=0";


    $plans_result = mysqli_query($con,$plans_query) or die(mysqli_error($con));
    $no_plans=0; // for showing error in error div if no plan exists
    if(!(mysqli_num_rows($plans_result)>0)){
      $no_plans=1;
    }else{
            //fetching products
        $products_query = "SELECT * from product where id in (SELECT product_id from module_product where
          delete_flag=0 and module_id={$module} and (language IN
          (SELECT language_id from delivery_plan where session='{$session}' and school_id={$school} and module_id={$module} and delete_flag=0) or language=NULL)
          and (board IN
          (SELECT board_id from delivery_plan where session='{$session}' and school_id={$school} and module_id={$module} and delete_flag=0) or board=NULL)
          )
        and delete_flag=0";
        $products_res = mysqli_query($con,$products_query) or die(mysqli_error($con));
        $product = [];
        while($p_row = mysqli_fetch_assoc($products_res)){
          if(isset($p_row['language'])){
            if(!isset($product[$p_row['language']][$p_row['board']]))
            $product[$p_row['language']][$p_row['board']] = [];
          array_push($product[$p_row['language']][$p_row['board']],$p_row['id']."_".$p_row['name']);
        }else{
          if(!isset($product["common"]))
          $product["common"] = [];
          array_push($product["common"],$p_row['id']."_".$p_row['name']);
        }
      }
      //print_r($product);
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
    if(isset($_GET['school']) && isset($_GET['module']) && isset($_GET['session'])){
      while ($plan_row = mysqli_fetch_assoc($plans_result)) { ?>
        <h5 style="font-weight:400 !important" class="light text-center"> <?php if(!empty($plan_row['language'])){ echo "Language: {$plan_row['language']}"; echo ",Board: ".$plan_row['board_name'];}
        else{ echo "Common";} ?></h5>
        <div style="margin-top:20px" class="row">
          <div data-plan="<?php echo $plan_row['id']; ?>" class="col-sm-6">
            <h4 class="light text-center">Delivery Table</h4>
            <div style="padding:20px" class="table-responsive">
              <table class="table table-bordered shadow">
                <thead class="table-dark text-white">
                  <tr>
                    <th>Products</th>
                    <?php if($category == 0){
                      $grades = [];
                      for($i = 1; $i<11; $i++) {
                        if(is_null($plan_row["grade_{$i}"]) || $plan_row["grade_{$i}"]==0) continue;
                        ?>
                        <th>Grade <?php echo $i; ?><?php array_push($grades,$i); ?></th>

                    <?php } }else{ ?>
                      <th>Quantity</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    if(isset($product[$plan_row['language_id']])){
                    foreach($product[$plan_row['language_id']][$plan_row['board_id']] as $p) {
                    $p_name = explode("_",$p)[1];
                    $p_id = explode("_",$p)[0]; ?>
                    <tr>
                      <td style="white-space: nowrap"><?php echo $p_name; ?></td>
                      <?php foreach ($grades as $grade): ?>
                        <td><input class="form-control data" value="<?php echo $plan_row["grade_".$grade] ?>" type="number" name="<?php echo $p_id."_".$grade; ?>"></td>
                      <?php endforeach; ?>
                    </tr>
                  <?php
                  } }
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
        </div>
        <?php
        }
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
</script>
<script type="text/javascript" src="js/delivery.js"></script>

<?php
  require '../footer.php';
?>
