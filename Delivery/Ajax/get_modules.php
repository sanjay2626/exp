<?php
  require '../../check_login.php';
//print_r($_POST);
//echo $school_id;
  if(!empty($_POST['school_id']) && !empty($_POST['session'])){
    $school_id = mysqli_real_escape_string($con,$_POST['school_id']);
    $session = mysqli_real_escape_string($con,$_POST['session']);
    $module_fetch_query = "SELECT GROUP_CONCAT(module_list) from program where id in( SELECT GROUP_CONCAT(program_id)
    FROM `project_school` inner join project on project.id = project_school.project_id
    WHERE school_id={$school_id})";
    $error = "";
    $result = mysqli_query($con,$module_fetch_query) or $error="Couldn't fetch modules for selected school";
    $row = mysqli_fetch_row($result)[0];
    $row = array_unique(explode(",",$row));
    if($error == 1){
      $reply = ["error" =>  "".mysqli_error($con)];
    }else{
      $reply = ["modules" => $row];
    }

    $mappings = "SELECT project_school.language_id,school_board,grade_1,grade_2,grade_3,grade_4,grade_5,grade_6,grade_7,grade_8,grade_9,grade_10
    from project_school

    where project_school.session='{$session}' and project_school.school_id={$school_id} and project_school.delete_flag=0";
    $map_result = mysqli_query($con,$mappings) or $error="Can't fetch project-school mapping";
    echo mysqli_error($con);
    // echo $mappings;
    if(mysqli_num_rows($map_result) > 0){
      $grades = [];
      for ($i=1; $i <11 ; $i++) {
        $reply['mappings']['grade'][$i] = 0;
      }
      while($map_row = mysqli_fetch_assoc($map_result)){

          for ($i=1; $i <11 ; $i++) {
            if(!is_null($map_row["grade_{$i}"])){
            $reply['mappings'][$map_row['language_id']][$map_row['school_board']][$i] = $map_row["grade_{$i}"];
            $reply['mappings']['grade'][$i] +=intval($map_row["grade_{$i}"]);
            // echo $map_row["grade_{$i}"]."<br>";
            isset($reply['mappings']['board'][$map_row['school_board']][$i])?$reply['mappings']['board'][$map_row['school_board']][$i]+=$map_row["grade_{$i}"]:$reply['mappings']['board'][$map_row['school_board']][$i]=$map_row["grade_{$i}"];
            isset($reply['mappings']['language'][$map_row['language_id']][$i])?$reply['mappings']['language'][$map_row['language_id']][$i]+=$map_row["grade_{$i}"]:$reply['mappings']['language'][$map_row['language_id']][$i]=$map_row["grade_{$i}"];
            array_push($grades,$i);
            }
          }

      }
      $grades = array_unique($grades,SORT_NUMERIC);
      $reply['grades'] = $grades;
    }else{
      $error = "There are no entries in project_school mapping for the school and session selected, contact admin for creating the entry";
    }
    $reply['error'] = $error;
    echo json_encode($reply);
  }
?>
