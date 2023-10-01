<?php
  require '../check_login.php';
  require '../head.php';
  if(!isset($_GET['sub_id'])){
    header("location:../dashboard.php");
  }
  $id = mysqli_real_escape_string($con,$_GET['sub_id']);
  $query = "SELECT NULL as id,NULL as product,";
  for ($i=1; $i < 11; $i++) {
    $query.="SUM(grade_{$i}) as grade_{$i},";
  }
  $query.="SUM(school_specific) as school_specific from delivery_plan where sub_id='{$id}' UNION SELECT D.id,P.name as product,";
  for ($i=1; $i < 11; $i++) {
    $query.="D.grade_{$i},";
  }
  $query.="D.school_specific from delivery_plan as D
  INNER JOIN product as P on
  P.id = D.product_id where D.sub_id='{$id}'";

  $res = mysqli_query($con,$query) or die(mysqli_error($con));
  $del = mysqli_fetch_assoc($res);
  $grades = [];
  foreach ($del as $key => $value) {
    if($value==0 || is_null($value)){
      continue;
    }else{
      array_push($grades,$key);
    }
  }




?>

<style>
  #module{
    width:100%;
    font-size: 1.2em;
    background: #eeeeee;
    padding: 10px;
    font-weight: 400
  }
  input[type=number]{
    margin-bottom: 15px
  }
</style>
<div class="container-fluid">
  <h3 style="padding:10px" class="light text-center">Modify Delivery Plan</h3><hr style="margin-top:0px">
  <div class="row justify-content-center">
    <div class="col-sm-10">
      <div class="table-responsive">
        <table id="table" class="table table-bordered">
          <thead class=" bg-dark text-white">
            <th>Product</th>
            <?php for ($i=1; $i <11 ; $i++) {
              if(in_array("grade_{$i}",$grades))
              echo "<th >Grade {$i}</th>";
            }
            if(in_array("school_specific",$grades))
              echo "<th>Quantity</th>";

              echo "</tr>"
            ?>
          </thead>
          <tbody>
            <?php while($row = mysqli_fetch_assoc($res)){ ?>
              <tr>
              <td><?php echo $row['product']; ?></td>
              <?php for ($i=1; $i <11 ; $i++) {
                if(in_array("grade_{$i}",$grades))
                echo "<td><input type='number' name='{$row['id']}~grade_{$i}' value='{$row['grade_'.$i]}' class='form-control data' /></td>";
              }
              if(in_array("school_specific",$grades))
                echo "<td><input type='number' name='{$row['id']}~school_specific' value='{$row['school_specific']}' class='form-control data' /></td>";
              ?>
            </tr>
            <?php
          }
          ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="row justify-content-center">
    <input type="button" id="save" value="Save" class="btn btn-success btn-md"/>
  </div>
</div>
<script> var id="<?php echo $id; ?>"</script>
<script type="text/javascript" src="js/modify_plan.js"></script>
<?php
  require '../footer.php';
?>
