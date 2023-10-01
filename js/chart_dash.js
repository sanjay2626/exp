Chart.plugins.register({
afterRender: function(c) {
    console.log("afterRender called");
    var ctx = c.chart.ctx;
    ctx.save();
    // This line is apparently essential to getting the
    // fill to go behind the drawn graph, not on top of it.
    // Technique is taken from:
    // https://stackoverflow.com/a/50126796/165164
    ctx.globalCompositeOperation = 'destination-over';
    ctx.fillStyle = 'white';
    ctx.fillRect(0, 0, c.chart.width, c.chart.height);
    ctx.restore();
}
});
    // initialising variables
   Chart.defaults.global.elements.line.fill = false;
    Chart.defaults.global.animation = false;
    Chart.defaults.global.defaultFontColor = 'black';
    Chart.defaults.global.defaultFontSize = 15;
   
    var labels = [];
    var data = [];
    var backgroundColor = "rgba(63,81,181,0.5)";
    var borderColor = "rgb(63,81,181)";
    var options = {
      legend:{
        display: true,
        position: "bottom"
      },
      layout: {
            padding: {
                left: 0,
                right: 0,
                top: 30,
                bottom: 0
            }
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }],
            xAxes: [{
                barPercentage: 0.4,
                ticks: {
                   stepSize: 1,
                   min: 0,
                   autoSkip: false
               }
            }],
        },
        chartArea: {
          backgroundColor: 'rgba(255, 255, 255, 1)'
        }
    }
    // options with no datalabel
    var no_label_options = {
      legend:{
        display: true,
        position: "bottom"
      },
      plugins:{
            datalabels: {
                display:false
            }
        },
      layout: {
            padding: {
                left: 0,
                right: 0,
                top: 20,
                bottom: 0
            }
        },
        
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }],
            xAxes: [{
                 barPercentage: 0.5,
                categoryPercentage: 0.8,
                ticks: {
                   stepSize: 1,
                   min: 0,
                   autoSkip: false
               }
            }],
        },
        chartArea: {
          backgroundColor: 'rgba(255, 255, 255, 1)'
        }
    }
    // no_label_options.push({
    //     plugins:{
    //         datalabels: {
    //             display:false
    //         }
    //     }
    // });
      
    // increasing number animation
    $('.incremental').each(function () {
      $(this).prop('Counter',0).animate({
          Counter: $(this).text()
      }, {
          duration: 3000,
          easing: 'swing',
          step: function (now) {
              $(this).text(Math.ceil(now));
          }
      });
    });

    //project comparison chart

    if(Object.keys(chart_array['project']).length > 1){
    $.each(chart_array['project'],function(k,v){
      labels.push(""+k);
      data.push(v);
    });
    var project_canvas = document.getElementById("project_chart").getContext('2d');
    var myChart = new Chart(project_canvas, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: '# of Sessions',
            data: data,
            backgroundColor: backgroundColor,
            borderColor: borderColor,
            borderWidth: 1
        }]
      },
        options
    });
}
    //program chart
    if(Object.keys(chart_array['program']).length > 1){
    labels = [];
    data = [];
    $.each(chart_array['program'],function(k,v){
      labels.push(""+k);
      data.push(v);
    });
    var program_canvas = document.getElementById("program_chart").getContext('2d');
    var myChart = new Chart(program_canvas, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: '# of Sessions',
            data: data,
            backgroundColor: backgroundColor,
            borderColor: borderColor,
            borderWidth: 1
        }]
      },
        options
    });
}
//Module Chart
    labels = [];
    data = [];
    $.each(chart_array['module'],function(k,v){
      labels.push(""+k);
      data.push(v);
    });
    var module_canvas = document.getElementById("module_chart").getContext('2d');
    var myChart1 = new Chart(module_canvas, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: '# of Sessions',
            data: data,
            backgroundColor: backgroundColor,
            borderColor: borderColor,
            borderWidth: 1
        }]
      },
        options
    });

    // Get the chart's base64 image string
