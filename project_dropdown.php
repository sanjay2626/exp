<?php
$project_names_query = "SELECT id,name from project where id in ({$_SESSION['projects']})";

$project_names_query_res = mysqli_query($con,$project_names_query) or die(mysqli_error($con));

while($project_row = mysqli_fetch_assoc($project_names_query_res)){

  $project_names[$project_row['id']] = $project_row['name'];

}
?>

<select id='project_drop' class="form-control" style="max-width:200px">

                 <option value="">All Projects</option>

                <?php 

                    foreach($project_names as $id => $name){

                ?>

                <option <?php if(isset($_GET['pid']) && $_GET['pid'] == $id){ echo "selected"; } ?> value="<?php echo $id; ?>"><?php echo $name; ?></option>

                <?php

                    }

                ?>

            </select>