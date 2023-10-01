<?php
  require 'check_login_confirm.php';
  require '../head.php';
  //print_r($_SESSION['school_id']);
  $schools = $_SESSION['school_id'];
  $fetch_deliveries = 'SELECT DISTINCT DS.*,DP.school_id,DP.session,DP.module_id,school.name as school,module.name as module
  from delivery_status as DS
  INNER JOIN delivery_plan as DP on DS.plan_sub_id = DP.sub_id
  INNER JOIN school on school.id = DP.school_id
  INNER JOIN module on module.id = DP.module_id
  where DS.status=0 and DP.school_id in('.$schools.') and DS.delete_flag=0 and DS.delivery_receipt IS NOT NULL';
  $fetch_res = mysqli_query($con,$fetch_deliveries) or die(mysqli_error($con));
  // echo $fetch_deliveries;
?>
<style>
  td,th{
    text-align: center;
  }
</style>
<div class="container-fluid">
  <h3 class="light text-center" style="padding:20px">Welcome <?php echo $_SESSION['exp_dellivery_name']; ?></h3><hr style="margin-top:0px">
  <div class="container">
    <h4 class="light text-center">List of unconfirmed deliveries</h4>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead class="bg-dark text-white">
          <tr>
            <th>School</th>
            <th>Module</th>
            <th>Initiation Date</th>
            <th>Signed Receipt</th>
            <th>Upload Confirmation Receipt</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = mysqli_fetch_assoc($fetch_res)){ ?>
            <tr>
              <td><?php echo $row['school']; ?></td>
              <td><?php echo $row['module']; ?></td>
              <td><?php echo date("d-M-Y",strtotime($row['initiation_date'])); ?></td>
              <td><a class='view_link' target='_blank' href='view_image?type=delivery_receipts&id=<?php echo $row['delivery_id']; ?>' >View</a></td>
              <td><a href='#' class='upload'>Upload<input data-id='<?php echo $row['delivery_id']; ?>' type='file' accept='image/jpeg' name='confirmed_receipt' style='display:none'/></a></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

</div>
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
     url:"Ajax/upload_confirm_image.php",
     processData: false,
     contentType: false,
     data: fd,
     cache: false,
     type: 'POST',
     success: function(html){
       console.log(html);
       if(html=="Success"){
         alert("Delivery Confirmed");
         location.reload();
       }else{
         alert("There was an error while trying to upload file...Console might have info.");
         console.log(html);
       }
     }
   });
  }
})
</script>
<?php
  require '../footer.php';
 ?>
