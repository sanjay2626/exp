<?php
include("../connection.php");
  if(!empty($_POST['projectid'])){
    //board and language names in session variables
    $lang_query = "SELECT * from project where
    id='".$_POST['projectid']."'"; ?>

  <?php foreach($con -> query($lang_query) as $Project){
      ?>
      <option 
       value="<?php echo $Project['id']; ?>"><?php echo $Project['name']; ?></option>
      <?php
    } 
  
    }
?>

