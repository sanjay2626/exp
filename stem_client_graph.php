<?php 
$data_modal_all="select DISTINCT school.id, school.city, school.name, 

(stem_lab_infra_data.EWork_progress+ stem_lab_infra_data.painting_progress+ stem_lab_infra_data.modelDesks_progress+
stem_lab_infra_data.cupboard_progress+ stem_lab_infra_data.flooring_progress)/5 as lab_data, 

(stem_models_data.science_progress+stem_models_data.math_progress+stem_models_data.robotics_progress+
  stem_models_data.computer_progress)/4 as models_data, 

  (stempostersdata.bWall_progress + stempostersdata.concepts_progress + stempostersdata.sSystem_progress+
   stempostersdata.inCorner_progress + stempostersdata.cutouts_progress)/5 as posterdata,

   stem_models_data.user_id, stem_lab_infra_data.user_id,
    stempostersdata.user_id, innaugration.InnaugrationDate , stemimpactassessment.StemImpactDate, teachertraining.teacherTrainingDate,
     teachertraining.teacherTraining_eDate  from school 

left join stempostersdata on school.id=stempostersdata.schoolid

left join stem_lab_infra_data on school.id=stem_lab_infra_data.schoolid

left join stem_models_data on school.id=stem_models_data.schoolid

left join innaugration on school.id=innaugration.schoolid

left join stemimpactassessment on school.id=stemimpactassessment.schoolid

left join teachertraining on school.id=teachertraining.schoolid

where stempostersdata.projectid = '".$_GET['pid']."' OR stem_lab_infra_data.projectid = '".$_GET['pid']."' OR stem_models_data.projectid = '".$_GET['pid']."' OR innaugration.projectid = '".$_GET['pid']."' order by school.city";

$data_modal_poster="select DISTINCT school.id, school.city, school.name, 
  stempostersdata.bWall_progress , stempostersdata.concepts_progress , stempostersdata.sSystem_progress,
   stempostersdata.inCorner_progress , stempostersdata.cutouts_progress, stempostersdata.user_id  from school 
left join stempostersdata on school.id=stempostersdata.schoolid
where stempostersdata.projectid = '".$_GET['pid']."'";
$result_poster = $con -> query($data_modal_poster);
while($data=mysqli_fetch_assoc($result_poster)){
echo print_r($data);
echo "<br><br>";
}


// $result_all = $con -> query($data_modal_all);
// while($data=mysqli_fetch_assoc($result_all)){
// echo print_r($data);
// echo "<br><br>";
// }
require_once('main_screen.php');
require_once('bottom_menu.php'); 

  
?>
<link rel="stylesheet" href="table.css">

<?php if(count($tags)>=2 || empty($_GET['pid'])){ ?>

<div class="container">

    <div class="row justify-content-center" style="margin-bottom:10px">

        <h3 style="padding:15px" class="head">Projects</h3>

    </div>
    <div class="row justify-content-center">
        <?php require_once('project_dropdown.php')?>
    </div>
    <div class="row justify-content-center" style="margin-bottom:10px">
        <button id='stats_button' class="btn btn-primary btn-md">View Stats</button>
    </div>
</div><hr>
<div style="width: 800px;"><canvas id="primaryChart"></canvas></div>
<canvas id="drilldownChart"></canvas>

<script>
// Primary Chart Data
const data = [
    { year: 2010, count: 32 },
    { year: 2011, count: 20 },
    { year: 2012, count: 15 },
    { year: 2013, count: 25 },
    { year: 2014, count: 22 },
    { year: 2015, count: 30 },
    { year: 2016, count: 28 },
  ];
  const backgroundColors = data.map(row => (row.count > 15 ? "blue" : "red"));
  console.log(backgroundColors);
const primaryChartData = {
    labels: data.map(row=>row.year),
    datasets: [{
        data: data.map(row=>row.count),
        backgroundColor: backgroundColors,
    }],
};

// Primary Chart Options
var primaryChartOptions = {
    onClick: handleChartClick,// Attach click event handler
    scales: {
        yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
    },
};

// Create the primary chart
const primaryChart = new Chart(document.getElementById("primaryChart"), {
    type: "bar",
    data: primaryChartData,
    options: primaryChartOptions,
});
function handleChartClick(event, chartElements) {
    // Check if any chart element is clicked
    //alert("clicked");
    console.log(event);
    
    console.log(this);
    console.log(chartElements);
    if (chartElements.length > 0) {
        var clickedElement = chartElements[0];
        var dataIndex = clickedElement._index;

        // Define drilldown data (replace with your data)
        var drilldownLabels = ["Subcategory 1", "Subcategory 2", "Subcategory 3"];
        var drilldownData = [5, 10, 8];
        var drilldownColors = ["orange", "purple", "cyan"];

        // Create the drilldown chart
        var drilldownChartData = {
            labels: drilldownLabels,
            datasets: [{
                data: drilldownData,
                backgroundColor: drilldownColors,
            }],
        };

        var drilldownChartOptions = {
            // Customize drilldown chart options as needed
        };

        // Create or update the drilldown chart
        if (window.drilldownChart) {
            window.drilldownChart.data = drilldownChartData;
            window.drilldownChart.options = drilldownChartOptions;
            window.drilldownChart.update();
        } else {
            var drilldownCanvas = document.getElementById("drilldownChart");
            window.drilldownChart = new Chart(drilldownCanvas, {
                type: "bar",
                data: drilldownChartData,
                options: drilldownChartOptions,
            });
        }
    }
}

</script>
   <?php } ?>