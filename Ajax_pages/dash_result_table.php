
<?php
  session_start();
  $mod = $_GET['module'];
  $ses = $_GET['session'];
  ?>
  <div class="row">
    <div class="col-sm-4">
      <h5 class="light">Topic</h5>
      <input type="text" name="session_topic"/>
    </div>
    <div class="col-sm-4">
      <h5 class="light">Session Date</h5>
      <input type="date" name="session_date"/>
    </div>
    <div class="col-sm-4"></div>
  </div>
  <div class="table-responsive">
    <table id="result_table">
      <tr>
        <?php foreach ($_SESSION['module_columns'][$mod] as $column) {
          echo "<th>$column</th>";
        } ?>
      </tr>

<?php
  exit();
  $query = "SELECT sid,student_id,grade,section,name  from student where academic_year = YEAR(getdate()) and school_id=".$_SESSION['exp_dash_school_id'];


  $res = mysqli_query($con,$query) or die(mysqli_error($con));
  while(mysqli_fetch_assoc($res)){
  ?>

  <?php
} ?>
    </table>
  </div>
