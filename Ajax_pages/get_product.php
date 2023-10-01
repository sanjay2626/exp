<?php
  include_once("../connection.php");

  if(!empty($_GET['modl'])){
    if(!isset($_SESSION['product'])){
      $_SESSION['product']=[];
      $prod_name_query = "SELECT id,name from product";
      $prod_res = mysqli_query($con,$prod_name_query) or die(mysqli_error($con));
      while($prod_row = mysqli_fetch_assoc($prod_res)){
        $_SESSION['product'][$prod_row['id']]=$prod_row['name'];
      }
    }
  $product_query = "SELECT product_list from module where id=".$_GET['modl'];
  $res = mysqli_query($con,$product_query) or die(mysqli_error($con));
  $row = mysqli_fetch_row($res);
  $list = explode(",",$row[0]);
  ?>
  <option value="">--Select--</option>
  <?php
  foreach ($list as $prod) {
    ?>
    <option value='<?php echo $prod; ?>'><?php echo $_SESSION['product'][$prod]; ?></option>
    <?php
  }
  ?>
<?php
  }
?>
