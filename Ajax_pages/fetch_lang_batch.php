<?php
include("../connection.php");
  if(!empty($_POST['school']) && !empty($_POST['project'])){

    //board and language names in session variables

    $lang_query = "SELECT languages.language_id,languages.language from languages where languages.language_id in (SELECT project_school.language_id from project_school where
    project_id='".$_POST['project']."'
    and school_id='".$_POST['school']."')";
    $res = mysqli_query($con,$lang_query) or die(mysqli_error($con));
    $board = "";
    $language= "";
    while($lang = mysqli_fetch_assoc($res)){
      $language.="<option value='".$lang['language_id']."' >".$lang['language']."</option> ";
    }

    $board_query = "SELECT boards.board_id,boards.board_name from boards where boards.board_name in (SELECT school.school_board from school where
    school.id='".$_POST['school']."')";
    // print_r($board_query); exit;
    $b_res = mysqli_query($con,$board_query) or die(mysqli_error($con));
    while($brd = mysqli_fetch_assoc($b_res)){
      $board.="<option value='".$brd['board_id']."' >".$brd['board_name']."</option> ";
    }
    $arr = array(
      'board' => $board,
      'language' => $language
    );
    echo json_encode($arr);
  }
 ?>
