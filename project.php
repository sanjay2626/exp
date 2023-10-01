<?php
  require_once('connection.php');
  require_once('check_login.php');
  require_once('head.php');
//  require_once('card_generator.php');

?>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.5.0"></script>
<script>
Chart.helpers.merge(Chart.defaults.global.plugins.datalabels, {
    align: "top",
    anchor: "end"
});
</script>
<?php





    if(isset($_GET['pid']) && $_GET['pid'] !== ""){
        $projects = $_GET['pid'];
         $query = "SELECT * FROM project where id=$projects";
  


   $result = $con -> query($query);
   $projectdata = $result->fetch_assoc();

   $query2 = "SELECT program.name as programname, donors.name as donorsname, ngo.name as ngoname FROM project  
 inner join program on program.id=project.program_id
  inner join donors on donors.id=project.donor_partner 
inner join ngo on ngo.id=project.ngo_partner
   WHERE project.id = ".$_GET['pid']."";
$result2 = $con -> query($query2);
   $projectdata2 = $result2->fetch_assoc();



 //print_r($projectdata); exit;
    if(!empty($projectdata)){
$title = $projectdata['name'];
$description = $projectdata['description'];
$more = 'Click here For More details...';
   }else{
    $projects = $_SESSION['projects'];
        $description = 'All projects';
        $title = 'All projects';
        $more = '';
   }
    }else{
        $projects = $_SESSION['projects'];
        $description = 'All projects';
         $title = 'All projects';
         $more = '';
    }
    ?>

    <div class="p-5 bg-primary text-white text-center" style="background-color: #343a40 !important;">
      <div  class="Container">
        <div class="row">
       <div class="col-md-2">
          <?php if(!empty($projectdata['projectlogo'])){ ?>
          <div style="margin-bottom: 10px;"><img src="uploads/projectLogo/<?php echo $projectdata['projectlogo']; ?>" style="width: 160px;height: 50px;"></div>
          <?php } ?>

          <?php if(!empty($projectdata['projectlogo2'])){ ?>
           <div><img src="uploads/projectLogo2/<?php echo $projectdata['projectlogo2']; ?>" style="width: 160px;height: 50px;"> </div> 
          <?php } ?> </div>  <div class="col-md-8"> <h1><?php echo $title; ?></h1></div>  <div class="col-md-2"><img src="https://i.postimg.cc/KcPmbGz7/download.png" onclick="generate();"> <img src="https://i.postimg.cc/L64FMjGR/print.png"> <img src="https://i.postimg.cc/CKGc1Qf2/share.png"> </div>
      </div>
      </div>  
  <p><?php echo $description; ?></p>
</div>

<div class="Container">
  <div class="row">
    <div class="col-md-1">
     
    </div>
    <div class="col-md-9">
      <table class="table table-bordered">
    
    <tbody>
      <tr>
        <td><b>Project Name</b></td>
        <td><?php echo $projectdata['name']; ?></td>
      </tr>
      <tr>
        <td><b>Program Name</b></td>
        <td><?php echo $projectdata2['programname']; ?></td>
      </tr>
      <tr>
        <td><b>NGO Partner</b></td>
        <td><?php echo $projectdata2['ngoname']; ?></td>
      </tr>

      <tr>
        <td><b>Donor Partner</b></td>
        <td><?php echo $projectdata2['donorsname']; ?></td>
      </tr>

      <tr>
        <td><b>No of Schools</b></td>
        <td><?php echo $projectdata['school_count']; ?></td>
      </tr>

      <tr>
        <td><b>Cities</b></td>
        <td><?php echo $projectdata['cities_count']; ?></td>
      </tr>

      <tr>
        <td><b>Languages</b></td>
        <td><?php echo $projectdata['language_list']; ?></td>
      </tr>

      <tr>
        <td><b>Project Start Date</b></td>
        <td><?php echo $projectdata['start_date']; ?></td>
      </tr>

      <tr>
        <td><b>Project End Date</b></td>
        <td><?php echo $projectdata['end_date']; ?></td>
      </tr>

      <tr>
        <td><b>Project Summary</b></td>
        <td><?php echo $projectdata['description']; ?></td>
      </tr>
    </tbody>
  </table>
    </div>
    <div class="col-md-2">
      
    </div>
  </div>
</div>

<?php require_once('footer.php'); ?>

