<?php

  require '../../check_login.php';
  function x($data){
    global $con;
    return mysqli_real_escape_string($con,(trim($data)));
  }
  if(!empty($_POST)){
    $map = json_decode($_POST['maps'],true);
    // print_r($map);
    $grades = json_decode($_POST['grades'],true);
    $school = x($_POST['school_id']);
    $session = x($_POST['session']);
    $module = x($_POST['module_id']);

    $check_exist = "SELECT * from delivery_plan where module_id={$module} and
    session='{$session}' and school_id={$school} and delete_flag=0";
    $check_res = mysqli_query($con,$check_exist) or die(mysqli_error($con));
    if(mysqli_num_rows($check_res)>0){
      die("Already Exists");
    }

    $str = mysqli_fetch_assoc(mysqli_query($con,"SELECT product_id from module_products where module_id={$module}"))['product_id'];
    if($str==""){
      die("No Module-Product Mapping Found");
    }
    $query = "SELECT P.*,L.language as lang,B.board_name from product as P
    LEFT JOIN languages as L on L.language_id = P.language
    LEFT JOIN boards as B on B.board_id = P.board
    where id in
    ({$str}) and P.delete_flag=0";
      // die($query);
    $result = mysqli_query($con,$query) or die(mysqli_error($con));
    ?>
    <div class="row justify-content-center">
      <div class="col-sm-11">
      <div style="margin-bottom: 20px" class="shadow table-responsive">
          <?php
            if($_POST['category'] == 1){
              ?>
              <h4 style="width:100px; margin: 10px !important;display: inline" class="light text-center">Set all</h4>
              <input id="set_all" style="margin:10px; padding-left: 10px" min="0" type="number"/>
              <button onclick="set_all()" style="padding:3px 20px; background:#0074D9; color:white; border:0px">Set</button>
              <?php
            }
           ?>
          <table style="margin-bottom:0px" class="table table-bordered">
            <thead class="bg-dark text-white">
              <th>Product</th>
              <th>Language</th>
              <th>Board</th>
              <?php
                if($_POST['category'] == 0) {
                  foreach ($grades as $grade) {
                    echo "<th>Grade {$grade}</th>";
                  }
                }else{
                  echo "<th>Quantity</th>";
                }
              ?>
            </thead>
            <tbody>
              <?php
              $boards = array_keys($map['board']);
              $languages = array_keys($map['language']);
              // print_r($map['language']);
                while($product = mysqli_fetch_assoc($result)){
                  if((is_null($product['language']) && is_null($product['board']) && $case = 1) ||
                  (is_null($product['language']) && in_array($product['board'],$boards) && $case = 2) ||
                  (is_null($product['board']) && in_array($product['language'],$languages) && $case = 3) ||
                  (in_array($product['language'],$languages) && in_array($product['board'],$boards) && $case = 4)){
              ?>
              <tr>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['lang']; ?></td>
                <td><?php echo $product['board_name']; ?></td>
                <?php if($_POST['category'] == 0) {
                  foreach ($grades as $grade) {
                    echo "<td><input value='";
                  switch ($case) {
                    case 1: echo $map['grade'][$grade];
                      break;
                    case 2:   if(isset($map['board'][$product['board']][$grade])){
                              echo $map['board'][$product['board']][$grade];}else{
                                echo "0";
                              }
                      break;
                    case 3: if(isset($map['language'][$product['language']][$grade])){
                            echo $map['language'][$product['language']][$grade];}
                            else{
                              echo "0";
                            }
                      break;
                    case 4: if(isset($map[$product['language']][$product['board']][$grade])){
                            echo $map[$product['language']][$product['board']][$grade];
                          }else{
                            echo "0";
                          }
                      break;

                    default:
                      // code...
                      break;
                  }
                  echo "' type='number' min='0' name='{$product['id']}~grade_{$grade}' class='form-control data' /></td>";
                }
                }else{
                  echo "<td><input type='number' class='form-control data' name='{$product['id']}~school_specific'></td>";
                } ?>
              </tr>
              <?php
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <button style="margin-right:20px; margin-bottom:20px" class="add btn btn-md btn-primary">Add</button>
      <button  style="margin-bottom:20px" class="cancel btn btn-md">Cancel</button>
    </div>
    <?php
  }else{
    die("No data received");
  }
?>
<script>
function set_all(){
  $(".data").val($("#set_all").val());
}
</script>
