<?php
require("connection.php");
require("check_login.php");
require("head.php");
//where variable for query
$where="";
$f_value="";
$t_value="";
if(isset($_GET['f_date']) && !empty($_GET['f_date'])){
  $where.=" where session_date between '".$_GET['f_date']."' and '".$_GET['t_date']."'";
  $f_value = $_GET['f_date'];
  $t_value = $_GET['t_date'];
}
//mappings
$board = mysqli_query($con,"SELECT * FROM boards");
while($board_r = mysqli_fetch_assoc($board)){
  $board_arr[$board_r['board_id']]=$board_r['board_name'];
}

$language = mysqli_query($con,"SELECT * FROM languages");
while($language_r = mysqli_fetch_assoc($language)){
  $language_arr[$language_r['language_id']]=$language_r['language'];
}

$project = mysqli_query($con,"SELECT id,name from project");
while($pr = mysqli_fetch_assoc($project)){
  $project_arr[$pr['id']]=$pr['name'];
}

$school = mysqli_query($con,"SELECT id,name from school");
while($pr = mysqli_fetch_assoc($school)){
  $school_arr[$pr['id']]=$pr['name'];
}

$program = mysqli_query($con,"SELECT id,name from program");
while($pr = mysqli_fetch_assoc($program)){
  $program_arr[$pr['id']]=$pr['name'];
}

$session = mysqli_query($con,"SELECT id,session_type from session_type");
while($st = mysqli_fetch_assoc($session)){
  $session_arr[$st['id']]=$st['session_type'];
}
//use session[module_name] for modules
// fetching rows
$query = "SELECT  * from session_completed".$where;

$res = mysqli_query($con,$query) or die(mysqli_error($con));
?>
<style>
  thead{
    white-space: nowrap;
  }
  h4{
    font-weight: lighter;
  }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.14.0/xlsx.core.min.js"></script>
<script src="assets/FileSaver.min.js"></script>
<script src="assets/t_export/js/tableexport.js"></script>
<link href="assets/t_export/css/tableexport.css" rel="stylesheet"></script>
<div class="container-fluid">
  <div class="container">
    <form action="" method="GET">
    <div class="row justify-content-center" style="padding: 20px">
      <div class="col-sm-2 justify-content-center">
        <h4>Save</h4>
        <button type="button" id="save" class="btn btn-primary btn-md">Save as Excel</button>
      </div>
      <div class="col-sm-4">
        <h4>From Date</h4>
        <input value="<?php echo $f_value; ?>" required class="form-control" type="date" name="f_date">
      </div>
      <div class="col-sm-4">
        <h4>To Date</h4>
        <input value="<?php echo $t_value; ?>" required class="form-control" type="date" name="t_date">
      </div>
    </div>
    <div class="row justify-content-center" style="padding:10px" >
      <div class="col-sm-4">
        <input type="submit" value="Search" class="btn btn-lg btn-primary form-control">
      </div>
    </div>
  </form>
  </div>
  <div class="table-responsive">
  <table id="table" class="table">
    <thead class="bg-dark table-dark">
      <th>Project Name</th>
      <th>Teacher Code</th>
      <th>School Code</th>
      <th>Language</th>
      <th>Board</th>
      <th>Program</th>
      <th>Session Type</th>
      <th>Module</th>
      <th>Grade</th>
      <th>Section</th>
      <th>Topic</th>
      <th>Activity</th>
      <th>Batch Size</th>
      <th>Student Count</th>
      <th>Rating</th>
      <th>Session Summary</th>
      <th>Issues</th>
      <th>Session Start Time</th>
      <th>Session End Time</th>
      <th>Session Date</th>
    </thead>
    <tbody>
        <?php
          while($row = mysqli_fetch_assoc($res)){
            $session_type_whole="";
            ?>
            <tr>
              <td><?php echo $project_arr[$row['project_id']];?></td>
              <td><?php echo $row['session_user_id'];?></td>
              <td><?php echo $school_arr[$row['school_id']];?></td>
              <td><?php echo $language_arr[$row['language_id']];?></td>
              <td><?php echo $board_arr[$row['board_id']];?></td>
              <td><?php echo $program_arr[$row['program']];?></td>
              <td><?php foreach (explode(",",$row['session_type']) as $session_part) {
                $session_type_whole.=$session_arr[$session_part].",";
              } echo trim($session_type_whole,","); ?></td>
              <td><?php echo $_SESSION['module_name'][$row['module_id']];?></td>
              <td><?php echo $row['grade'];?></td>
              <td><?php echo $row['section'];?></td>
              <td><?php echo $row['topic_chapter'];?></td>
              <td><?php echo $row['activity'];?></td>
              <td><?php echo $row['batch_size'];?></td>
              <td><?php echo $row['student_count'];?></td>
              <td><?php echo $row['rate'];?></td>
              <td><?php echo $row['session_summary'];?></td>
              <td><?php echo $row['issues'];?></td>
              <td><?php echo $row['from_time'];?></td>
              <td><?php echo $row['to_time'];?></td>
              <td><?php echo $row['session_date'];?></td>
            </tr>
            <?php
          }
        ?>
    </tbody>
  </table>
  </div>
</div>
<script>
  var today = new Date();
  var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
  var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
  //$("table").tableExport();
  $("document").ready(function(){
    $("#save").on('click',function(){
      $("button.csv").click();
    });
        var table_id = document.getElementById("table");
        //alert(id);
        var table = new TableExport(table_id, {
    headers: true,                              
    footers: true,                              // (Boolean), display table footers (th or td elements) in the <tfoot>, (default: false)
    formats: ['xlsx', 'csv', 'txt'],            // (String[]), filetype(s) for the export, (default: ['xlsx', 'csv', 'txt'])
    filename: 'id',                             // (id, String), filename for the downloaded file, (default: 'id')
    bootstrap: false,                           // (Boolean), style buttons using bootstrap, (default: true)
    exportButtons: true,                       
    position: 'bottom',                         // (top, bottom), position of the caption element relative to table, (default: 'bottom')
    ignoreRows: null,                           // (Number, Number[]), row indices to exclude from the exported file(s) (default: null)
    ignoreCols: null,                           // (Number, Number[]), column indices to exclude from the exported file(s) (default: null)
    trimWhitespace: true                        // (Boolean), remove all leading/trailing newlines, spaces, and tabs from cell text in the exported file(s) 
});

 

  });
</script>
<?php require("footer.php"); ?>
