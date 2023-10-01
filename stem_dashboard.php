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
    if (in_array("13",$_SESSION['permissions'])) {
         require ("stem_client_report.php");
  } ?>

