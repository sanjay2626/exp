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
<!-- Normal Dashboard   -->

<?php

    if (in_array("16",$_SESSION['permissions'])) {
       
         require ("stemmanager.php");
  } ?>

<?php
    if (in_array("15",$_SESSION['permissions'])) {
         require ("stemclient.php");
        // echo '<iframe width="100%" height="786" src="https://datastudio.google.com/embed/reporting/cf34e9b9-555f-4765-8416-21bdd0b76f6f/page/mPl7C" frameborder="0" style="border:0" allowfullscreen></iframe>';
  } ?>

<?php
    if (in_array("1",$_SESSION['permissions'])) {
         require ("dashboard_files/normal.php");
  } ?>

<?php
    if (in_array("14",$_SESSION['permissions'])) {
         require ("steminfra.php");
  } ?>


 <?php
    if (in_array("13",$_SESSION['permissions'])) {
         require ("dashboard_files/normal.php");
  } ?>
<!-- Normal Dashboard End -->

<!-- Report Dashboard -->
  <?php
    if (in_array("8",$_SESSION['permissions'])) {
    require ("dashboard_files/report.php");
  } 
  
  require_once('footer.php');
  ?>


