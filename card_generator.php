<?php
  function card_generator($list){
    $count =0;
     foreach ($list as $mod) {
        if($count==0){ ?><div class="row card-row"> <?php }
        $url = "module_images/".$mod.".jpg";
      ?>
      <!--generating cards for modules with id corresponding to module id-->
  <div class="col-sm-3 module padded" id="<?php echo $mod; ?>">
  <div class="shadow">
    <div style="background-image: url('<?php echo $url; ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;height:200px;"></div>
    <div class="container" style="padding:5px;">
      <h5 style="text-align:center"><?php echo $_SESSION['module_name'][$mod]; ?></h5>
    </div>
  </div>
</div>
  <?php $count++; if($count%4==0 || $count==sizeof($list)){
    echo "</div>";
    if($count%4==0 && $count!=sizeof($list)){
      echo "<div class='row card-row'>";
      }
    }
  }
} ?>