document.getElementById('download_module_chart').onclick = function() {
  // Trigger the download
  var a = document.createElement('a');
  a.href = myChart1.toBase64Image();
  a.download = 'module_chart.png';
  a.click();
}
document.getElementById('print_module_chart').onclick = function() {
var canvas = document.getElementById('module_chart');
var data = canvas.toDataURL();
var html  = '<html><head><title></title></head>';
    html += '<body style="width: 100%; padding: 0; margin: 0;"';
    html += ' onload="window.focus(); window.print(); window.close()">';
    html += '<img src="' + data + '" /></body></html>';
var printWindow = window.open('_self', 'height=600,width=800');
printWindow.document.open();
printWindow.document.write(html);
printWindow.document.close();
}

    //School Chart
    labels = [];
    data = [];
    $.each(chart_array['school'],function(k,v){
      labels.push(""+k);
      data.push(v);
    });
    var school_canvas = document.getElementById("school_chart").getContext('2d');
    var myChart2 = new Chart(school_canvas, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: '# of Sessions',
            data: data,
            backgroundColor: backgroundColor,
            borderColor: borderColor,
            borderWidth: 1
        }]
      },
        options
    });

    // Get the chart's base64 image string
document.getElementById('download_school_chart').onclick = function() {
  // Trigger the download
  var a = document.createElement('a');
  a.href = myChart2.toBase64Image();
  a.download = 'school_chart.png';
  a.click();
}

document.getElementById('Print_school_chart').onclick = function() {
var canvas = document.getElementById('school_chart');
var data = canvas.toDataURL();
var html  = '<html><head><title></title></head>';
    html += '<body style="width: 100%; padding: 0; margin: 0;"';
    html += ' onload="window.focus(); window.print(); window.close()">';
    html += '<img src="' + data + '" /></body></html>';
var printWindow = window.open('_self', 'height=600,width=800');
printWindow.document.open();
printWindow.document.write(html);
printWindow.document.close();
}

    //Grade Chart
    labels = [];
    data = [];
    $.each(chart_grade['total'],function(key,value){
      labels.push(""+key);
      data.push(value);
    })
    var grade_canvas = document.getElementById("grade_chart").getContext('2d');
    var myChart3 = new Chart(grade_canvas, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: '# of Sessions',
            data: data,
            backgroundColor: backgroundColor,
            borderColor: borderColor,
            borderWidth: 1
        }]
      },
        options
    });

    // Get the chart's base64 image string
document.getElementById('download_grade_chart').onclick = function() {
  // Trigger the download
  var a = document.createElement('a');
  a.href = myChart3.toBase64Image();
  a.download = 'grade_chart.png';
  a.click();
}

document.getElementById('Print_grade_chart').onclick = function() {
var canvas = document.getElementById('grade_chart');
var data = canvas.toDataURL();
var html  = '<html><head><title></title></head>';
    html += '<body style="width: 100%; padding: 0; margin: 0;"';
    html += ' onload="window.focus(); window.print(); window.close()">';
    html += '<img src="' + data + '" /></body></html>';
var printWindow = window.open('_self', 'height=600,width=800');
printWindow.document.open();
printWindow.document.write(html);
printWindow.document.close();
}

    //Grade School Chart
    var bord = ["#3e95cd","#8e5ea2","#e8c3b9","#c45850","#3cba9f","#cddc39","#e91e63","#80deea","#ef9a9a","#263238"];
    labels = [];
    var set = [];
    var arr = [];
    $.each(chart_grade,function(k,v){
      if(k != "total"){
        labels.push(""+k);
      }
    });
    for (var i = 1; i < 11; i++) {
      $.each(chart_grade,function(k,v){
        if(k != "total"){
          //console.log(chart_grade[k][i]);
          if(chart_grade[k][i]){
            arr.push(chart_grade[k][i]);
          }else{
            arr.push(NaN);
          }
        }
      })
      set.push({
        label: "Grade "+i,
        data: arr,
        borderColor: bord[i-1],
        backgroundColor: bord[i-1]
      });
      arr = [];
      //console.dir(struct);

    }

    var grade_school_canvas = document.getElementById("grade_school_chart").getContext('2d');
    var gradeChart = new Chart(grade_school_canvas, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: set,
        fill: false
      },
        options: no_label_options
    });

    // Get the chart's base64 image string
