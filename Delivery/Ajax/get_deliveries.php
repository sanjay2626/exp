<?php
require '../../check_login.php';
function x($data){
  global $con;
  return mysqli_real_escape_string($con,(trim($data)));
}
  if (!empty($_POST)) {
    $school = x($_POST['school_id']);
    $module = x($_POST['module_id']);
    $session = x($_POST['session']);

      $query = "SELECT * FROM delivery_status where delivery_id in
      (
        SELECT delivery_id from delivery_data where plan_id in (
          SELECT id from delivery_plan where school_id={$school} and module_id={$module} and session='{$session}' and delete_flag = 0
          )
        ) and delete_flag=0";
      $res = mysqli_query($con,$query) or die(mysqli_error($con));

      // $status_query = "SELECT * FROM delivery_status where "
      ?>
      <style>
      .view_link{
        color:#0074D9 !important;
      }
      </style>
      <div class="row">
      <div class="col-sm-12">
        <h4 class="light text-center">Delivered Table</h4>
          <div style="margin-bottom:20px" class="table-responsive">
            <table style="margin-bottom:0px" class="table table-bordered shadow">
              <thead class="table-dark text-white">
                <tr>
                  <th>Initiation Date</th>
                  <th>Initiated By</th>
                  <th>Status</th>
                  <th>View</th>
                  <th>Delivery Receipt</th>
                  <th>Confirmation Receipt</th>

                </tr>
              </thead>
              <tbody>
                <?php while ($row = mysqli_fetch_assoc($res)) { ?>
                  <tr>
                    <td><?php echo date("d-M-Y",strtotime($row['initiation_date'])); ?></td>
                    <td><?php echo $row['initiated_by']; ?></td>
                    <td><?php if($row['status']){
                      echo "Delivered";
                    }else{
                      echo "Pending";
                    }; ?></td>
                    <td><a target="_blank" href="receipt.php?delivery_id=<?php echo $row['delivery_id'];  ?>&plan_sub_id=<?php echo $row['plan_sub_id'];  ?>" style="color:#0074D9; cursor:pointer">View Receipt</a></td>
                    <td><?php if(is_null($row['delivery_receipt'])){
                      echo "Not Uploaded (<a href='#' class='upload'>Upload<input data-id='{$row['delivery_id']}' type='file' accept='image/jpeg' name='delivery_receipt' style='display:none'/></a>)";
                    }else{
                      echo "<a class='view_link' target='_blank' href='view_image?type=delivery_receipts&id={$row['delivery_id']}' >View</a>";
                    } ?></td>
                    <td><?php if(is_null($row['signed_receipt'])){
                      echo "Not Uploaded";
                    }else{
                      echo "<a class='view_link' target='_blank' href='view_image?type=confirmed_receipts&id={$row['delivery_id']}' >View</a>";
                    } ?></td>

                  </tr>
                <?php } ?>

              </tbody>
            </table>
          </div>
      </div>
    </div>
      <?php
    }
 ?>
<script>
  $(".upload").on("click",function(){
    var inp = $(this).find("input")[0];
    inp.click();
  })
  $("input[type=file]").on("change",function(){
    var inp = $(this);
    var id = $(this).data('id');
    if($(this).val()){
      var fd = new FormData();
      // alert((inp)[0].files);

      fd.append("files",(inp)[0].files[0]);
      fd.append("del_id",id);
      $.ajax({
       url:"Ajax/upload_image.php",
       processData: false,
       contentType: false,
       data: fd,
       cache: false,
       type: 'POST',
       success: function(html){
         console.log(html);
         if(html=="Success"){
           inp.closest("td").html("<a target='_blank' href='view_image?type=delivery_receipts&id="+id+"'>View</a>");
         }else{
           alert("There was an error while trying to upload file...Console might have info.");
           console.log(html);
         }
       }
     });
    }
  })
</script>
