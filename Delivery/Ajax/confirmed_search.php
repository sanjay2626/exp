<?php

    require("../../connection.php");
    if(!isset($_SESSION['exp_dellivery_user_id'])){
        header("location:http://localhost/experifun/index.php");
      }

  if(!empty($_POST)){
    $school = mysqli_real_escape_string($con,$_POST['school']);
    $session = mysqli_real_escape_string($con,$_POST['session']);
    $query = "SELECT DISTINCT DS.delivery_id,DS.receiving_date,DS.delivery_id,P.module_id,M.name as module from
    delivery_status as DS
    INNER JOIN delivery_plan as P on
    P.sub_id = DS.plan_sub_id
    INNER JOIN module as M on
    M.id = P.module_id
    where DS.delete_flag=0 and DS.status=1 and P.school_id={$school} and P.session='{$session}'";
    $res = mysqli_query($con,$query) or die(mysqli_error($con));
    // echo $query;
    ?>
    <table class="table table-bordered">
      <thead class="bg-dark text-white">
        <tr>
          <th>Module</th>
          <th>Confirmation Date</th>
          <th>Receipt</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = mysqli_fetch_assoc($res)){ ?>
          <tr>
            <td><?php echo $row['module']; ?></td>
            <td><?php echo $row['receiving_date']; ?></td>
            <td><a class='view_link' target='_blank' href='view_image?type=confirmed_receipts&id=<?php echo $row['delivery_id']; ?>' >View</a></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

  <?php
  }else{
    die("No data Sent!");
  }
 ?>
