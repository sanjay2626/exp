<?php
function count_card($count,$text){
  $i=1;
  while($i<=$count){
    if($i%4==1){
      echo "<div class='row card-row justify-content-center'>";
    } ?>
      <div class="col-sm-3 <?php echo $text; ?> padded" id='<?php echo $i; ?>'>
        <div class="shadow" style="min-height:200px; display:flex; align-items:center">
          <h3 class="light" style="text-align:center; width:100%"><?php echo $text." ".$i; ?></h3>
        </div>
      </div>

<?php  if($i%4==0){
  echo "</div>";
} $i++; } }
?>
