<?php
  if(!isset($_GET['id'])){
    header("location:../dashboard.php");
  }
  $id = $_GET['id'].".jpg";
  $type = $_GET['type']."/";
 ?>
 <style>
  body,html{
    width:100%;
    height:100%;
    margin: 0;
    box-sizing: border-box;
  }
  body{
    padding:5px
  }

  .center_flex{
      display:flex;
      align-items:center;
      justify-content:center;
      flex-wrap:wrap;
      flex-direction:row;
  }
 </style>
 <html>
  <body>
    <div class="center_flex">
      <img src="<?php echo $type.$id; ?>"></img>
    </div>
  </body>
</html>