document.getElementById('download_grade_school_chart').onclick = function() {
  // Trigger the download
  var a = document.createElement('a');
  a.href = gradeChart.toBase64Image();
  a.download = 'grade_school_chart.png';
  a.click();
}

document.getElementById('Print_grade_school_chart').onclick = function() {
var canvas = document.getElementById('grade_school_chart');
var data = canvas.toDataURL();
var html  = '<html><head><title></title></head>';
    html += '<body style="width: 100%; padding: 0; margin: 0;"';
    html += ' onload="window.focus(); window.print(); window.close()">';
    html += '<img src="' + data + '" /></body></html>';
var printWindow = window.open('_self', 'height=600,width=800');
printWindow.document.open();
printWindow.document.write(html);
printWindow.document.close();
}

    gradeChart.update();
    //Subject Comparison Chart
    data=[];
    labels=[];
    var sum=0;
    $.each(grade_subject,function(key,value){
      sum=0;
      $.each(value,function(k,v){
        sum+=parseInt(v);
      })
      labels.push(key);
      data.push(sum);
    })
    console.dir(data);
    var subject_canvas = document.getElementById("subject_chart").getContext('2d');
    var myChart4 = new Chart(subject_canvas,{
      type: 'bar',
      data: {
          labels: labels,
          datasets: [{
              label: '# of Sessions',
              data: data,
              backgroundColor: backgroundColor,
              borderColor: borderColor,
              borderWidth: 1
          }]
        },
        options
    })
    // Get the chart's base64 image string
document.getElementById('download_subject_chart').onclick = function() {
  // Trigger the download
  var a = document.createElement('a');
  a.href = myChart4.toBase64Image();
  a.download = 'subject_chart.png';
  a.click();
}

document.getElementById('Print_subject_chart').onclick = function() {
var canvas = document.getElementById('subject_chart');
var data = canvas.toDataURL();
var html  = '<html><head><title></title></head>';
    html += '<body style="width: 100%; padding: 0; margin: 0;"';
    html += ' onload="window.focus(); window.print(); window.close()">';
    html += '<img src="' + data + '" /></body></html>';
var printWindow = window.open('_self', 'height=600,width=800');
printWindow.document.open();
printWindow.document.write(html);
printWindow.document.close();
}
    //Grade Subject Chart

    labels = [];
    set = [];
    arr = [];

    for (var i = 1; i < 11; i++) {
      labels.push("Grade "+i);
      }
      var x=0;
    $.each(grade_subject,function(k,v){

      for (var i = 1; i < 11; i++) {
        if(grade_subject[k][i]){
          arr.push(grade_subject[k][i]);
        }else{
          arr.push(NaN);
        }
      }
      set.push({
        label: ""+k,
        data: arr,
        borderColor: bord[x],
        backgroundColor: bord[x++]
      });
      arr = [];
    })
      //console.dir(struct);

    var grade_subject_canvas = document.getElementById("grade_subject_chart").getContext('2d');
    var myChart5 = new Chart(grade_subject_canvas, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: set,
        fill: false
      },
        options
    });

    // Get the chart's base64 image string
document.getElementById('download_grade_subject_chart').onclick = function() {
  // Trigger the download
  var a = document.createElement('a');
  a.href = myChart5.toBase64Image();
  a.download = 'grade_subject_chart.png';
  a.click();
}

document.getElementById('Print_grade_subject_chart').onclick = function() {
var canvas = document.getElementById('grade_subject_chart');
var data = canvas.toDataURL();
var html  = '<html><head><title></title></head>';
    html += '<body style="width: 100%; padding: 0; margin: 0;"';
    html += ' onload="window.focus(); window.print(); window.close()">';
    html += '<img src="' + data + '" /></body></html>';
var printWindow = window.open('_self', 'height=600,width=800');
printWindow.document.open();
printWindow.document.write(html);
printWindow.document.close();
}
    

$("#stats_button").on('click',function(){

    let pid = $("#project_drop").val();
    window.open("dashboard.php?pid="+pid, "_self");
});
