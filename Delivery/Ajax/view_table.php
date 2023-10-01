<?php
  require '../../check_login.php';
  if(!empty($_POST)){
    $school = mysqli_real_escape_string($con,$_POST['school']);
    $session = mysqli_real_escape_string($con,$_POST['session']);
    $query = "SELECT module_id,sub_id FROM delivery_plan where school_id={$school} and session='{$session}' and delete_flag=0 group by module_id,sub_id";
    $result = mysqli_query($con,$query) or die(mysqli_error($con));
    ?>

      <div class="row justify-content-center">
      <div class="col-sm-10">
        <table class="table table-striped table-bordered">
          <thead class=" bg-dark text-white">
            <th>Module</th>
            <th>Modify</th>
            <th>Delete</th>
            
          </thead>
          <tbody>
            <?php while($row = mysqli_fetch_assoc($result)){ ?>
              <tr>
              <td><?php echo $_SESSION['module_name'][$row['module_id']]; ?>
              <td class="modify" data-t="<?php echo $row['sub_id']; ?>">Modify</td>
              <td class="del" data-t="<?php echo $row['sub_id']; ?>">Delete</td>

            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <?php
  }else{
    echo "<h5 style='font-weight:lighter, text-align:center'>No Data Sent!</h5>";
  }
?>
