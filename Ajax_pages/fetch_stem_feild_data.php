<?php
include("../connection.php");
  if(!empty($_POST['schoolid']) && !empty($_POST['moduleid'])){
if($_POST['moduleid']=='172'){ // STEM Lab Infra - STC BLR


  $msg .= " <div class=''>";

  if (in_array("16",$_SESSION['permissions'])) {
       $res_stem_lab_infra_data = $con -> query('SELECT * from stem_lab_infra_data where schoolid="'.$_POST["schoolid"].'"');
  }else{
    $res_stem_lab_infra_data = $con -> query('SELECT * from stem_lab_infra_data where schoolid="'.$_POST["schoolid"].'" and user_id="'.$_SESSION["exp_dash_id"].'"');
  }

 $rows_stem_lab_infra_data = mysqli_num_rows($res_stem_lab_infra_data);

 if($rows_stem_lab_infra_data>0){
foreach($res_stem_lab_infra_data as $lang){

    } }else{

    }
   $msg .= '</div>';
  
 $msg .= " <div class=''>";
     


      if (in_array("16",$_SESSION['permissions'])) {
        $res_steminframaterialdelivery_data_STC = $con -> query('SELECT * from stemlabinfrastc where schoolid="'.$_POST["schoolid"].'"');
  }else{
    $res_steminframaterialdelivery_data_STC = $con -> query('SELECT * from stemlabinfrastc where schoolid="'.$_POST["schoolid"].'" and user_id="'.$_SESSION["exp_dash_id"].'"');
  }

 $rows_steminframaterialdelivery_data_STC = mysqli_num_rows($res_steminframaterialdelivery_data_STC);

 if($rows_steminframaterialdelivery_data_STC>0){
foreach($res_steminframaterialdelivery_data_STC as $lang){

  $msg .= '<form method="post" action="addSTEMLabInfraSTC.php" id="STEMLabInfraSTC_update" enctype="multipart/form-data">
 <table class="table table-bordered" style="margin-left: -10%;">
    <thead>
      <tr>  
<th></th>
<th></th>
<th colspan="3"><span style="text-align: center;"></span></th>
<th></th>
<th colspan="3" style="text-align: center;">Pic/Video</th>
<th></th>
      </tr>
  <tr>

    <th >Modules</th>
    <th>Components</th>
    <th>Start date</th>
    <th>End Date</th>
    <th>Progress</th>
    <th>Units</th>
     <th>Before</th>
    <th>WIP</th>
    <th>After</th>
    <th>Issues/Changes</th>
    <th>Remarks</th>
  </tr>
  <tr>
    <th rowspan="5"><p style="margin-bottom: 100%;">STEM Lab Infra - STC BLR</p></th>
    <th>Electric Work</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker19"  class="tableres" name="EWork_sdate" value="'.date('d/m/Y',strtotime($lang['EWork_sdate'])).'" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker20" class="tableres" name="EWork_edate" value="'.date('d/m/Y',strtotime($lang['EWork_edate'])).'" autocomplete="off"></div></th>
    <th><input type="text" id="EWork_progress" class="tableres" name="EWork_progress" value="'.$lang['EWork_progress'].'" autocomplete="off"></th>
     <th><input type="text" id="EWork_units" class="tableres" name="EWork_units" value="'.$lang['EWork_units'].'" autocomplete="off"></th>
      <th><input type="file" id="EWork_Before" class="tableres" name="EWork_Before[]" value="'.$lang['EWork_Before'].'" autocomplete="off" multiple/></th>
     <th><input type="file" id="EWork_Wip" class="tableres" name="EWork_Wip[]" value="'.$lang['EWork_Wip'].'" autocomplete="off" multiple/></th>
     <th><input type="file" id="EWork_After" class="tableres" name="EWork_After[]" value="'.$lang['EWork_After'].'" autocomplete="off" multiple/></th>
    <th><input type="text" id="EWork_issues" class="tableres" name="EWork_issues" value="'.$lang['EWork_issues'].'" autocomplete="off"></th>
    <th><input type="text" id="EWork_remarks" class="tableres" name="EWork_remarks" value="'.$lang['EWork_remarks'].'" autocomplete="off"></th>
  </tr>

  

  <tr>
    <th>ModelDesks</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker23" class="tableres" name="modelDesks_sdate" value="'.date('d/m/Y',strtotime($lang['modelDesks_sdate'])).'" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker24" class="tableres" name="modelDesks_edate" value="'.date('d/m/Y',strtotime($lang['modelDesks_edate'])).'" autocomplete="off"></div></th>
    <th><input type="text" id="modelDesks_progress" class="tableres" name="modelDesks_progress" value="'.$lang['modelDesks_progress'].'" autocomplete="off"></th>
     <th><input type="text" id="modelDesks_units" class="tableres" name="modelDesks_units" value="'.$lang['modelDesks_units'].'" autocomplete="off"></th>
     <th><input type="file" id="modelDesks_Before" class="tableres" name="modelDesks_Before[]" value="'.$lang['modelDesks_Before'].'" autocomplete="off" multiple/></th>
     <th><input type="file" id="modelDesks_Wip" class="tableres" name="modelDesks_Wip[]" value="'.$lang['modelDesks_Wip'].'" autocomplete="off" multiple/></th>
     <th><input type="file" id="modelDesks_After" class="tableres" name="modelDesks_After[]" value="'.$lang['modelDesks_After'].'" autocomplete="off" multiple/></th>
    <th><input type="text" id="modelDesks_issues" class="tableres" name="modelDesks_issues" value="'.$lang['modelDesks_issues'].'" autocomplete="off"></th>
    <th><input type="text" id="modelDesks_remarks" class="tableres" name="modelDesks_remarks" value="'.$lang['modelDesks_remarks'].'" autocomplete="off"></th>
  </tr>

  <tr>
    <th>Cupboard</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker25" class="tableres" name="cupboard_sdate" value="'.date('d/m/Y',strtotime($lang['cupboard_sdate'])).'" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker26" class="tableres" name="cupboard_edate" value="'.date('d/m/Y',strtotime($lang['cupboard_edate'])).'" autocomplete="off"></div></th>
    <th><input type="text" id="cupboard_progress" class="tableres" name="cupboard_progress" value="'.$lang['cupboard_progress'].'" autocomplete="off"></th>
     <th><input type="text" id="cupboard_units" class="tableres" name="cupboard_units" value="'.$lang['cupboard_units'].'" autocomplete="off"></th>
     <th><input type="file" id="cupboard_Before" class="tableres" name="cupboard_Before[]" value="'.$lang['cupboard_Before'].'" autocomplete="off" multiple/></th>
     <th><input type="file" id="cupboard_Wip" class="tableres" name="cupboard_Wip[]" value="'.$lang['cupboard_Wip'].'" autocomplete="off" multiple/></th>
     <th><input type="file" id="cupboard_After" class="tableres" name="cupboard_After[]" value="'.$lang['cupboard_After'].'" autocomplete="off" multiple/></th>
    <th><input type="text" id="cupboard_issues" class="tableres" name="cupboard_issues" value="'.$lang['cupboard_issues'].'" autocomplete="off"></th>
    <th><input type="text" id="cupboard_remarks" class="tableres" name="cupboard_remarks" value="'.$lang['cupboard_remarks'].'" autocomplete="off"></th>
  </tr>

  <tr>
    <th>Solar</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker27" class="tableres" name="Solar_sdate" value="'.date('d/m/Y',strtotime($lang['Solar_sdate'])).'" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker28" class="tableres" name="Solar_edate" value="'.date('d/m/Y',strtotime($lang['Solar_edate'])).'" autocomplete="off"></div></th>
    <th><input type="text" id="Solar_progress" class="tableres" name="Solar_progress" value="'.$lang['Solar_progress'].'" autocomplete="off"></th>
     <th><input type="text" id="Solar_units" class="tableres" name="Solar_units" value="'.$lang['Solar_units'].'" autocomplete="off"></th>
     <th><input type="file" id="Solar_Before" class="tableres" name="Solar_Before[]" value="'.$lang['Solar_Before'].'" autocomplete="off" multiple/></th>
     <th><input type="file" id="Solar_Wip" class="tableres" name="Solar_Wip[]" value="'.$lang['Solar_Wip'].'" autocomplete="off" multiple/></th>
     <th><input type="file" id="Solar_After" class="tableres" name="Solar_After[]" value="'.$lang['Solar_After'].'" autocomplete="off" multiple/></th>
    <th><input type="text" id="Solar_issues" class="tableres" name="Solar_issues" value="'.$lang['Solar_issues'].'" autocomplete="off"></th>
    <th><input type="text" id="Solar_remarks" class="tableres" name="Solar_remarks" value="'.$lang['Solar_remarks'].'" autocomplete="off"></th>
  </tr>

  
  <input type="hidden" name="action" value="update" class="tableres">
   <input type="hidden" name="schoolid" class="schoolid">
   <input type="hidden" name="projectid" class="projectid">
   <input type="hidden" name="EWork_Before" value="'.$lang['EWork_Before'].'" class="tableres">
<input type="hidden" name="EWork_Wip" value="'.$lang['EWork_Wip'].'" class="tableres">
<input type="hidden" name="EWork_After" value="'.$lang['EWork_After'].'" class="tableres">
<input type="hidden" name="modelDesks_Before" value="'.$lang['modelDesks_Before'].'" class="tableres">
<input type="hidden" name="modelDesks_Wip" value="'.$lang['modelDesks_Wip'].'" class="tableres">
<input type="hidden" name="modelDesks_After" value="'.$lang['modelDesks_After'].'" class="tableres">
<input type="hidden" name="cupboard_Before" value="'.$lang['cupboard_Before'].'" class="tableres">
<input type="hidden" name="cupboard_Wip" value="'.$lang['cupboard_Wip'].'" class="tableres">
<input type="hidden" name="cupboard_After" value="'.$lang['cupboard_After'].'" class="tableres">
<input type="hidden" name="Solar_Before" value="'.$lang['Solar_Before'].'" class="tableres">
<input type="hidden" name="Solar_Wip" value="'.$lang['Solar_Wip'].'" class="tableres">
<input type="hidden" name="Solar_After" value="'.$lang['Solar_After'].'" class="tableres">
</thead>
     
    </tbody>
  </table>
  <button type="button" id="add_STEMLabInfraSTC_update" name="StemInfraMaterialDelivery" class="btn btn-success" style="float: right;">Update</button>
   
</form>';

  } }else{

$msg .='<form method="post" action="addSTEMLabInfraSTC.php" id="add_STEMLabInfraSTC" enctype="multipart/form-data">
  
 <table class="table table-bordered" style="margin-left: -10%;">
    <thead>
    
  <tr>
    <th>Modules</th>
    <th>Components</th>
    <th>Start Date</th>
    <th>End Date</th>
    <th>Progress</th>
    <th>Units</th>
    <th>Before</th>
    <th>WIP</th>
    <th>After</th>
    <th>Issues/Changes</th>
    <th>Remarks if any</th>
  </tr>
  <tr>
    <th rowspan="7"><p style="margin-bottom: 100%;">STEM Lab Infra - STC BLR</p></th>
    <th>Electric work</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker11"  class="tableres3" name="EWork_sdate" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker12" class="tableres3" name="EWork_edate" autocomplete="off"></div></th>
    <th><input type="text" id="EWork_progress" class="tableres3" name="EWork_progress" autocomplete="off"></th>
     <th><input type="text" id="EWork_units" class="tableres3" name="EWork_units" autocomplete="off"></th>
     <th><input type="file" id="EWork_Before" class="tableres3" name="EWork_Before[]" autocomplete="off" multiple/></th>
     <th><input type="file" id="EWork_Wip" class="tableres3" name="EWork_Wip[]" autocomplete="off" multiple/></th>
     <th><input type="file" id="EWork_After" class="tableres3" name="EWork_After[]" autocomplete="off" multiple/></th>
     <th><input type="text" id="EWork_issues" class="tableres3" name="EWork_issues" autocomplete="off" multiple/></th>
     <th><input type="text" id="EWork_remarks" class="tableres3" name="EWork_remarks" autocomplete="off" multiple/></th>
  </tr>

  

  <tr>
    <th>Model Desk</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker15" class="tableres3" name="modelDesks_sdate" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker16" class="tableres3" name="modelDesks_edate" autocomplete="off"></div></th>
    <th><input type="text" id="modelDesks_progress" class="tableres3" name="modelDesks_progress" autocomplete="off"></th>
     <th><input type="text" id="modelDesks_units" class="tableres3" name="modelDesks_units" autocomplete="off"></th>
     <th><input type="file" id="modelDesks_Before" class="tableres3" name="modelDesks_Before[]" autocomplete="off" multiple/></th>
     <th><input type="file" id="modelDesks_Wip" class="tableres3" name="modelDesks_Wip[]" autocomplete="off" multiple/></th>
     <th><input type="file" id="modelDesks_After" class="tableres3" name="modelDesks_After[]" autocomplete="off" multiple/></th>
     <th><input type="text" id="modelDesks_issues" class="tableres3" name="modelDesks_issues" autocomplete="off" multiple/></th>
     <th><input type="text" id="modelDesks_remarks" class="tableres3" name="modelDesks_remarks" autocomplete="off" multiple/></th>
  </tr>

  <tr>
    <th>Cupboard</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker17" class="tableres3" name="cupboard_sdate" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker18" class="tableres3" name="cupboard_edate" autocomplete="off"></div></th>
    <th><input type="text" id="cupboard_progress" class="tableres3" name="cupboard_progress" autocomplete="off"></th>
     <th><input type="text" id="cupboard_units" class="tableres3" name="cupboard_units" autocomplete="off"></th>
     <th><input type="file" id="cupboard_Before" class="tableres3" name="cupboard_Before[]" autocomplete="off" multiple/></th>
     <th><input type="file" id="cupboard_Wip" class="tableres3" name="cupboard_Wip[]" autocomplete="off" multiple/></th>
     <th><input type="file" id="cupboard_After" class="tableres3" name="cupboard_After[]" autocomplete="off" multiple/></th>
     <th><input type="text" id="cupboard_issues" class="tableres3" name="cupboard_issues" autocomplete="off" multiple/></th>
     <th><input type="text" id="cupboard_remarks" class="tableres3" name="cupboard_remarks" autocomplete="off" multiple/></th>
  </tr>


  

  <tr>
    <th>Solar power</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker19" class="tableres3" name="Solar_sdate" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker20" class="tableres3" name="Solar_edate" autocomplete="off"></div></th>
    <th><input type="text" id="Solar_progress" class="tableres3" name="Solar_progress" autocomplete="off"></th>
     <th><input type="text" id="Solar_units" class="tableres3" name="Solar_units" autocomplete="off"></th>
     <th><input type="file" id="Solar_Before" class="tableres3" name="Solar_Before[]" autocomplete="off" multiple/></th>
     <th><input type="file" id="Solar_Wip" class="tableres3" name="Solar_Wip[]" autocomplete="off" multiple/></th>
     <th><input type="file" id="Solar_After" class="tableres3" name="Solar_After[]" autocomplete="off" multiple/></th>
     <th><input type="text" id="Solar_issues" class="tableres3" name="Solar_issues" autocomplete="off" multiple/></th>
     <th><input type="text" id="Solar_remarks" class="tableres3" name="Solar_remarks" autocomplete="off" multiple/></th>
  </tr>
</thead>
     <input type="hidden" name="action" value="add" class="tableres">
      <input type="hidden" name="schoolid" class="schoolid">
      <input type="hidden" name="projectid" class="projectid">
  <input type="hidden" name="table" value="stemlabinfrastc" class="tableres">
    </tbody>
  </table>
    <button type="button" class="btn btn-success" id="STEMLabInfraSTC" style="float: right;">Save</button>
   
 </form>';
  }
$msg .='</div>
  <style>
 span#basic-addon1 {
    padding: 4px 2px 4px 4px;
}
.tableres3{
    width: 90px;
}
    </style>
<script>
 $(document).ready(function(){
    $("#STEMLabInfraSTC").click(function(){        
        $("#add_STEMLabInfraSTC").submit(); // Submit the form
    });

    $("#stem_lab_infra_datam").click(function(){        
        $("#add_stem_lab_infra_datam").submit(); // Submit the form
    });
 
  $("#add_STEMLabInfraSTC_update").click(function(){    
        $("#STEMLabInfraSTC_update").submit(); 
    });
$(".schoolid").val($("#school_drop").val());
$(".projectid").val($("#project_drop").val());
    

});
</script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker2" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker3" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker4" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker5" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker6" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker7" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker8" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker9" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker10" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker11" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker12" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker13" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker14" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker15" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker16" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker17" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker18" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker19" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker20" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker21" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker22" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker23" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker24" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker25" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker26" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker27" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker28" ).datepicker({ dateFormat: "dd/mm/yy" });

    $( "#datepickerm" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker2m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker3m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker4m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker5m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker6m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker7m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker8m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker9m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker10m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker11m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker12m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker13m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker14m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker15m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker16m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker17m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker18m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker19m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker20m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker21m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker22m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker23m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker24m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker25m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker26m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker27m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker28m" ).datepicker({ dateFormat: "dd/mm/yy" });
  } );
  </script>
  ';
  echo $msg;

   }elseif($_POST['moduleid']=='173'){ // Stem Infra Material Delivery



    $msg .= " <div class=''>";
     if (in_array("16",$_SESSION['permissions'])) {
        $res_stem_lab_infra_data = $con -> query('SELECT * from stem_lab_infra_data where schoolid="'.$_POST["schoolid"].'"');
  }else{
    $res_stem_lab_infra_data = $con -> query('SELECT * from stem_lab_infra_data where schoolid="'.$_POST["schoolid"].'" and user_id="'.$_SESSION["exp_dash_id"].'"');
  }

      

 $rows_stem_lab_infra_data = mysqli_num_rows($res_stem_lab_infra_data);

 if($rows_stem_lab_infra_data>0){
foreach($res_stem_lab_infra_data as $lang){

    } }else{

    }
   $msg .= '</div>';
  
 $msg .= " <div class=''>";

 if (in_array("16",$_SESSION['permissions'])) {
       $res_steminframaterialdelivery_data = $con -> query('SELECT * from steminframaterialdelivery where schoolid="'.$_POST["schoolid"].'"');
  }else{
   $res_steminframaterialdelivery_data = $con -> query('SELECT * from steminframaterialdelivery where schoolid="'.$_POST["schoolid"].'" and user_id="'.$_SESSION["exp_dash_id"].'"');
  }

  
      

 $rows_steminframaterialdelivery_data = mysqli_num_rows($res_steminframaterialdelivery_data);

 if($rows_steminframaterialdelivery_data>0){
foreach($res_steminframaterialdelivery_data as $lang){

   if(!empty($lang['EWork_sdate'])){
$EWork_sdate1 = date('d/m/Y',strtotime($lang['EWork_sdate']));
  }else{
$EWork_sdate1 ='';
    }

     if(!empty($lang['EWork_edate'])){
$EWork_edate1 = date('d/m/Y',strtotime($lang['EWork_edate']));
  }else{
$EWork_edate1 ='';
    }

     if(!empty($lang['painting_sdate'])){
$painting_sdate1 = date('d/m/Y',strtotime($lang['painting_sdate']));
  }else{
$painting_sdate1 ='';
    }

     if(!empty($lang['painting_edate'])){
$painting_edate1 = date('d/m/Y',strtotime($lang['painting_edate']));
  }else{
$painting_edate1 ='';
    }

     if(!empty($lang['modelDesks_sdate'])){
$modelDesks_sdate1 = date('d/m/Y',strtotime($lang['modelDesks_sdate']));
  }else{
$modelDesks_sdate1 ='';
    }

     if(!empty($lang['modelDesks_edate'])){
$modelDesks_edate1 = date('d/m/Y',strtotime($lang['modelDesks_edate']));
  }else{
$modelDesks_edate1 ='';
    }

     if(!empty($lang['cupboard_sdate'])){
$cupboard_sdate1 = date('d/m/Y',strtotime($lang['cupboard_sdate']));
  }else{
$cupboard_sdate1 ='';
    }

     if(!empty($lang['cupboard_edate'])){
$cupboard_edate1 = date('d/m/Y',strtotime($lang['cupboard_edate']));
  }else{
$cupboard_edate1 ='';
    }

     if(!empty($lang['flooring_sdate'])){
$flooring_sdate1 = date('d/m/Y',strtotime($lang['flooring_sdate']));
  }else{
$flooring_sdate1 ='';
    }

     if(!empty($lang['flooring_edate'])){
$flooring_edate1 = date('d/m/Y',strtotime($lang['flooring_edate']));
  }else{
$flooring_edate1 ='';
    }

     if(!empty($lang['Solar_sdate'])){
$Solar_sdate1 = date('d/m/Y',strtotime($lang['Solar_sdate']));
  }else{
$Solar_sdate1 ='';
    }

     if(!empty($lang['Solar_edate'])){
$Solar_edate1 = date('d/m/Y',strtotime($lang['Solar_edate']));
  }else{
$Solar_edate1 ='';
    }

  $msg .= '<form method="post" action="addStemInfraMaterialDelivery.php" id="add_StemInfraMaterialDelivery_update2" enctype="multipart/form-data">
 <table class="table table-bordered" style="margin-left: -10%;">
    <thead>
    
  <tr>
    <th>Modules</th>
    <th>Components</th>
    <th>Dispatch Date</th>
    <th>Delivery Date</th>
    <th>Progress</th>
    <th>Units description</th>
    <th>Photos</th>
    <th>Remarks if any</th>
  </tr>
  <tr>
    <th rowspan="7"><p style="margin-bottom: 100%;">STEM Lab Infra</p></th>
    <th>Electric Work</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker19"  class="tableres4" name="EWork_sdate" value="'.$EWork_sdate1.'" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker20" class="tableres4" name="EWork_edate" value="'.$EWork_edate1.'" autocomplete="off"></div></th>
    <th><input type="text" id="progress" class="tableres4" name="EWork_progress" value="'.$lang['EWork_progress'].'" autocomplete="off"></th>
     <th><input type="text" id="units" class="tableres4" name="EWork_units" value="'.$lang['EWork_units'].'" autocomplete="off"></th>
     <th><input type="file" id="EWork_brefore" class="tableres4" name="EWork_brefore[]" value="'.$lang['EWork_brefore'].'" autocomplete="off" multiple/></th>
    <th><input type="text" id="remarks" class="tableres4" name="EWork_remarks" value="'.$lang['EWork_remarks'].'" autocomplete="off"></th>
  </tr>

  <tr>
    <th>Painting</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker21" class="tableres4" name="painting_sdate" value="'.$painting_sdate1.'" autocomplete="off"></siv></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker22" class="tableres4" name="painting_edate" value="'.$painting_edate1.'" autocomplete="off"></div></th>
    <th><input type="text" id="progress" class="tableres4" name="painting_progress" value="'.$lang['painting_progress'].'" autocomplete="off"></th>
     <th><input type="text" id="units" class="tableres4" name="painting_units" value="'.$lang['painting_units'].'" autocomplete="off"></th>
  
     <th><input type="file" id="painting_brefore" class="tableres4" name="painting_brefore[]" value="'.$lang['painting_brefore'].'" autocomplete="off" multiple/></th>
    <th><input type="text" id="remarks" class="tableres4" name="painting_remarks" value="'.$lang['painting_remarks'].'" autocomplete="off"></th>
  </tr>

  <tr>
    <th>ModelDesks</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker23" class="tableres4" name="modelDesks_sdate" value="'.$modelDesks_sdate1.'" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker24" class="tableres4" name="modelDesks_edate" value="'.$modelDesks_edate1.'" autocomplete="off"></div></th>
    <th><input type="text" id="progress" class="tableres4" name="modelDesks_progress" value="'.$lang['modelDesks_progress'].'" autocomplete="off"></th>
     <th><input type="text" id="units" class="tableres4" name="modelDesks_units" value="'.$lang['modelDesks_units'].'" autocomplete="off"></th>
     <th><input type="file" id="modelDesks_brefore" class="tableres4" name="modelDesks_brefore[]" value="'.$lang['modelDesks_brefore'].'" autocomplete="off" multiple/></th>
    <th><input type="text" id="remarks" class="tableres4" name="modelDesks_remarks" value="'.$lang['modelDesks_remarks'].'" autocomplete="off"></th>
  </tr>

  <tr>
    <th>Cupboard</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker25" class="tableres4" name="cupboard_sdate" value="'.$cupboard_sdate1.'" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker26" class="tableres4" name="cupboard_edate" value="'.$cupboard_edate1.'" autocomplete="off"></div></th>
    <th><input type="text" id="progress" class="tableres4" name="cupboard_progress" value="'.$lang['cupboard_progress'].'" autocomplete="off"></th>
     <th><input type="text" id="units" class="tableres4" name="cupboard_units" value="'.$lang['cupboard_units'].'" autocomplete="off"></th>
     <th><input type="file" id="cupboard_brefore" class="tableres4" name="cupboard_brefore[]" value="'.$lang['cupboard_brefore'].'" autocomplete="off" multiple/></th>
    <th><input type="text" id="remarks" class="tableres4" name="cupboard_remarks" value="'.$lang['cupboard_remarks'].'" autocomplete="off"></th>
  </tr>

  <tr>
    <th>Flooring</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker27" class="tableres4" name="flooring_sdate" value="'.$flooring_sdate1.'" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker28" class="tableres4" name="flooring_edate" value="'.$flooring_edate1.'" autocomplete="off"></div></th>
    <th><input type="text" id="progress" class="tableres4" name="flooring_progress" value="'.$lang['flooring_progress'].'" autocomplete="off"></th>
     <th><input type="text" id="units" class="tableres4" name="flooring_units" value="'.$lang['flooring_units'].'" autocomplete="off"></th>
     <th><input type="file" id="flooring_brefore" class="tableres4" name="flooring_brefore[]" value="'.$lang['flooring_brefore'].'" autocomplete="off" multiple/></th>
    <th><input type="text" id="remarks" class="tableres4" name="flooring_remarks" value="'.$lang['flooring_remarks'].'" autocomplete="off"></th>
  </tr>

   <tr>
    <th>Solar power</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker11" class="tableres4" name="Solar_sdate" value="'.$Solar_sdate1.'" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker12" class="tableres4" name="Solar_edate" value="'.$Solar_edate1.'" autocomplete="off"></div></th>
    <th><input type="text" id="Solar_progress" class="tableres4" name="Solar_progress" value="'.$lang['Solar_progress'].'"  autocomplete="off"></th>
     <th><input type="text" id="Solar_units" class="tableres4" name="Solar_units" value="'.$lang['Solar_units'].'"  autocomplete="off"></th>
     <th><input type="file" id="Solar_brefore" class="tableres4" name="Solar_brefore[]" value="'.$lang['Solar_brefore'].'"  autocomplete="off" multiple/></th>
     <th><input type="text" id="Solar_remarks" class="tableres4" name="Solar_remarks" value="'.$lang['Solar_remarks'].'"  autocomplete="off" multiple/></th>
  </tr>
  <input type="hidden" name="action" value="update" class="tableres">
   <input type="hidden" name="schoolid" class="schoolid">
   <input type="hidden" name="projectid" class="projectid">
<input type="hidden" name="EWork_brefore" value="'.$lang['EWork_brefore'].'" class="tableres">
<input type="hidden" name="painting_brefore" value="'.$lang['painting_brefore'].'" class="tableres">
<input type="hidden" name="modelDesks_brefore" value="'.$lang['modelDesks_brefore'].'" class="tableres">
<input type="hidden" name="cupboard_brefore" value="'.$lang['cupboard_brefore'].'" class="tableres">
<input type="hidden" name="flooring_brefore" value="'.$lang['flooring_brefore'].'" class="tableres">
<input type="hidden" name="Solar_brefore" value="'.$lang['Solar_brefore'].'" class="tableres">
</thead>
     
    </tbody>
  </table>
  <button type="button" id="StemInfraMaterialDelivery_update2" name="steminframaterialdelivery" class="btn btn-success" style="float: right;">Update</button>
   
</form>';

  } }else{

$msg .='<form method="post" action="addStemInfraMaterialDelivery.php" id="add_StemInfraMaterialDelivery2" enctype="multipart/form-data">
  
 <table class="table table-bordered" style="margin-left: -10%;">
    <thead>
    
  <tr>
    <th>Modules</th>
    <th>Components</th>
    <th>Dispatch Date</th>
    <th>Delivery Date</th>
    <th>Progress</th>
    <th>Units description</th>
    <th>Photos</th>
    <th>Remarks if any</th>
  </tr>
  <tr>
    <th rowspan="7"><p style="margin-bottom: 100%;">STEM Infra Material Delivery</p></th>
    <th>Electric work</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker11"  class="tableres2" name="EWork_sdate" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker12" class="tableres2" name="EWork_edate" autocomplete="off"></div></th>
    <th><input type="text" id="EWork_progress" class="tableres2" name="EWork_progress" autocomplete="off"></th>
     <th><input type="text" id="EWork_units" class="tableres2" name="EWork_units" autocomplete="off"></th>
     <th><input type="file" id="EWork_brefore" class="tableres2" name="EWork_brefore[]" autocomplete="off" multiple/></th>
     <th><input type="text" id="EWork_remarks" class="tableres2" name="EWork_remarks" autocomplete="off" multiple/></th>
  </tr>

  <tr>
    <th>Painting</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker13" class="tableres2" name="painting_sdate" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker14" class="tableres2" name="painting_edate" autocomplete="off"></div></th>
    <th><input type="text" id="painting_progress" class="tableres2" name="painting_progress" autocomplete="off"></th>
     <th><input type="text" id="painting_units" class="tableres2" name="painting_units" autocomplete="off"></th>
     <th><input type="file" id="painting_brefore" class="tableres2" name="painting_brefore[]" autocomplete="off" multiple/></th>
     <th><input type="text" id="painting_remarks" class="tableres2" name="painting_remarks" autocomplete="off" multiple/></th>
  </tr>

  <tr>
    <th>Model Desk</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker15" class="tableres2" name="modelDesks_sdate" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker16" class="tableres2" name="modelDesks_edate" autocomplete="off"></div></th>
    <th><input type="text" id="modelDesks_progress" class="tableres2" name="modelDesks_progress" autocomplete="off"></th>
     <th><input type="text" id="modelDesks_units" class="tableres2" name="modelDesks_units" autocomplete="off"></th>
     <th><input type="file" id="modelDesks_brefore" class="tableres2" name="modelDesks_brefore[]" autocomplete="off" multiple/></th>
     <th><input type="text" id="modelDesks_remarks" class="tableres2" name="modelDesks_remarks" autocomplete="off" multiple/></th>
  </tr>

  <tr>
    <th>Cupboard</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker17" class="tableres2" name="cupboard_sdate" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker18" class="tableres2" name="cupboard_edate" autocomplete="off"></div></th>
    <th><input type="text" id="cupboard_progress" class="tableres2" name="cupboard_progress" autocomplete="off"></th>
     <th><input type="text" id="cupboard_units" class="tableres2" name="cupboard_units" autocomplete="off"></th>
     <th><input type="file" id="cupboard_brefore" class="tableres2" name="cupboard_brefore[]" autocomplete="off" multiple/></th>
     <th><input type="text" id="cupboard_remarks" class="tableres2" name="cupboard_remarks" autocomplete="off" multiple/></th>
  </tr>


  <tr>
    <th>Flooring</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker27" class="tableres2" name="flooring_sdate" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker28" class="tableres2" name="flooring_edate" autocomplete="off"></div></th>
    <th><input type="text" id="flooring_progress" class="tableres2" name="flooring_progress" autocomplete="off"></th>
     <th><input type="text" id="flooring_units" class="tableres2" name="flooring_units" autocomplete="off"></th>
     <th><input type="file" id="flooring_brefore" class="tableres2" name="flooring_brefore[]" autocomplete="off" multiple/></th>
     <th><input type="text" id="flooring_remarks" class="tableres2" name="flooring_remarks" autocomplete="off" multiple/></th>
  </tr>

  <tr>
    <th>Solar power</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker19" class="tableres2" name="Solar_sdate" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker20" class="tableres2" name="Solar_edate" autocomplete="off"></div></th>
    <th><input type="text" id="Solar_progress" class="tableres2" name="Solar_progress" autocomplete="off"></th>
     <th><input type="text" id="Solar_units" class="tableres2" name="Solar_units" autocomplete="off"></th>
     <th><input type="file" id="Solar_brefore" class="tableres2" name="Solar_brefore[]" autocomplete="off" multiple/></th>
     <th><input type="text" id="Solar_remarks" class="tableres2" name="Solar_remarks" autocomplete="off" multiple/></th>
  </tr>
</thead>
     <input type="hidden" name="action" value="add" class="tableres">
      <input type="hidden" name="schoolid" class="schoolid">
      <input type="hidden" name="projectid" class="projectid">
  <input type="hidden" name="table" value="StemInfraMaterialDelivery" class="tableres">
    </tbody>
  </table>
    <button type="button" class="btn btn-success" id="StemInfraMaterialDelivery2" style="float: right;">Save</button>
   
 </form>';
  }
$msg .='</div>
  <style>
 span#basic-addon1 {
    padding: 4px 2px 4px 4px;
}
.tableres2{
    width: 150px;
}

.tableres4 {
    width: 150px;
}
    </style>
<script>
 $(document).ready(function(){
    $("#StemInfraMaterialDelivery2").click(function(){        
        $("#add_StemInfraMaterialDelivery2").submit(); // Submit the form
    });

    $("#StemInfraMaterialDeliverym").click(function(){        
        $("#add_StemInfraMaterialDeliverym").submit(); // Submit the form
    });

  $("#StemInfraMaterialDelivery_update2").click(function(){    
        $("#add_StemInfraMaterialDelivery_update2").submit(); 
    });
$(".schoolid").val($("#school_drop").val());
$(".projectid").val($("#project_drop").val());
    

});
</script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker2" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker3" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker4" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker5" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker6" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker7" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker8" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker9" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker10" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker11" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker12" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker13" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker14" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker15" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker16" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker17" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker18" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker19" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker20" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker21" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker22" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker23" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker24" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker25" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker26" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker27" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker28" ).datepicker({ dateFormat: "dd/mm/yy" });

    $( "#datepickerm" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker2m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker3m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker4m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker5m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker6m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker7m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker8m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker9m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker10m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker11m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker12m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker13m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker14m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker15m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker16m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker17m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker18m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker19m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker20m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker21m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker22m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker23m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker24m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker25m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker26m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker27m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker28m" ).datepicker({ dateFormat: "dd/mm/yy" });
  } );
  </script>
  ';
  echo $msg;

 }elseif($_POST['moduleid']=='171'){ //STEM Impact Assessment

      //Innaugration
if (in_array("16",$_SESSION['permissions'])) {
        $res_stem_models_data = $con -> query('SELECT * from innaugration where schoolid="'.$_POST["schoolid"].'"');
  }else{
    $res_stem_models_data = $con -> query('SELECT * from innaugration where schoolid="'.$_POST["schoolid"].'" and user_id="'.$_SESSION["exp_dash_id"].'" ');
  }
      

 $rows_stem_models_data = mysqli_num_rows($res_stem_models_data);

 if($rows_stem_models_data>0){
foreach($res_stem_models_data as $lang){
  if(!empty($lang['InnaugrationDate'])){
$newdate = date('d/m/Y',strtotime($lang['InnaugrationDate']));
  }else{
$newdate ='';
    }
   $msg .='<form method="post" action="add_Innaugration.php" id="add_Innaugration" enctype="multipart/form-data">
  
 <table class="table table-bordered" style="margin-left: -10%;">
    <thead>
  <tr>
    <th>Modules</th>
    <th>Images</th>
    <th>Date</th>
  </tr>
  <tr>
    <th><p>Innaugration</p></th>
    <th><input type="file" name="InnaugrationName[]" multiple></th>
  <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker51"  class="tableres" name="InnaugrationDate" value="'.$newdate.'" autocomplete="off"></div></th>
  </tr>
</thead>
     <input type="hidden" name="action" value="update" class="tableres">
      <input type="hidden" name="schoolid" class="schoolid">
      <input type="hidden" name="projectid" class="projectid">
  <input type="hidden" name="table" value="innaugration" class="tableres">
    </tbody>
  </table>
    <button type="button" class="btn btn-success" id="add_Innaugration_data" style="float: right;">Save</button>
   
 </form>';
 $msg .='</div>
  <style>
 span#basic-addon1 {
    padding: 4px 2px 4px 4px;
}
    </style>
<script>
 $(document).ready(function(){
    $("#add_Innaugration_data").click(function(){    
        $("#add_Innaugration").submit(); 
    });
     $("#STEM_Lab_Models_datam").click(function(){     
        $("#add_STEM_Lab_Modelsm").submit(); 
    });

  $("#STEM_Lab_Models_data_update").click(function(){    
        $("#add_STEM_Lab_Models_update").submit(); 
    });
$(".schoolid").val($("#school_drop").val());
$(".projectid").val($("#project_drop").val());
});
</script>
<script>
  $( function() {
    $( "#datepicker51" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker52" ).datepicker({ dateFormat: "dd/mm/yy" });
  } );
  </script>
  ';
echo $msg;

} }else{

  $msg .='<form method="post" action="add_Innaugration.php" id="add_Innaugration" enctype="multipart/form-data">
 <table class="table table-bordered" style="margin-left: -10%;">
    <thead>
  <tr>
    <th>Modules</th>
    <th>Images</th>
    <th>Date</th>
  </tr>
  <tr>
    <th><p>Innaugration</p></th>
    <th><input type="file" name="InnaugrationName[]" multiple></th>
  <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker51"  class="tableres" name="InnaugrationDate" autocomplete="off"></div></th>
  </tr>
</thead>
     <input type="hidden" name="action" value="add" class="tableres">
      <input type="hidden" name="schoolid" class="schoolid">
      <input type="hidden" name="projectid" class="projectid">
  <input type="hidden" name="table" value="innaugration" class="tableres">
    </tbody>
  </table>
    <button type="button" class="btn btn-success" id="add_Innaugration_data" style="float: right;">Save</button>
   
 </form>';
 $msg .='</div>
  <style>
 span#basic-addon1 {
    padding: 4px 2px 4px 4px;
}
    </style>
<script>
 $(document).ready(function(){
    $("#add_Innaugration_data").click(function(){    
        $("#add_Innaugration").submit(); 
    });
     $("#STEM_Lab_Models_datam").click(function(){     
        $("#add_STEM_Lab_Modelsm").submit(); 
    });

  $("#STEM_Lab_Models_data_update").click(function(){    
        $("#add_STEM_Lab_Models_update").submit(); 
    });
$(".schoolid").val($("#school_drop").val());
$(".projectid").val($("#project_drop").val());
});
</script>
<script>
  $( function() {
    $( "#datepicker51" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker52" ).datepicker({ dateFormat: "dd/mm/yy" });
  } );
  </script>
  ';
echo $msg;

}

         }elseif($_POST['moduleid']=='167'){ //STEM Impact Assessment

        if (in_array("16",$_SESSION['permissions'])) {
        $res_stem_models_data = $con -> query('SELECT * from stemimpactassessment where schoolid="'.$_POST["schoolid"].'"');
  }else{
    $res_stem_models_data = $con -> query('SELECT * from stemimpactassessment where schoolid="'.$_POST["schoolid"].'" and user_id="'.$_SESSION["exp_dash_id"].'" ');
  }
      

 $rows_stem_models_data = mysqli_num_rows($res_stem_models_data);

 if($rows_stem_models_data>0){
foreach($res_stem_models_data as $lang){
   if(!empty($lang['StemImpactDate'])){
$newdate2 = date('d/m/Y',strtotime($lang['StemImpactDate']));
  }else{
$newdate2 ='';
    }


   $msg .='<form method="post" action="addSTEMImpactAssessment.php" id="addSTEMImpactAssessment" enctype="multipart/form-data">
 <table class="table table-bordered" style="margin-left: -10%;">
    <thead>
  <tr>
    <th>Modules</th>
    <th>Images</th>
    <th>Date</th>
  </tr>
  <tr>
    <th><p>STEM Impact Assessment</p></th>
    <th><input type="file" name="StemImpactName[]" multiple></th>
  <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker51"  class="tableres" name="StemImpactDate" value="'.$newdate2.'"  autocomplete="off"></div></th>
  </tr>
</thead>
     <input type="hidden" name="action" value="update" class="tableres">
      <input type="hidden" name="schoolid" class="schoolid">
      <input type="hidden" name="projectid" class="projectid">
  <input type="hidden" name="table" value="stem_lab_infra_data" class="tableres">
    </tbody>
  </table>
    <button type="button" class="btn btn-success" id="addSTEMImpactAssessment_data" style="float: right;">Save</button>
   
 </form>';
 $msg .='</div>
  <style>
 span#basic-addon1 {
    padding: 4px 2px 4px 4px;
}
    </style>
<script>
 $(document).ready(function(){
    $("#addSTEMImpactAssessment_data").click(function(){    
        $("#addSTEMImpactAssessment").submit(); 
    });
     $("#STEM_Lab_Models_datam").click(function(){     
        $("#add_STEM_Lab_Modelsm").submit(); 
    });

  $("#STEM_Lab_Models_data_update").click(function(){    
        $("#add_STEM_Lab_Models_update").submit(); 
    });
$(".schoolid").val($("#school_drop").val());
$(".projectid").val($("#project_drop").val());
});
</script>
<script>
  $( function() {
    $( "#datepicker51" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker52" ).datepicker({ dateFormat: "dd/mm/yy" });
  } );
  </script>
  ';
echo $msg;

} }else{

  $msg .='<form method="post" action="addSTEMImpactAssessment.php" id="addSTEMImpactAssessment" enctype="multipart/form-data">
 <table class="table table-bordered" style="margin-left: -10%;">
    <thead>
  <tr>
    <th>Modules</th>
    <th>Images</th>
    <th>Date</th>
  </tr>
  <tr>
    <th><p>STEM Impact Assessment</p></th>
    <th><input type="file" name="StemImpactName[]" multiple></th>
  <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker51"  class="tableres" name="StemImpactDate" autocomplete="off"></div></th>
  </tr>
</thead>
     <input type="hidden" name="action" value="add" class="tableres">
      <input type="hidden" name="schoolid" class="schoolid">
      <input type="hidden" name="projectid" class="projectid">
  <input type="hidden" name="table" value="stem_lab_infra_data" class="tableres">
    </tbody>
  </table>
    <button type="button" class="btn btn-success" id="addSTEMImpactAssessment_data" style="float: right;">Save</button>
   
 </form>';
 $msg .='</div>
  <style>
 span#basic-addon1 {
    padding: 4px 2px 4px 4px;
}
    </style>
<script>
 $(document).ready(function(){
    $("#addSTEMImpactAssessment_data").click(function(){    
        $("#addSTEMImpactAssessment").submit(); 
    });
     $("#STEM_Lab_Models_datam").click(function(){     
        $("#add_STEM_Lab_Modelsm").submit(); 
    });

  $("#STEM_Lab_Models_data_update").click(function(){    
        $("#add_STEM_Lab_Models_update").submit(); 
    });
$(".schoolid").val($("#school_drop").val());
$(".projectid").val($("#project_drop").val());
});
</script>
<script>
  $( function() {
    $( "#datepicker51" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker52" ).datepicker({ dateFormat: "dd/mm/yy" });
  } );
  </script>
  ';
echo $msg;

}

             }elseif($_POST['moduleid']=='80'){ //Teacher Training

             if (in_array("16",$_SESSION['permissions'])) {
        $res_stem_models_data = $con -> query('SELECT * from teachertraining where schoolid="'.$_POST["schoolid"].'"');
  }else{
    $res_stem_models_data = $con -> query('SELECT * from teachertraining where schoolid="'.$_POST["schoolid"].'" and user_id="'.$_SESSION["exp_dash_id"].'" ');
  }
      

 $rows_stem_models_data = mysqli_num_rows($res_stem_models_data);

 if($rows_stem_models_data>0){
foreach($res_stem_models_data as $lang){
   if(!empty($lang['teacherTrainingDate'])){
$teacherTrainingDate = date('d/m/Y',strtotime($lang['teacherTrainingDate']));
  }else{
$teacherTrainingDate ='';
    }

     if(!empty($lang['teacherTraining_eDate'])){
$teacherTraining_eDate = date('d/m/Y',strtotime($lang['teacherTraining_eDate']));
  }else{
$teacherTraining_eDate ='';
    }
   $msg .='<form method="post" action="addTeacherTraining.php" id="addTeacherTraining" enctype="multipart/form-data">
 <table class="table table-bordered" style="margin-left: -10%;">
    <thead>
  <tr>
    <th>Modules</th>
    <th>Images</th>
    <th>Start Date</th>
     <th>End Date</th>
  </tr>
  <tr>
    <th><p>Teacher Training</p></th>
    <th><input type="file" name="teacherTrainingName[]" multiple></th>
  <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker51"  class="tableres" name="teacherTrainingDate" value="'.$teacherTrainingDate.'" autocomplete="off"></div></th>

  <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker52"  class="tableres" name="teacherTraining_eDate" value="'.$teacherTraining_eDate.'" autocomplete="off"></div></th>
  </tr>
</thead>
     <input type="hidden" name="action" value="update" class="tableres">
      <input type="hidden" name="schoolid" class="schoolid">
      <input type="hidden" name="projectid" class="projectid">
  <input type="hidden" name="table" value="stem_lab_infra_data" class="tableres">
    </tbody>
  </table>
    <button type="button" class="btn btn-success" id="addTeacherTraining_data" style="float: right;">Save</button>
   
 </form>';
 $msg .='</div>
  <style>
 span#basic-addon1 {
    padding: 4px 2px 4px 4px;
}
    </style>
<script>
 $(document).ready(function(){
    $("#addTeacherTraining_data").click(function(){    
        $("#addTeacherTraining").submit(); 
    });
     $("#STEM_Lab_Models_datam").click(function(){     
        $("#add_STEM_Lab_Modelsm").submit(); 
    });

  $("#STEM_Lab_Models_data_update").click(function(){    
        $("#add_STEM_Lab_Models_update").submit(); 
    });
$(".schoolid").val($("#school_drop").val());
$(".projectid").val($("#project_drop").val());
});
</script>
<script>
  $( function() {
    $( "#datepicker51" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker52" ).datepicker({ dateFormat: "dd/mm/yy" });
  } );
  </script>
  ';
echo $msg;

} }else{

 $msg .='<form method="post" action="addTeacherTraining.php" id="addTeacherTraining" enctype="multipart/form-data">
 <table class="table table-bordered" style="margin-left: -10%;">
    <thead>
  <tr>
    <th>Modules</th>
    <th>Images</th>
    <th>Start Date</th>
     <th>End Date</th>
  </tr>
  <tr>
    <th><p>Teacher Training</p></th>
    <th><input type="file" name="teacherTrainingName[]" multiple></th>
  <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker51"  class="tableres" name="teacherTrainingDate" autocomplete="off"></div></th>

  <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker52"  class="tableres" name="teacherTraining_eDate" autocomplete="off"></div></th>
  </tr>
</thead>
     <input type="hidden" name="action" value="add" class="tableres">
      <input type="hidden" name="schoolid" class="schoolid">
      <input type="hidden" name="projectid" class="projectid">
  <input type="hidden" name="table" value="stem_lab_infra_data" class="tableres">
    </tbody>
  </table>
    <button type="button" class="btn btn-success" id="addTeacherTraining_data" style="float: right;">Save</button>
   
 </form>';
 $msg .='</div>
  <style>
 span#basic-addon1 {
    padding: 4px 2px 4px 4px;
}
    </style>
<script>
 $(document).ready(function(){
    $("#addTeacherTraining_data").click(function(){    
        $("#addTeacherTraining").submit(); 
    });
     $("#STEM_Lab_Models_datam").click(function(){     
        $("#add_STEM_Lab_Modelsm").submit(); 
    });

  $("#STEM_Lab_Models_data_update").click(function(){    
        $("#add_STEM_Lab_Models_update").submit(); 
    });
$(".schoolid").val($("#school_drop").val());
$(".projectid").val($("#project_drop").val());
});
</script>
<script>
  $( function() {
    $( "#datepicker51" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker52" ).datepicker({ dateFormat: "dd/mm/yy" });
  } );
  </script>
  ';
echo $msg;

}

     }elseif($_POST['moduleid']=='114'){
      $msg .= " <div class='d-md-none'>";
      if (in_array("16",$_SESSION['permissions'])) {
        $res_stem_models_data = $con -> query('SELECT * from stem_models_data where schoolid="'.$_POST["schoolid"].'"');
  }else{
    $res_stem_models_data = $con -> query('SELECT * from stem_models_data where schoolid="'.$_POST["schoolid"].'" and user_id="'.$_SESSION["exp_dash_id"].'" ');
  }
      

 $rows_stem_models_data = mysqli_num_rows($res_stem_models_data);

 if($rows_stem_models_data>0){
foreach($res_stem_models_data as $lang){
     
     $msg .= '<form method="post" action="addstemModelsdata.php" id="add_STEM_Lab_Modelsm" enctype="multipart/form-data">
  <h2>STEM Lab Models</h2>
  <div class="col-sm-2"></div>
  <div class="col-sm-8">
  <h3>Components - Science</h3>
  <h5>Dispatch Date</h5>
 <input type="text" id="datepicker11m"  class="form-control" name="science_sdate" value="'.$lang['science_sdate'].'" autocomplete="off">

  <h5>End Date</h5>
 <input type="text" id="datepicker12m" class="form-control" name="science_edate" value="'.$lang['science_edate'].'" autocomplete="off">

  <h5>Progress</h5>
 <input type="text" id="science_progress" class="form-control" name="science_progress" value="'.$lang['science_progress'].'" autocomplete="off">

  <h5>Units</h5>
   <input type="text" id="science_units" class="form-control" name="science_units" value="'.$lang['science_units'].'" autocomplete="off">

  <h5>WIP</h5>
   <input type="file" id="science_wip" class="form-control" name="science_wip[]" value="'.$lang['science_wip'].'" autocomplete="off" multiple/>

  <h5>After</h5>
  <input type="file" id="science_after" class="form-control" name="science_after[]" value="'.$lang['science_after'].'" autocomplete="off" multiple/>

  <h5>Issues/Changes</h5>
  <input type="text" id="science_issues" class="form-control" name="science_issues" value="'.$lang['science_issues'].'" autocomplete="off">

  <h5>Remarks</h5>
<input type="text" id="science_remarks" class="form-control" name="science_remarks" value="'.$lang['science_remarks'].'" autocomplete="off">

<h3>Components - Math</h3>
  <h5>Dispatch Date</h5>
 <input type="text" id="datepicker13m" class="form-control" name="math_sdate" value="'.$lang['math_sdate'].'" autocomplete="off">

  <h5>Setup Date</h5>
<input type="text" id="datepicker14m" class="form-control" name="math_edate" value="'.$lang['math_edate'].'" autocomplete="off">

  <h5>Progress</h5>
<input type="text" id="math_progress" class="form-control" name="math_progress" value="'.$lang['math_progress'].'" autocomplete="off">

  <h5>Units</h5>
  <input type="text" id="math_units" class="form-control" name="math_units" value="'.$lang['math_units'].'" autocomplete="off">


  <h5>WIP</h5>
 <input type="file" id="math_wip" class="form-control" name="math_wip[]" value="'.$lang['math_wip'].'" autocomplete="off" multiple/>

  <h5>After</h5>
 <input type="file" id="math_after" class="form-control" name="math_after[]" value="'.$lang['math_after'].'" autocomplete="off" multiple/>

  <h5>Issues/Changes</h5>
<input type="text" id="math_issues" class="form-control" name="math_issues" value="'.$lang['math_issues'].'" autocomplete="off">

  <h5>Remarks</h5>
<input type="text" id="math_remarks" class="form-control" name="math_remarks" value="'.$lang['math_remarks'].'" autocomplete="off">


<h3>Components - Robotics</h3>
  <h5>Dispatch Date</h5>
 <input type="text" id="datepicker15m" class="form-control" name="robotics_sdate" value="'.$lang['robotics_sdate'].'" autocomplete="off">

  <h5>Setup Date</h5>
<input type="text" id="datepicker16m" class="form-control" name="robotics_edate" value="'.$lang['robotics_edate'].'" autocomplete="off">

  <h5>Progress</h5>
<input type="text" id="robotics_progress" class="form-control" name="robotics_progress" value="'.$lang['robotics_progress'].'" autocomplete="off">

  <h5>Units</h5>
  <th><input type="text" id="robotics_units" class="form-control" name="robotics_units" value="'.$lang['robotics_units'].'" autocomplete="off">


  <h5>WIP</h5>
<input type="file" id="robotics_wip" class="form-control" name="robotics_wip[]" value="'.$lang['robotics_wip'].'" autocomplete="off" multiple/>

  <h5>After</h5>
<input type="file" id="robotics_after" class="form-control" name="robotics_after[]" value="'.$lang['robotics_after'].'" autocomplete="off" multiple/>

  <h5>Issues/Changes</h5>
<input type="text" id="robotics_issues" class="form-control" name="robotics_issues" value="'.$lang['robotics_issues'].'" autocomplete="off">

  <h5>Remarks</h5>
<input type="text" id="robotics_remarks" class="form-control" name="robotics_remarks" value="'.$lang['robotics_remarks'].'" autocomplete="off">


<h3>Components - Computer</h3>
  <h5>Dispatch Date</h5>
 <input type="text" id="datepicker17m" class="form-control" name="computer_sdate" value="'.$lang['computer_sdate'].'" autocomplete="off">

  <h5>Setup Date</h5>
<input type="text" id="datepicker18m" class="form-control" name="computer_edate" value="'.$lang['computer_edate'].'" autocomplete="off">

  <h5>Progress</h5>
<input type="text" id="computer_progress" class="form-control" name="computer_progress" value="'.$lang['computer_progress'].'" autocomplete="off">

  <h5>Units</h5>
  <input type="text" id="computer_units" class="form-control" name="computer_units" value="'.$lang['computer_units'].'" autocomplete="off">

  <h5>WIP</h5>
<input type="file" id="computer_wip" class="form-control" name="computer_wip[]" value="'.$lang['computer_wip'].'" autocomplete="off" multiple>

  <h5>After</h5>
 <input type="file" id="computer_after" class="form-control" name="computer_after[]" value="'.$lang['computer_after'].'" autocomplete="off" multiple>

  <h5>Issues/Changes</h5>
<input type="text" id="computer_issues" class="form-control" name="computer_issues" value="'.$lang['computer_issues'].'" autocomplete="off">

  <h5>Remarks</h5>
<input type="text" id="computer_remarks" class="form-control" name="computer_remarks" value="'.$lang['computer_remarks'].'" autocomplete="off">




<input type="hidden" name="action" value="update" class="form-control">
<input type="hidden" name="science_wip" value="'.$lang['science_wip'].'" class="form-control">
<input type="hidden" name="science_after" value="'.$lang['science_after'].'" class="form-control">
<input type="hidden" name="math_wip" value="'.$lang['math_wip'].'" class="form-control">
<input type="hidden" name="math_after" value="'.$lang['math_after'].'" class="form-control">
<input type="hidden" name="robotics_wip" value="'.$lang['robotics_wip'].'" class="form-control">
<input type="hidden" name="robotics_after" value="'.$lang['robotics_after'].'" class="form-control">
<input type="hidden" name="computer_wip" value="'.$lang['computer_wip'].'" class="form-control">
<input type="hidden" name="computer_after" value="'.$lang['computer_after'].'" class="form-control">
 <input type="hidden" name="schoolid" class="schoolid">
 <input type="hidden" name="projectid" class="projectid">
<button type="button" class="btn btn-success" id="STEM_Lab_Models_datam" style="float: right;">Update</button>
</div>
<div class="col-sm-2"></div>

</form>';

} }else{

$msg .= '<form method="post" action="addstemModelsdata.php" id="add_STEM_Lab_Modelsm" enctype="multipart/form-data">
 <h2>STEM Lab Models</h2>
  <div class="col-sm-2"></div>
  <div class="col-sm-8">
  <h3>Components - Science</h3>
  <h5>Dispatch Date</h5>
 <input type="text" id="datepicker11m"  class="form-control" name="science_sdate" autocomplete="off">

  <h5>Setup Date</h5>
 <input type="text" id="datepicker12m" class="form-control" name="science_edate" autocomplete="off">

  <h5>Progress</h5>
 <input type="text" id="science_progress" class="form-control" name="science_progress" autocomplete="off">

  <h5>Units</h5>
   <input type="text" id="science_units"  class="form-control" name="science_units" autocomplete="off">

  <h5>WIP</h5>
   <input type="file" id="science_wip" class="form-control" name="science_wip[]"  autocomplete="off" multiple/>

  <h5>After</h5>
  <input type="file" id="science_after" class="form-control" name="science_after[]"  autocomplete="off" multiple/>

  <h5>Issues/Changes</h5>
  <input type="text" id="science_issues" class="form-control" name="science_issues" autocomplete="off">

  <h5>Remarks</h5>
<input type="text" id="science_remarks" class="form-control" name="science_remarks" autocomplete="off">

<h3>Components - Math</h3>
  <h5>Dispatch Date</h5>
 <input type="text" id="datepicker13m" class="form-control" name="math_sdate"  autocomplete="off">

  <h5>Setup Date</h5>
<input type="text" id="datepicker14m" class="form-control" name="math_edate"  autocomplete="off">

  <h5>Progress</h5>
<input type="text" id="math_progress" class="form-control" name="math_progress"  autocomplete="off">

  <h5>Units</h5>
  <input type="text" id="math_units" class="form-control" name="math_units"  autocomplete="off">

  <h5>WIP</h5>
 <input type="file" id="math_wip" class="form-control" name="math_wip[]" autocomplete="off" multiple/>

  <h5>After</h5>
 <input type="file" id="math_after" class="form-control" name="math_after[]"  autocomplete="off" multiple/>

  <h5>Issues/Changes</h5>
<input type="text" id="math_issues" class="form-control" name="math_issues"  autocomplete="off">

  <h5>Remarks</h5>
<input type="text" id="math_remarks" class="form-control" name="math_remarks"  autocomplete="off">


<h3>Components - Robotics</h3>
  <h5>Dispatch Date</h5>
 <input type="text" id="datepicker15m" class="form-control" name="robotics_sdate"  autocomplete="off">

  <h5>Setup Date</h5>
<input type="text" id="datepicker16m" class="form-control" name="robotics_edate" autocomplete="off">

  <h5>Progress</h5>
<input type="text" id="robotics_progress" class="form-control" name="robotics_progress"  autocomplete="off">

  <h5>Units</h5>
  <th><input type="text" id="robotics_units" class="form-control" name="robotics_units"  autocomplete="off">

  <h5>WIP</h5>
<input type="file" id="robotics_wip" class="form-control" name="robotics_wip[]"  autocomplete="off" multiple/>

  <h5>After</h5>
<input type="file" id="robotics_after" class="form-control" name="robotics_after[]"  autocomplete="off" multiple/>

  <h5>Issues/Changes</h5>
<input type="text" id="robotics_issues" class="form-control"  name="robotics_issues"  autocomplete="off">

  <h5>Remarks</h5>
<input type="text" id="robotics_remarks" class="form-control" name="robotics_remarks"  autocomplete="off">


<h3>Components - Computer</h3>
  <h5>Dispatch Date</h5>
 <input type="text" id="datepicker17m" class="form-control" name="computer_sdate"  autocomplete="off">

  <h5>Setup Date</h5>
<input type="text" id="datepicker18m" class="form-control" name="computer_edate"  autocomplete="off">

  <h5>Progress</h5>
<input type="text" id="computer_progress" class="form-control" name="computer_progress"  autocomplete="off">

  <h5>Units</h5>
  <input type="text" id="computer_units" class="form-control" name="computer_units"  autocomplete="off">

  <h5>WIP</h5>
<input type="file" id="computer_wip" class="form-control" name="computer_wip[]" autocomplete="off" multiple/>

  <h5>After</h5>
 <input type="file" id="computer_after" class="form-control" name="computer_after[]"  autocomplete="off" multiple/>

  <h5>Issues/Changes</h5>
<input type="text" id="computer_issues" class="form-control" name="computer_issues" autocomplete="off">

  <h5>Remarks</h5>
<input type="text" id="computer_remarks" class="form-control" name="computer_remarks" autocomplete="off">
 <input type="hidden" name="schoolid" class="schoolid">
 <input type="hidden" name="projectid" class="projectid">
 <input type="hidden" name="action" value="add" class="form-control">
<button type="button" class="btn btn-success" id="STEM_Lab_Models_datam" style="float: right;">Save</button>
</div>
<div class="col-sm-2"></div>
</form>';

  }

 $msg .= " </div>";

      $msg .= " <div class='d-none d-sm-block'>";
      $res_stem_models_data = $con -> query('SELECT * from stem_models_data where schoolid="'.$_POST["schoolid"].'" and user_id="'.$_SESSION["exp_dash_id"].'"');

 $rows_stem_models_data = mysqli_num_rows($res_stem_models_data);

 if($rows_stem_models_data>0){
foreach($res_stem_models_data as $lang){

$msg .= '<form method="post" action="addstemModelsdata.php" id="add_STEM_Lab_Models_update" enctype="multipart/form-data">
  
 <table class="table table-bordered" style="margin-left: -10%;">
    <thead>
      <tr>  
<th></th>
<th></th>
<th colspan="3"><span style="text-align: center;"></span></th>
<th></th>
<th colspan="3" style="text-align: center;">Pic/Video</th>
<th></th>
      </tr>
  <tr>

    <th>Modules</th>
    <th>Components</th>
    <th>Dispatch Date</th>
    <th>Setup Date</th>
    <th>Progress</th>
    <th>Units</th>
    <th>WIP</th>
    <th>After</th>
    <th>Issues/Changes</th>
    <th>Remarks</th>
  </tr>
  <tr>
    <th rowspan="5"><p style="margin-bottom: 100%;">STEM Lab Models</p></th>
    <th>Science</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span>
      <input type="text" id="datepicker11"  class="tableres" name="science_sdate" value="'.date('d/m/Y',strtotime($lang['science_sdate'])).'" autocomplete="off">
    </div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker12" class="tableres" name="science_edate" value="'.date('d/m/Y',strtotime($lang['science_edate'])).'" autocomplete="off"></div></th>

    <th><input type="text" id="science_progress" class="tableres" name="science_progress" value="'.$lang['science_progress'].'" autocomplete="off"></th>

     <th><input type="text" id="science_units" class="tableres" name="science_units" value="'.$lang['science_units'].'" autocomplete="off"></th>
     <th><input type="file" id="science_wip" class="tableres" name="science_wip[]" value="'.$lang['science_wip'].'" autocomplete="off" multiple/></th>
     <th><input type="file" id="science_after" class="tableres" name="science_after[]" value="'.$lang['science_after'].'" autocomplete="off" multiple/></th>
    <th><input type="text" id="science_issues" class="tableres" name="science_issues" value="'.$lang['science_issues'].'" autocomplete="off"></th>
    <th><input type="text" id="science_remarks" class="tableres" name="science_remarks" value="'.$lang['science_remarks'].'" autocomplete="off"></th>
  </tr>

  <tr>
    <th>Math</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker13" class="tableres" name="math_sdate" value="'.date('d/m/Y',strtotime($lang['math_sdate'])).'" autocomplete="off"></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker14" class="tableres" name="math_edate" value="'.date('d/m/Y',strtotime($lang['math_edate'])).'" autocomplete="off"></div></th>
    <th><input type="text" id="math_progress" class="tableres" name="math_progress" value="'.$lang['math_progress'].'" autocomplete="off"></th>
     <th><input type="text" id="math_units" class="tableres" name="math_units" value="'.$lang['math_units'].'" autocomplete="off"></th>
     <th><input type="file" id="math_wip" class="tableres" name="math_wip[]" value="'.$lang['math_wip'].'" autocomplete="off" multiple/></th>
     <th><input type="file" id="math_after" class="tableres" name="math_after[]" value="'.$lang['math_after'].'" autocomplete="off" multiple/></th>
    <th><input type="text" id="math_issues" class="tableres" name="math_issues" value="'.$lang['math_issues'].'" autocomplete="off"></th>
    <th><input type="text" id="math_remarks" class="tableres" name="math_remarks" value="'.$lang['math_remarks'].'" autocomplete="off"></th>
  </tr>

  <tr>
    <th>Robotics</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker15" class="tableres" name="robotics_sdate" value="'.date('d/m/Y',strtotime($lang['robotics_sdate'])).'" autocomplete="off"></div></th>

    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker16" class="tableres" name="robotics_edate" value="'.date('d/m/Y',strtotime($lang['robotics_edate'])).'" autocomplete="off"></div></th>
    <th><input type="text" id="robotics_progress" class="tableres" name="robotics_progress" value="'.$lang['robotics_progress'].'" autocomplete="off"></th>
     <th><input type="text" id="robotics_units" class="tableres" name="robotics_units" value="'.$lang['robotics_units'].'" autocomplete="off"></th>
     <th><input type="file" id="robotics_wip" class="tableres" name="robotics_wip[]" value="'.$lang['robotics_wip'].'" autocomplete="off" multiple/></th>
     <th><input type="file" id="robotics_after" class="tableres" name="robotics_after[]" value="'.$lang['robotics_after'].'" autocomplete="off" multiple/></th>
    <th><input type="text" id="robotics_issues" class="tableres" name="robotics_issues" value="'.$lang['robotics_issues'].'" autocomplete="off"></th>
    <th><input type="text" id="robotics_remarks" class="tableres" name="robotics_remarks" value="'.$lang['robotics_remarks'].'" autocomplete="off"></th>
  </tr>

  <tr>
    <th>Computer</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker17" class="tableres" name="computer_sdate" value="'.date('d/m/Y',strtotime($lang['computer_sdate'])).'" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker18" class="tableres" name="computer_edate" value="'.date('d/m/Y',strtotime($lang['computer_edate'])).'" autocomplete="off"></div></th>
    <th><input type="text" id="computer_progress" class="tableres" name="computer_progress" value="'.$lang['computer_progress'].'" autocomplete="off"></th>
     <th><input type="text" id="computer_units" class="tableres" name="computer_units" value="'.$lang['computer_units'].'" autocomplete="off"></th>
     <th><input type="file" id="computer_wip" class="tableres" name="computer_wip[]" value="'.$lang['computer_wip'].'" autocomplete="off" multiple/></th>
     <th><input type="file" id="computer_after" class="tableres" name="computer_after[]" value="'.$lang['computer_after'].'" autocomplete="off" multiple/></th>
    <th><input type="text" id="computer_issues" class="tableres" name="computer_issues" value="'.$lang['computer_issues'].'" autocomplete="off"></th>
    <th><input type="text" id="computer_remarks" class="tableres" name="computer_remarks" value="'.$lang['computer_remarks'].'" autocomplete="off"></th>
  </tr>
</thead>
     
<input type="hidden" name="science_wip" value="'.$lang['science_wip'].'" class="tableres">
<input type="hidden" name="science_after" value="'.$lang['science_after'].'" class="tableres">
<input type="hidden" name="math_wip" value="'.$lang['math_wip'].'" class="tableres">
<input type="hidden" name="math_after" value="'.$lang['math_after'].'" class="tableres">
<input type="hidden" name="robotics_wip" value="'.$lang['robotics_wip'].'" class="tableres">
<input type="hidden" name="robotics_after" value="'.$lang['robotics_after'].'" class="tableres">
<input type="hidden" name="computer_wip" value="'.$lang['computer_wip'].'" class="tableres">
<input type="hidden" name="computer_after" value="'.$lang['computer_after'].'" class="tableres">
    </tbody>
  </table>
  <input type="hidden" name="action" value="update" class="tableres">
      <input type="hidden" name="schoolid" class="schoolid">
      <input type="hidden" name="projectid" class="projectid">
    <button type="button" class="btn btn-success" id="STEM_Lab_Models_data_update" style="float: right;">Update</button>
 </form>';

} }else{

$msg .='<form method="post" action="addstemModelsdata.php" id="add_STEM_Lab_Models" enctype="multipart/form-data">
  
 <table class="table table-bordered" style="margin-left: -10%;">
    <thead>
      <tr>  
<th></th>
<th></th>
<th colspan="3"><span style="text-align: center;"></span></th>
<th></th>
<th colspan="3" style="text-align: center;">Pic/Video</th>
<th></th>
      </tr>
  <tr>

    <th>Modules</th>
    <th>Components</th>
    <th>Dispatch Date</th>
    <th>Setup Date</th>
    <th>Progress</th>
    <th>Units</th>
    <th>WIP</th>
    <th>After</th>
    <th>Issues/Changes</th>
    <th>Remarks</th>
  </tr>
  <tr>
    <th rowspan="5"><p style="margin-bottom: 100%;">STEM Lab Models</p></th>
    <th>Science</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker11"  class="tableres" name="science_sdate" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker12" class="tableres" name="science_edate" autocomplete="off"></div></th>
    <th><input type="text" id="science_progress" class="tableres" name="science_progress" autocomplete="off"></th>
     <th><input type="text" id="science_units" class="tableres" name="science_units" autocomplete="off"></th>
     <th><input type="file" id="science_wip" class="tableres" name="science_wip[]" autocomplete="off" multiple/></th>
     <th><input type="file" id="science_after" class="tableres" name="science_after[]" autocomplete="off" multiple/></th>
    <th><input type="text" id="science_issues" class="tableres" name="science_issues" autocomplete="off"></th>
    <th><input type="text" id="science_remarks" class="tableres" name="science_remarks" autocomplete="off"></th>
  </tr>

  <tr>
    <th>Math</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker13" class="tableres" name="math_sdate" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker14" class="tableres" name="math_edate" autocomplete="off"></div></th>
    <th><input type="text" id="math_progress" class="tableres" name="math_progress" autocomplete="off"></th>
     <th><input type="text" id="math_units" class="tableres" name="math_units" autocomplete="off"></th>
     <th><input type="file" id="math_wip" class="tableres" name="math_wip[]" autocomplete="off" multiple/></th>
     <th><input type="file" id="math_after" class="tableres" name="math_after[]" autocomplete="off" multiple/></th>
    <th><input type="text" id="math_issues" class="tableres" name="math_issues" autocomplete="off"></th>
    <th><input type="text" id="math_remarks" class="tableres" name="math_remarks" autocomplete="off"></th>
  </tr>

  <tr>
    <th>Robotics</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker15" class="tableres" name="robotics_sdate" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker16" class="tableres" name="robotics_edate" autocomplete="off"></div></th>
    <th><input type="text" id="robotics_progress" class="tableres" name="robotics_progress" autocomplete="off"></th>
     <th><input type="text" id="robotics_units" class="tableres" name="robotics_units" autocomplete="off"></th>
     <th><input type="file" id="robotics_wip" class="tableres" name="robotics_wip[]" autocomplete="off" multiple/></th>
     <th><input type="file" id="robotics_after" class="tableres" name="robotics_after[]" autocomplete="off" multiple/></th>
    <th><input type="text" id="robotics_issues" class="tableres" name="robotics_issues" autocomplete="off"></th>
    <th><input type="text" id="robotics_remarks" class="tableres" name="robotics_remarks" autocomplete="off"></th>
  </tr>

  <tr>
    <th>Computer</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker17" class="tableres" name="computer_sdate" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker18" class="tableres" name="computer_edate" autocomplete="off"></div></th>
    <th><input type="text" id="computer_progress" class="tableres" name="computer_progress" autocomplete="off"></th>
     <th><input type="text" id="computer_units" class="tableres" name="computer_units" autocomplete="off"></th>
     <th><input type="file" id="computer_wip" class="tableres" name="computer_wip[]" autocomplete="off" multiple/></th>
     <th><input type="file" id="computer_after" class="tableres" name="computer_after[]" autocomplete="off" multiple/></th>
    <th><input type="text" id="computer_issues" class="tableres" name="computer_issues" autocomplete="off"></th>
    <th><input type="text" id="computer_remarks" class="tableres" name="computer_remarks" autocomplete="off"></th>
  </tr>
</thead>
     <input type="hidden" name="action" value="add" class="tableres">
      <input type="hidden" name="schoolid" class="schoolid">
      <input type="hidden" name="projectid" class="projectid">
  <input type="hidden" name="table" value="stem_lab_infra_data" class="tableres">
    </tbody>
  </table>
    <button type="button" class="btn btn-success" id="STEM_Lab_Models_data" style="float: right;">Save</button>
   
 </form>';

}
$msg .='</div>
  <style>
 span#basic-addon1 {
    padding: 4px 2px 4px 4px;
}
    </style>
<script>
 $(document).ready(function(){
    $("#STEM_Lab_Models_data").click(function(){    
        $("#add_STEM_Lab_Models").submit(); 
    });

     $("#STEM_Lab_Models_datam").click(function(){     
        $("#add_STEM_Lab_Modelsm").submit(); 
    });

  $("#STEM_Lab_Models_data_update").click(function(){    
        $("#add_STEM_Lab_Models_update").submit(); 
    });
$(".schoolid").val($("#school_drop").val());
$(".projectid").val($("#project_drop").val());
    

});
</script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker2" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker3" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker4" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker5" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker6" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker7" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker8" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker9" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker10" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker11" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker12" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker13" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker14" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker15" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker16" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker17" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker18" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker19" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker20" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker21" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker22" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker23" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker24" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker25" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker26" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker27" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker28" ).datepicker({ dateFormat: "dd/mm/yy" });

    $( "#datepickerm" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker2m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker3m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker4m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker5m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker6m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker7m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker8m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker9m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker10m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker11m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker12m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker13m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker14m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker15m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker16m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker17m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker18m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker19m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker20m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker21m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker22m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker23m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker24m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker25m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker26m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker27m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker28m" ).datepicker({ dateFormat: "dd/mm/yy" });
  } );
  </script>
  ';
echo $msg;




     }elseif($_POST['moduleid']=='121'){ //STEM Lab Posters

      $msg .= "<div class='d-md-none'>";
      $res_stempostersdata = $con -> query('SELECT * from stempostersdata where schoolid="'.$_POST["schoolid"].'" and user_id="'.$_SESSION["exp_dash_id"].'"');
      
 $rows_stempostersdata = mysqli_num_rows($res_stempostersdata);

 if($rows_stempostersdata>0){
foreach($res_stempostersdata as $lang){
  $msg .= '<form method="post" action="addstempostersdata.php" id="add_STEM_Lab_Postersm" enctype="multipart/form-data">
  <h2>STEM Lab Posters</h2>
  <div class="col-sm-2"></div>
  <div class="col-sm-8">
  <h3>Components - Branding Wall</h3>
  <h5>Start date</h5>
 <input type="text" id="datepickerm"  class="form-control" name="bWall_sdate" value="'.$lang['bWall_sdate'].'" autocomplete="off">

  <h5>Setup Date</h5>
 <input type="text" id="datepicker2m" class="form-control" name="bWall_edate" value="'.$lang['bWall_edate'].'" autocomplete="off">

  <h5>Progress</h5>
 <input type="text" id="bWall_progress" class="form-control" name="bWall_progress" value="'.$lang['bWall_progress'].'" autocomplete="off">

  <h5>Units</h5>
   <input type="text" id="bWall_units" class="form-control" name="bWall_units" value="'.$lang['bWall_units'].'" autocomplete="off">

  <h5>WIP</h5>
   <input type="file" id="bWall_wip" class="form-control" name="bWall_wip[]" value="'.$lang['bWall_wip'].'" autocomplete="off" multiple/>

  <h5>After</h5>
  <input type="file" id="bWall_after" class="form-control" name="bWall_after[]" value="'.$lang['bWall_after'].'" autocomplete="off" multiple/>

  <h5>Issues/Changes</h5>
  <input type="text" id="bWall_issues" class="form-control" name="bWall_issues" value="'.$lang['bWall_issues'].'" autocomplete="off">

  <h5>Remarks</h5>
<input type="text" id="bWall_remarks" class="form-control" name="bWall_remarks" value="'.$lang['bWall_remarks'].'" autocomplete="off">

<h3>Components - Concepts</h3>
  <h5>Start date</h5>
 <input type="text" id="datepicker3m" class="form-control" name="concepts_sdate" value="'.$lang['concepts_sdate'].'" autocomplete="off">

  <h5>Setup Date</h5>
<input type="text" id="datepicker4m" class="form-control" name="concepts_edate" value="'.$lang['concepts_edate'].'" autocomplete="off">

  <h5>Progress</h5>
<input type="text" id="concepts_progress" class="form-control" name="concepts_progress" value="'.$lang['concepts_progress'].'" autocomplete="off">

  <h5>Units</h5>
  <input type="text" id="concepts_units" class="form-control" name="concepts_units" value="'.$lang['concepts_units'].'" autocomplete="off">

  <h5>WIP</h5>
 <input type="file" id="concepts_wip" class="form-control" name="concepts_wip[]" value="'.$lang['concepts_wip'].'" autocomplete="off" multiple/>

  <h5>After</h5>
 <input type="file" id="concepts_after" class="form-control" name="concepts_after[]" value="'.$lang['concepts_after'].'" autocomplete="off" multiple/>

  <h5>Issues/Changes</h5>
<input type="text" id="concepts_issues" class="form-control" name="concepts_issues" value="'.$lang['concepts_issues'].'" autocomplete="off">

  <h5>Remarks</h5>
<input type="text" id="concepts_remarks" class="form-control" name="concepts_remarks" value="'.$lang['concepts_remarks'].'" autocomplete="off">


<h3>Components - Solar System</h3>
  <h5>Start date</h5>
 <input type="text" id="datepicker5m" class="form-control" name="sSystem_sdate" value="'.$lang['sSystem_sdate'].'" autocomplete="off">

  <h5>Setup Date</h5>
<input type="text" id="datepicker6m" class="form-control" name="sSystem_edate" value="'.$lang['sSystem_edate'].'" autocomplete="off">

  <h5>Progress</h5>
<input type="text" id="sSystem_progress" class="form-control" name="sSystem_progress" value="'.$lang['sSystem_progress'].'" autocomplete="off">

  <h5>Units</h5>
  <th><input type="text" id="sSystem_units" class="form-control" name="sSystem_units" value="'.$lang['sSystem_units'].'" autocomplete="off">

  <h5>WIP</h5>
<input type="file" id="sSystem_wip" class="form-control" name="sSystem_wip[]" value="'.$lang['sSystem_wip'].'" autocomplete="off" multiple/>

  <h5>After</h5>
<input type="file" id="sSystem_after" class="form-control" name="sSystem_after[]" value="'.$lang['sSystem_after'].'" autocomplete="off" multiple/>

  <h5>Issues/Changes</h5>
<input type="text" id="sSystem_issues" class="form-control" name="sSystem_issues" value="'.$lang['sSystem_issues'].'" autocomplete="off">

  <h5>Remarks</h5>
<input type="text" id="sSystem_remarks" class="form-control" name="sSystem_remarks" value="'.$lang['sSystem_remarks'].'" autocomplete="off">


<h3>Components - Innovation Corner</h3>
  <h5>Start date</h5>
 <input type="text" id="datepicker7m" class="form-control" name="inCorner_sdate" value="'.$lang['inCorner_sdate'].'" autocomplete="off">

  <h5>Setup Date</h5>
<input type="text" id="datepicker8m" class="form-control" name="inCorner_units" value="'.$lang['inCorner_units'].'" autocomplete="off">

  <h5>Progress</h5>
<input type="text" id="inCorner_progress" class="form-control" name="inCorner_progress" value="'.$lang['inCorner_progress'].'" autocomplete="off">

  <h5>Units</h5>
  <input type="text" id="inCorner_units" class="form-control" name="inCorner_units" value="'.$lang['inCorner_units'].'" autocomplete="off">

  <h5>WIP</h5>
<input type="file" id="inCorner_wip" class="form-control" name="inCorner_wip[]" value="'.$lang['inCorner_wip'].'" autocomplete="off" multiple/>

  <h5>After</h5>
 <input type="file" id="inCorner_after" class="form-control" name="inCorner_after[]" value="'.$lang['inCorner_after'].'" autocomplete="off" multiple/>

  <h5>Issues/Changes</h5>
<input type="text" id="inCorner_issues" class="form-control" name="inCorner_issues" value="'.$lang['inCorner_issues'].'" autocomplete="off">

  <h5>Remarks</h5>
<input type="text" id="inCorner_remarks" class="form-control" name="inCorner_remarks" value="'.$lang['inCorner_remarks'].'" autocomplete="off">


<h3>Components - Cutouts</h3>
  <h5>Start date</h5>
 <input type="text" id="datepicker9m" class="form-control" name="cutouts_sdate" value="'.$lang['cutouts_sdate'].'" autocomplete="off">

  <h5>Setup Date</h5>
<input type="text" id="datepicker10m" class="form-control" name="cutouts_edate" value="'.$lang['cutouts_edate'].'" autocomplete="off">

  <h5>Progress</h5>
<input type="text" id="cutouts_progress" class="form-control" name="cutouts_progress" value="'.$lang['cutouts_progress'].'" autocomplete="off">

  <h5>Units</h5>
  <input type="text" id="cutouts_units" class="form-control" name="cutouts_units" value="'.$lang['cutouts_units'].'" autocomplete="off">

  <h5>WIP</h5>
<input type="file" id="cutouts_wip" class="form-control" name="cutouts_wip[]" value="'.$lang['cutouts_wip'].'" autocomplete="off" multiple/>

  <h5>After</h5>
 <input type="file" id="cutouts_after" class="form-control" name="cutouts_after[]" value="'.$lang['cutouts_after'].'" autocomplete="off" multiple/>

  <h5>Issues/Changes</h5>
<input type="text" id="cutouts_issues" class="form-control" name="cutouts_issues" value="'.$lang['cutouts_issues'].'" autocomplete="off">

  <h5>Remarks</h5>
<input type="text" id="cutouts_remarks" class="form-control" name="cutouts_remarks" value="'.$lang['cutouts_remarks'].'" autocomplete="off">



 <input type="hidden" name="schoolid" class="schoolid">
 <input type="hidden" name="projectid" class="projectid">
<input type="hidden" name="bWall_wip" value="'.$lang['bWall_wip'].'" class="tableres">
<input type="hidden" name="bWall_after" value="'.$lang['bWall_after'].'" class="tableres">

<input type="hidden" name="concepts_wip" value="'.$lang['concepts_wip'].'" class="tableres">
<input type="hidden" name="concepts_after" value="'.$lang['concepts_after'].'" class="tableres">
<input type="hidden" name="sSystem_wip" value="'.$lang['sSystem_wip'].'" class="tableres">
<input type="hidden" name="sSystem_after" value="'.$lang['sSystem_after'].'" class="tableres">
<input type="hidden" name="inCorner_wip" value="'.$lang['inCorner_wip'].'" class="tableres">
<input type="hidden" name="inCorner_after" value="'.$lang['inCorner_after'].'" class="tableres">
<input type="hidden" name="cutouts_wip" value="'.$lang['cutouts_wip'].'" class="tableres">
<input type="hidden" name="cutouts_after" value="'.$lang['cutouts_after'].'" class="tableres">
     <input type="hidden" name="action" value="update" class="tableres">
  <input type="hidden" name="table" value="stem_lab_infra_data" class="tableres">
<button type="button" class="btn btn-success" id="STEM_Lab_Posters_datam" style="float: right;">Update</button>
</div>
<div class="col-sm-2"></div>

</form>';

  } }else{
$msg .= '<form method="post" action="addstempostersdata.php" id="add_STEM_Lab_Postersm" enctype="multipart/form-data">
  <h2>STEM Lab Posters</h2>
  <div class="col-sm-2"></div>
  <div class="col-sm-8">
  <h3>Components - Branding Wall</h3>

  <h5>Start date</h5>
 <input type="text" id="datepickerm"  class="form-control" name="bWall_sdate"  autocomplete="off">

  <h5>End date</h5>
 <input type="text" id="datepicker2m" class="form-control" name="bWall_edate" autocomplete="off">

  <h5>Progress</h5>
 <input type="text" id="bWall_progress" class="form-control" name="bWall_progress" autocomplete="off">

  <h5>Units</h5>
   <input type="text" id="bWall_units" class="form-control" name="bWall_units" autocomplete="off">

  <h5>WIP</h5>
   <input type="file" id="bWall_wip" class="form-control" name="bWall_wip[]"  autocomplete="off" multiple/>

  <h5>After</h5>
  <input type="file" id="bWall_after" class="form-control" name="bWall_after[]"  autocomplete="off" multiple/>

  <h5>Issues/Changes</h5>
  <input type="text" id="bWall_issues" class="form-control" name="bWall_issues"  autocomplete="off">

  <h5>Remarks</h5>
<input type="text" id="bWall_remarks" class="form-control" name="bWall_remarks"  autocomplete="off">

<h3>Components - Concepts</h3>
  <h5>Start date</h5>
 <input type="text" id="datepicker3m" class="form-control" name="concepts_sdate"  autocomplete="off">

  <h5>End date</h5>
<input type="text" id="datepicker4m" class="form-control" name="concepts_edate"  autocomplete="off">

  <h5>Progress</h5>
<input type="text" id="concepts_progress" class="form-control" name="concepts_progress"  autocomplete="off">

  <h5>Units</h5>
  <input type="text" id="concepts_units" class="form-control" name="concepts_units"  autocomplete="off">

  <h5>WIP</h5>
 <input type="file" id="concepts_wip" class="form-control" name="concepts_wip[]"  autocomplete="off" multiple/>

  <h5>After</h5>
 <input type="file" id="concepts_after" class="form-control" name="concepts_after[]"  autocomplete="off" multiple/>

  <h5>Issues/Changes</h5>
<input type="text" id="concepts_issues" class="form-control" name="concepts_issues"  autocomplete="off">

  <h5>Remarks</h5>
<input type="text" id="concepts_remarks" class="form-control" name="concepts_remarks"  autocomplete="off">


<h3>Components - Solar System</h3>
  <h5>Delivery date</h5>
 <input type="text" id="datepicker5m" class="form-control" name="sSystem_sdate"  autocomplete="off">

  <h5>Setup Date</h5>
<input type="text" id="datepicker6m" class="form-control" name="sSystem_edate" autocomplete="off">

  <h5>Progress</h5>
<input type="text" id="sSystem_progress" class="form-control" name="sSystem_progress" autocomplete="off">

  <h5>Units</h5>
  <th><input type="text" id="sSystem_units" class="form-control" name="sSystem_units"  autocomplete="off">

  <h5>WIP</h5>
<input type="file" id="sSystem_wip" class="form-control" name="sSystem_wip[]" autocomplete="off" multiple/>

  <h5>After</h5>
<input type="file" id="sSystem_after" class="form-control" name="sSystem_after[]"  autocomplete="off" multiple/>

  <h5>Issues/Changes</h5>
<input type="text" id="sSystem_issues" class="form-control" name="sSystem_issues" autocomplete="off">

  <h5>Remarks</h5>
<input type="text" id="sSystem_remarks" class="form-control" name="sSystem_remarks"  autocomplete="off">


<h3>Components - Innovation Corner</h3>
  <h5>Start date</h5>
 <input type="text" id="datepicker7m" class="form-control" name="inCorner_sdate" autocomplete="off">

  <h5>End Date</h5>
<input type="text" id="datepicker8m" class="form-control" name="inCorner_units" autocomplete="off">

  <h5>Progress</h5>
<input type="text" id="inCorner_progress" class="form-control" name="inCorner_progress" autocomplete="off">

  <h5>Units</h5>
  <input type="text" id="inCorner_units" class="form-control" name="inCorner_units"  autocomplete="off">

  <h5>WIP</h5>
<input type="file" id="inCorner_wip" class="form-control" name="inCorner_wip[]"  autocomplete="off" multiple/>

  <h5>After</h5>
 <input type="file" id="inCorner_after" class="form-control" name="inCorner_after[]" autocomplete="off" multiple/>

  <h5>Issues/Changes</h5>
<input type="text" id="inCorner_issues" class="form-control" name="inCorner_issues" autocomplete="off">

  <h5>Remarks</h5>
<input type="text" id="inCorner_remarks" class="form-control" name="inCorner_remarks"  autocomplete="off">


<h3>Components - Cutouts</h3>
  <h5>Start date</h5>
 <input type="text" id="datepicker9m" class="form-control" name="cutouts_sdate"  autocomplete="off">

  <h5>End Date</h5>
<input type="text" id="datepicker10m" class="form-control" name="cutouts_edate"  autocomplete="off">

  <h5>Progress</h5>
<input type="text" id="cutouts_progress" class="form-control" name="cutouts_progress" autocomplete="off">

  <h5>Units</h5>
  <input type="text" id="cutouts_units" class="form-control" name="cutouts_units"  autocomplete="off">

  <h5>WIP</h5>
<input type="file" id="cutouts_wip" class="form-control" name="cutouts_wip[]" autocomplete="off" multiple/>

  <h5>After</h5>
 <input type="file" id="cutouts_after" class="form-control" name="cutouts_after[]" autocomplete="off" multiple/>

  <h5>Issues/Changes</h5>
<input type="text" id="cutouts_issues" class="form-control" name="cutouts_issues" autocomplete="off">

  <h5>Remarks</h5>
<input type="text" id="cutouts_remarks" class="form-control" name="cutouts_remarks" autocomplete="off">

 <input type="hidden" name="schoolid" class="schoolid">
 <input type="hidden" name="projectid" class="projectid">
     <input type="hidden" name="action" value="add" class="tableres">
  <input type="hidden" name="table" value="stem_lab_infra_data" class="tableres">
</div>
<div class="col-sm-2"></div>
<button type="button" class="btn btn-success" id="STEM_Lab_Posters_datam" style="float: right;">Save</button>
</form>';

  }

$msg .= '</div>';



      $msg .= " <div class='d-none d-sm-block'>";
      $res_stempostersdata = $con -> query('SELECT * from stempostersdata where schoolid="'.$_POST["schoolid"].'" and user_id="'.$_SESSION["exp_dash_id"].'"');
 $rows_stempostersdata = mysqli_num_rows($res_stempostersdata);

 if($rows_stempostersdata>0){
foreach($res_stempostersdata as $lang){

$msg .= '<form method="post" action="addstempostersdata.php" id="add_STEM_Lab_Posters_update" enctype="multipart/form-data">
  
 <table class="table table-bordered" style="margin-left: -10%;">
    <thead>
      <tr>  
<th></th>
<th></th>
<th colspan="3"><span style="text-align: center;"></span></th>
<th></th>
<th colspan="3" style="text-align: center;">Pic/Video</th>
<th></th>
      </tr>
  <tr>

    <th>Modules</th>
    <th>Components</th>
    <th>Delivery date</th>
    <th>Setup Date</th>
    <th>Progress</th>
    <th>Units</th>
    <th>WIP</th>
    <th>After</th>
    <th>Issues/Changes</th>
    <th>Remarks</th>
  </tr>
  <tr>

    <th rowspan="5"><p style="margin-bottom: 100%;">STEM Lab Posters</p></th>
    <th>Branding Wall</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span> <input type="text" id="datepicker"  class="tableres" name="bWall_sdate" value="'.date('d/m/Y',strtotime($lang['bWall_sdate'])).'" autocomplete="off"></div> </th>

    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker2" class="tableres" name="bWall_edate" value="'.date('d/m/Y',strtotime($lang['bWall_edate'])).'" autocomplete="off"></div></th>
    <th><input type="text" id="bWall_progress" class="tableres" name="bWall_progress" value="'.$lang['bWall_progress'].'" autocomplete="off"></th>
     <th><input type="text" id="bWall_units" class="tableres" name="bWall_units" value="'.$lang['bWall_units'].'" autocomplete="off"></th>
     <th><input type="file" id="bWall_wip" class="tableres" name="bWall_wip[]" value="'.$lang['science_sdate'].'" autocomplete="off" multiple/></th>
     <th><input type="file" id="bWall_after" class="tableres" name="bWall_after[]" value="'.$lang['bWall_after'].'" autocomplete="off" multiple/></th>
    <th><input type="text" id="bWall_issues" class="tableres" name="bWall_issues" value="'.$lang['bWall_issues'].'" autocomplete="off"></th>
    <th><input type="text" id="bWall_remarks" class="tableres" name="bWall_remarks" value="'.$lang['bWall_remarks'].'" autocomplete="off"></th>
  </tr>

  <tr>
    <th>Concepts</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg></span><input type="text" id="datepicker3" class="tableres" name="concepts_sdate" value="'.date('d/m/Y',strtotime($lang['concepts_sdate'])).'" autocomplete="off"></div></th>

     <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker4" class="tableres" name="concepts_edate" value="'.date('d/m/Y',strtotime($lang['concepts_edate'])).'" autocomplete="off"></div></th>
    <th><input type="text" id="concepts_progress" class="tableres" name="concepts_progress" value="'.$lang['concepts_progress'].'" autocomplete="off"></th>

     <th><input type="text" id="concepts_units" class="tableres" name="concepts_units" value="'.$lang['concepts_units'].'" autocomplete="off"></th>
     <th><input type="file" id="concepts_wip" class="tableres" name="concepts_wip[]" value="'.$lang['concepts_wip'].'" autocomplete="off" multiple/></th>
     <th><input type="file" id="concepts_after" class="tableres" name="concepts_after[]" value="'.$lang['concepts_after'].'" autocomplete="off" multiple/></th>
    <th><input type="text" id="concepts_issues" class="tableres" name="concepts_issues" value="'.$lang['concepts_issues'].'" autocomplete="off"></th>
    <th><input type="text" id="concepts_remarks" class="tableres" name="concepts_remarks" value="'.$lang['concepts_remarks'].'" autocomplete="off"></th>
  </tr>

  <tr>
    <th>Solar System</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg></span><input type="text" id="datepicker5" class="tableres" name="sSystem_sdate" value="'.date('d/m/Y',strtotime($lang['sSystem_sdate'])).'" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg></span><input type="text" id="datepicker6" class="tableres" name="sSystem_edate" value="'.date('d/m/Y',strtotime($lang['sSystem_edate'])).'" autocomplete="off"></div></th>
    <th><input type="text" id="sSystem_progress" class="tableres" name="sSystem_progress" value="'.$lang['sSystem_progress'].'" autocomplete="off"></th>
     <th><input type="text" id="sSystem_units" class="tableres" name="sSystem_units" value="'.$lang['sSystem_units'].'" autocomplete="off"></th>
     <th><input type="file" id="sSystem_wip" class="tableres" name="sSystem_wip[]" value="'.$lang['sSystem_wip'].'" autocomplete="off" multiple/></th>
     <th><input type="file" id="sSystem_after" class="tableres" name="sSystem_after[]" value="'.$lang['sSystem_after'].'" autocomplete="off" multiple/></th>
    <th><input type="text" id="sSystem_issues" class="tableres" name="sSystem_issues" value="'.$lang['sSystem_issues'].'" autocomplete="off"></th>
    <th><input type="text" id="sSystem_remarks" class="tableres" name="sSystem_remarks" value="'.$lang['sSystem_remarks'].'" autocomplete="off"></th>
  </tr>

  <tr>
    <th>Innovation Corner</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker7" class="tableres" name="inCorner_sdate" value="'.date('d/m/Y',strtotime($lang['inCorner_sdate'])).'" autocomplete="off"></div></th>

    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg></span><input type="text" id="datepicker8" class="tableres" name="inCorner_edate" value="'.date('d/m/Y',strtotime($lang['inCorner_edate'])).'" autocomplete="off"></div></th>

    <th><input type="text" id="inCorner_progress" class="tableres" name="inCorner_progress" value="'.$lang['inCorner_progress'].'" autocomplete="off"></th>
     <th><input type="text" id="inCorner_units" class="tableres" name="inCorner_units" value="'.$lang['inCorner_units'].'" autocomplete="off"></th>
     <th><input type="file" id="inCorner_wip" class="tableres" name="inCorner_wip[]" value="'.$lang['inCorner_wip'].'" autocomplete="off" multiple/></th>
     <th><input type="file" id="inCorner_after" class="tableres" name="inCorner_after[]" value="'.$lang['inCorner_after'].'" autocomplete="off" multiple/></th>
    <th><input type="text" id="inCorner_issues" class="tableres" name="inCorner_issues" value="'.$lang['inCorner_issues'].'" autocomplete="off"></th>
    <th><input type="text" id="inCorner_remarks" class="tableres" name="inCorner_remarks" value="'.$lang['inCorner_remarks'].'" autocomplete="off"></th>
  </tr>

  <tr>
    <th>Cutouts</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker9" class="tableres" name="cutouts_sdate" value="'.date('d/m/Y',strtotime($lang['cutouts_sdate'])).'" autocomplete="off"></div></th>

    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker10" class="tableres" name="cutouts_edate" value="'.date('d/m/Y',strtotime($lang['cutouts_edate'])).'" autocomplete="off"></div></th>

    <th><input type="text" id="cutouts_progress" class="tableres" name="cutouts_progress" value="'.$lang['cutouts_progress'].'" autocomplete="off"></th>
     <th><input type="text" id="cutouts_units" class="tableres" name="cutouts_units" value="'.$lang['cutouts_units'].'" autocomplete="off"></th>
     <th><input type="file" id="cutouts_wip" class="tableres" name="cutouts_wip[]" value="'.$lang['cutouts_wip'].'" autocomplete="off" multiple/></th>
     <th><input type="file" id="cutouts_after" class="tableres" name="cutouts_after[]" value="'.$lang['cutouts_after'].'" autocomplete="off" multiple/></th>
    <th><input type="text" id="cutouts_issues" class="tableres" name="cutouts_issues" value="'.$lang['cutouts_issues'].'" autocomplete="off"></th>
    <th><input type="text" id="cutouts_remarks" class="tableres" name="cutouts_remarks" value="'.$lang['cutouts_remarks'].'" autocomplete="off"></th>
  </tr>

</thead>
<input type="hidden" name="bWall_wip" value="'.$lang['bWall_wip'].'" class="tableres">
<input type="hidden" name="bWall_after" value="'.$lang['bWall_after'].'" class="tableres">

<input type="hidden" name="concepts_wip" value="'.$lang['concepts_wip'].'" class="tableres">
<input type="hidden" name="concepts_after" value="'.$lang['concepts_after'].'" class="tableres">
<input type="hidden" name="sSystem_wip" value="'.$lang['sSystem_wip'].'" class="tableres">
<input type="hidden" name="sSystem_after" value="'.$lang['sSystem_after'].'" class="tableres">
<input type="hidden" name="inCorner_wip" value="'.$lang['inCorner_wip'].'" class="tableres">
<input type="hidden" name="inCorner_after" value="'.$lang['inCorner_after'].'" class="tableres">
<input type="hidden" name="cutouts_wip" value="'.$lang['cutouts_wip'].'" class="tableres">
<input type="hidden" name="cutouts_after" value="'.$lang['cutouts_after'].'" class="tableres">
     <input type="hidden" name="action" value="update" class="tableres">
      <input type="hidden" name="schoolid" class="schoolid">
      <input type="hidden" name="projectid" class="projectid">
  <input type="hidden" name="table" value="stem_lab_infra_data" class="tableres">
    </tbody>
  </table>
    <button type="button" class="btn btn-success" id="STEM_Lab_Posters_data_update" style="float: right;">Update</button>
</form>';



  } }else{

$msg .=' <form method="post" action="addstempostersdata.php" id="add_STEM_Lab_Posters" enctype="multipart/form-data">
  
 <table class="table table-bordered" style="margin-left: -10%;">
    <thead>
      <tr>  
<th></th>
<th></th>
<th colspan="3"><span style="text-align: center;"></span></th>
<th></th>
<th colspan="3" style="text-align: center;">Pic/Video</th>
<th></th>
      </tr>
  <tr>

    <th>Modules</th>
    <th>Components</th>
    <th>Delivery date</th>
    <th>Setup Date</th>
    <th>Progress</th>
    <th>Units</th>
    <th>WIP</th>
    <th>After</th>
    <th>Issues/Changes</th>
    <th>Remarks</th>
  </tr>
  <tr>
    <th rowspan="5"><p style="margin-bottom: 100%;">STEM Lab Posters</p></th>
    <th>Branding Wall</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker"  class="tableres" name="bWall_sdate" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker2" class="tableres" name="bWall_edate" autocomplete="off"></div></th>
    <th><input type="text" id="bWall_progress" class="tableres" name="bWall_progress" autocomplete="off"></th>
     <th><input type="text" id="bWall_units" class="tableres" name="bWall_units" autocomplete="off"></th>
     <th><input type="file" id="bWall_wip" class="tableres" name="bWall_wip[]" autocomplete="off" multiple/></th>
     <th><input type="file" id="bWall_after" class="tableres" name="bWall_after[]" autocomplete="off" multiple/></th>
    <th><input type="text" id="bWall_issues" class="tableres" name="bWall_issues" autocomplete="off"></th>
    <th><input type="text" id="bWall_remarks" class="tableres" name="bWall_remarks" autocomplete="off"></th>
  </tr>

  <tr>
    <th>Concepts</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker3" class="tableres" name="concepts_sdate" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker4" class="tableres" name="concepts_edate" autocomplete="off"></div></th>
    <th><input type="text" id="concepts_progress" class="tableres" name="concepts_progress" autocomplete="off"></th>
     <th><input type="text" id="concepts_units" class="tableres" name="concepts_units" autocomplete="off"></th>
     <th><input type="file" id="concepts_wip" class="tableres" name="concepts_wip[]" autocomplete="off" multiple/></th>
     <th><input type="file" id="concepts_after" class="tableres" name="concepts_after[]" autocomplete="off" multiple/></th>
    <th><input type="text" id="concepts_issues" class="tableres" name="concepts_issues" autocomplete="off"></th>
    <th><input type="text" id="concepts_remarks" class="tableres" name="concepts_remarks" autocomplete="off"></th>
  </tr>

  <tr>
    <th>Solar System</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker5" class="tableres" name="sSystem_sdate" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker6" class="tableres" name="sSystem_edate" autocomplete="off"></div></th>
    <th><input type="text" id="sSystem_progress" class="tableres" name="sSystem_progress" autocomplete="off"></th>
     <th><input type="text" id="sSystem_units" class="tableres" name="sSystem_units" autocomplete="off"></th>
     <th><input type="file" id="sSystem_wip" class="tableres" name="sSystem_wip[]" autocomplete="off" multiple/></th>
     <th><input type="file" id="sSystem_after" class="tableres" name="sSystem_after[]" autocomplete="off" multiple/></th>
    <th><input type="text" id="sSystem_issues" class="tableres" name="sSystem_issues" autocomplete="off"></th>
    <th><input type="text" id="sSystem_remarks" class="tableres" name="sSystem_remarks" autocomplete="off"></th>
  </tr>

  <tr>
    <th>Innovation Corner</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker7" class="tableres" name="inCorner_sdate" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker8" class="tableres" name="inCorner_edate" autocomplete="off"></div></th>
    <th><input type="text" id="inCorner_progress" class="tableres" name="inCorner_progress" autocomplete="off"></th>
     <th><input type="text" id="inCorner_units" class="tableres" name="inCorner_units" autocomplete="off"></th>
     <th><input type="file" id="inCorner_wip" class="tableres" name="inCorner_wip[]" autocomplete="off" multiple/></th>
     <th><input type="file" id="inCorner_after" class="tableres" name="inCorner_after[]" autocomplete="off" multiple/></th>
    <th><input type="text" id="inCorner_issues" class="tableres" name="inCorner_issues" autocomplete="off"></th>
    <th><input type="text" id="inCorner_remarks" class="tableres" name="inCorner_remarks" autocomplete="off"></th>
  </tr>

  <tr>
    <th>Cutouts</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker9" class="tableres" name="cutouts_sdate" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker10" class="tableres" name="cutouts_edate" autocomplete="off"></div></th>
    <th><input type="text" id="cutouts_progress" class="tableres" name="cutouts_progress" autocomplete="off"></th>
     <th><input type="text" id="cutouts_units" class="tableres" name="cutouts_units" autocomplete="off"></th>
     <th><input type="file" id="cutouts_wip" class="tableres" name="cutouts_wip[]" autocomplete="off" multiple/></th>
     <th><input type="file" id="cutouts_after" class="tableres" name="cutouts_after[]" autocomplete="off" multiple/></th>
    <th><input type="text" id="cutouts_issues" class="tableres" name="cutouts_issues" autocomplete="off"></th>
    <th><input type="text" id="cutouts_remarks" class="tableres" name="cutouts_remarks" autocomplete="off"></th>
  </tr>

</thead>
     <input type="hidden" name="action" value="add" class="tableres">
      <input type="hidden" name="schoolid" class="schoolid">
      <input type="hidden" name="projectid" class="projectid">
  <input type="hidden" name="table" value="stem_lab_infra_data" class="tableres">
    </tbody>
  </table>
    <button type="button" class="btn btn-success" id="STEM_Lab_Posters_data" style="float: right;">Save</button>
 
</form>';

  }

  $msg .='</div>
  <style>
 span#basic-addon1 {
    padding: 4px 2px 4px 4px;
}
    </style>
<script>
 $(document).ready(function(){
    $("#STEM_Lab_Posters_data").click(function(){        
        $("#add_STEM_Lab_Posters").submit(); // Submit the form
    });

    $("#STEM_Lab_Posters_datam").click(function(){        
        $("#add_STEM_Lab_Postersm").submit(); // Submit the form
    });

  $("#STEM_Lab_Posters_data_update").click(function(){    
        $("#add_STEM_Lab_Posters_update").submit(); 
    });
$(".schoolid").val($("#school_drop").val());
$(".projectid").val($("#project_drop").val());
    

});
</script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker2" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker3" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker4" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker5" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker6" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker7" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker8" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker9" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker10" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker11" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker12" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker13" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker14" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker15" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker16" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker17" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker18" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker19" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker20" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker21" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker22" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker23" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker24" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker25" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker26" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker27" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker28" ).datepicker({ dateFormat: "dd/mm/yy" });

    $( "#datepickerm" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker2m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker3m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker4m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker5m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker6m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker7m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker8m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker9m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker10m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker11m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker12m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker13m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker14m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker15m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker16m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker17m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker18m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker19m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker20m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker21m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker22m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker23m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker24m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker25m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker26m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker27m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker28m" ).datepicker({ dateFormat: "dd/mm/yy" });
  } );
  </script>
  ';

  echo $msg;


     }elseif($_POST['moduleid']=='122'){

   
   $msg .= " <div class='d-md-none'>";
      $res_stem_lab_infra_data = $con -> query('SELECT * from stem_lab_infra_data where schoolid="'.$_POST["schoolid"].'" and user_id="'.$_SESSION["exp_dash_id"].'"');

 $rows_stem_lab_infra_data = mysqli_num_rows($res_stem_lab_infra_data);

 if($rows_stem_lab_infra_data>0){
foreach($res_stem_lab_infra_data as $lang){
$msg .= '<form method="post" action="addstemdata.php" id="add_stem_lab_infra_datam" enctype="multipart/form-data">
<h2>STEM Lab Infra</h2>
  <div class="col-sm-2"></div>
  <div class="col-sm-8">
  <h3>Components - Electric Work</h3>
  <h5>Start date</h5>
 <input type="text" id="datepicker19m"  class="form-control" name="EWork_sdate" value="'.$lang['EWork_sdate'].'" autocomplete="off">

  <h5>End Date</h5>
 <input type="text" id="datepicker20m" class="form-control" name="EWork_edate" value="'.$lang['EWork_edate'].'" autocomplete="off">

  <h5>Progress</h5>
 <input type="text" id="EWork_progress" class="form-control" name="EWork_progress" value="'.$lang['EWork_progress'].'" autocomplete="off">

  <h5>Units</h5>
   <input type="text" id="EWork_units" class="form-control" name="EWork_units" value="'.$lang['EWork_units'].'" autocomplete="off">

 <h5>Before</h5>
   <input type="file" id="EWork_brefore" class="form-control" name="EWork_brefore[]" value="'.$lang['EWork_brefore'].'" autocomplete="off" multiple/>

  <h5>WIP</h5>
   <input type="file" id="EWork_wip" class="form-control" name="EWork_wip[]" value="'.$lang['EWork_wip'].'" autocomplete="off" multiple/>

  <h5>After</h5>
  <input type="file" id="EWork_after" class="form-control" name="EWork_after[]" value="'.$lang['EWork_after'].'" autocomplete="off" multiple/>

  <h5>Issues/Changes</h5>
  <input type="text" id="EWork_issues" class="form-control" name="EWork_issues" value="'.$lang['EWork_issues'].'" autocomplete="off">

  <h5>Remarks</h5>
<input type="text" id="EWork_remarks" class="form-control" name="EWork_remarks" value="'.$lang['EWork_remarks'].'" autocomplete="off">

<h3>Components - Painting</h3>
  <h5>Start date</h5>
 <input type="text" id="datepicker21m" class="form-control" name="painting_sdate" value="'.$lang['painting_sdate'].'" autocomplete="off">

  <h5>End Date</h5>
<input type="text" id="datepicker22m" class="form-control" name="painting_edate" value="'.$lang['painting_edate'].'" autocomplete="off">

  <h5>Progress</h5>
<input type="text" id="painting_progress" class="form-control" name="painting_progress" value="'.$lang['painting_progress'].'" autocomplete="off">

  <h5>Units</h5>
  <input type="text" id="painting_units" class="form-control" name="painting_units" value="'.$lang['painting_units'].'" autocomplete="off">
 
  <h5>Before</h5>
 <input type="file" id="painting_brefore" class="form-control" name="painting_brefore[]" value="'.$lang['painting_brefore'].'" autocomplete="off" multiple/>
 
  <h5>WIP</h5>
 <input type="file" id="painting_wip" class="form-control" name="painting_wip[]" value="'.$lang['painting_wip'].'" autocomplete="off" multiple/>

  <h5>After</h5>
 <input type="file" id="painting_after" class="form-control" name="painting_after[]" value="'.$lang['painting_after'].'" autocomplete="off" multiple/>

  <h5>Issues/Changes</h5>
<input type="text" id="painting_issues" class="form-control" name="painting_issues" value="'.$lang['painting_issues'].'" autocomplete="off">

  <h5>Remarks</h5>
<input type="text" id="painting_remarks" class="form-control" name="painting_remarks" value="'.$lang['painting_remarks'].'" autocomplete="off">


<h3>Components - ModelDesks</h3>
  <h5>Start date</h5>
 <input type="text" id="datepicker23m" class="form-control" name="modelDesks_sdate" value="'.$lang['modelDesks_sdate'].'" autocomplete="off">

  <h5>End Date</h5>
<input type="text" id="datepicker24m" class="form-control" name="modelDesks_edate" value="'.$lang['modelDesks_edate'].'" autocomplete="off">

  <h5>Progress</h5>
<input type="text" id="modelDesks_progress" class="form-control" name="modelDesks_progress" value="'.$lang['modelDesks_progress'].'" autocomplete="off">

  <h5>Units</h5>
  <th><input type="text" id="modelDesks_units" class="form-control" name="modelDesks_units" value="'.$lang['modelDesks_units'].'" autocomplete="off">

 <h5>Before</h5>
<input type="file" id="modelDesks_brefore" class="form-control" name="modelDesks_brefore[]" value="'.$lang['modelDesks_brefore'].'" autocomplete="off" multiple/>

  <h5>WIP</h5>
<input type="file" id="modelDesks_wip" class="form-control" name="modelDesks_wip[]" value="'.$lang['modelDesks_wip'].'" autocomplete="off" multiple/>

  <h5>After</h5>
<input type="file" id="modelDesks_after" class="form-control" name="modelDesks_after[]" value="'.$lang['modelDesks_after'].'" autocomplete="off" multiple/>

  <h5>Issues/Changes</h5>
<input type="text" id="modelDesks_issues" class="form-control" name="modelDesks_issues" value="'.$lang['modelDesks_issues'].'" autocomplete="off">

  <h5>Remarks</h5>
<input type="text" id="modelDesks_remarks" class="form-control" name="modelDesks_remarks" value="'.$lang['modelDesks_remarks'].'" autocomplete="off">


<h3>Components - Cupboard</h3>
  <h5>Start date</h5>
 <input type="text" id="datepicker25m" class="form-control" name="cupboard_sdate" value="'.$lang['cupboard_sdate'].'" autocomplete="off">

  <h5>End Date</h5>
<input type="text" id="datepicker26m" class="form-control" name="cupboard_edate" value="'.$lang['cupboard_edate'].'" autocomplete="off">

  <h5>Progress</h5>
<input type="text" id="cupboard_progress" class="form-control" name="cupboard_progress" value="'.$lang['cupboard_progress'].'" autocomplete="off">

  <h5>Units</h5>
  <input type="text" id="cupboard_units" class="form-control" name="cupboard_units" value="'.$lang['cupboard_units'].'" autocomplete="off">
 
  <h5>Before</h5>
<input type="file" id="cupboard_brefore" class="form-control" name="cupboard_brefore[]" value="'.$lang['cupboard_brefore'].'" autocomplete="off" multiple/>

  <h5>WIP</h5>
<input type="file" id="cupboard_wip" class="form-control" name="cupboard_wip[]" value="'.$lang['cupboard_wip'].'" autocomplete="off" multiple/>

  <h5>After</h5>
 <input type="file" id="cupboard_after" class="form-control" name="cupboard_after[]" value="'.$lang['cupboard_after'].'" autocomplete="off" multiple/>

  <h5>Issues/Changes</h5>
<input type="text" id="cupboard_issues" class="form-control" name="cupboard_issues" value="'.$lang['cupboard_issues'].'" autocomplete="off">
  <h5>Remarks</h5>
<input type="text" id="cupboard_remarks" class="form-control" name="cupboard_remarks" value="'.$lang['cupboard_remarks'].'" autocomplete="off">


<h3>Components - Flooring</h3>
  <h5>Start date</h5>
 <input type="text" id="datepicker27m" class="form-control" name="flooring_sdate" value="'.$lang['flooring_sdate'].'" autocomplete="off">

  <h5>End Date</h5>
<input type="text" id="datepicker28m" class="form-control" name="flooring_edate" value="'.$lang['flooring_edate'].'" autocomplete="off">

  <h5>Progress</h5>
<input type="text" id="flooring_progress" class="form-control" name="flooring_progress" value="'.$lang['flooring_progress'].'" autocomplete="off">

  <h5>Units</h5>
  <input type="text" id="flooring_units" class="form-control" name="flooring_units" value="'.$lang['flooring_units'].'" autocomplete="off">

 <h5>Before</h5>
<input type="file" id="flooring_brefore" class="form-control" name="flooring_brefore[]" value="'.$lang['flooring_brefore'].'" autocomplete="off" multiple/>

  <h5>WIP</h5>
<input type="file" id="flooring_wip" class="form-control" name="flooring_wip[]" value="'.$lang['flooring_wip'].'" autocomplete="off" multiple/>

  <h5>After</h5>
 <input type="file" id="flooring_after" class="form-control" name="flooring_after[]" value="'.$lang['flooring_after'].'" autocomplete="off" multiple/>

  <h5>Issues/Changes</h5>
<input type="text" id="flooring_issues" class="form-control" name="flooring_issues" value="'.$lang['flooring_issues'].'" autocomplete="off">

  <h5>Remarks</h5>
<input type="text" id="flooring_remarks" class="form-control" name="flooring_remarks" value="'.$lang['flooring_remarks'].'" autocomplete="off">




<input type="hidden" name="action" value="update" class="tableres">
 <input type="hidden" name="schoolid" class="schoolid">
 <input type="hidden" name="projectid" class="projectid">
<input type="hidden" name="EWork_wip" value="'.$lang['EWork_wip'].'" class="tableres">
<input type="hidden" name="EWork_after" value="'.$lang['EWork_after'].'" class="tableres">
<input type="hidden" name="painting_wip" value="'.$lang['painting_wip'].'" class="tableres">
<input type="hidden" name="painting_after" value="'.$lang['painting_after'].'" class="tableres">
<input type="hidden" name="modelDesks_wip" value="'.$lang['modelDesks_wip'].'" class="tableres">
<input type="hidden" name="modelDesks_after" value="'.$lang['modelDesks_after'].'" class="tableres">
<input type="hidden" name="cupboard_wip" value="'.$lang['cupboard_wip'].'" class="tableres">
<input type="hidden" name="cupboard_after" value="'.$lang['cupboard_after'].'" class="tableres">
<input type="hidden" name="flooring_wip" value="'.$lang['flooring_wip'].'" class="tableres">
<input type="hidden" name="flooring_after" value="'.$lang['flooring_after'].'" class="tableres">

<input type="hidden" name="EWork_brefore" value="'.$lang['EWork_brefore'].'" class="tableres">
<input type="hidden" name="painting_brefore" value="'.$lang['painting_brefore'].'" class="tableres">
<input type="hidden" name="modelDesks_brefore" value="'.$lang['modelDesks_brefore'].'" class="tableres">
<input type="hidden" name="cupboard_brefore" value="'.$lang['cupboard_brefore'].'" class="tableres">
<input type="hidden" name="flooring_brefore" value="'.$lang['flooring_brefore'].'" class="tableres">
  <input type="hidden" name="table" value="stem_lab_infra_data" class="tableres">
<button type="button" class="btn btn-success" id="stem_lab_infra_datam" style="float: right;">Update</button>
</div>
<div class="col-sm-2"></div>


</form>';
    } }else{
$msg .= '<form method="post" action="addstemdata.php" id="add_stem_lab_infra_datam" enctype="multipart/form-data">
<h2>STEM Lab Infra</h2>
  <div class="col-sm-2"></div>
  <div class="col-sm-8">
  <h3>Components - Electric Work</h3>
  <h5>Start date</h5>
 <input type="text" id="datepicker19m"  class="form-control" name="EWork_sdate" autocomplete="off">

  <h5>End Date</h5>
 <input type="text" id="datepicker20m" class="form-control" name="EWork_edate" autocomplete="off">

  <h5>Progress</h5>
 <input type="text" id="EWork_progress" class="form-control" name="EWork_progress" autocomplete="off">

  <h5>Units</h5>
   <input type="text" id="EWork_units" class="form-control" name="EWork_units" autocomplete="off">

 <h5>Before</h5>
   <input type="file" id="EWork_brefore" class="form-control" name="EWork_brefore[]" autocomplete="off" multiple/>
   
  <h5>WIP</h5>
   <input type="file" id="EWork_wip" class="form-control" name="EWork_wip[]" autocomplete="off" multiple/>

  <h5>After</h5>
  <input type="file" id="EWork_after" class="form-control" name="EWork_after[]" autocomplete="off" multiple/>

  <h5>Issues/Changes</h5>
  <input type="text" id="EWork_issues" class="form-control" name="EWork_issues" autocomplete="off">

  <h5>Remarks</h5>
<input type="text" id="EWork_remarks" class="form-control" name="EWork_remarks" autocomplete="off">

<h3>Components - Painting</h3>
  <h5>Start date</h5>
 <input type="text" id="datepicker21m" class="form-control" name="painting_sdate" autocomplete="off">

  <h5>End Date</h5>
<input type="text" id="datepicker22m" class="form-control" name="painting_edate" autocomplete="off">

  <h5>Progress</h5>
<input type="text" id="painting_progress" class="form-control" name="painting_progress"  autocomplete="off">

  <h5>Units</h5>
  <input type="text" id="painting_units" class="form-control" name="painting_units" autocomplete="off">

<h5>Before</h5>
 <input type="file" id="painting_brefore" class="form-control" name="painting_brefore[]" autocomplete="off" multiple/>

  <h5>WIP</h5>
 <input type="file" id="painting_wip" class="form-control" name="painting_wip[]" autocomplete="off" multiple/>

  <h5>After</h5>
 <input type="file" id="painting_after" class="form-control" name="painting_after[]" autocomplete="off" multiple/>

  <h5>Issues/Changes</h5>
<input type="text" id="painting_issues" class="form-control" name="painting_issues" autocomplete="off">

  <h5>Remarks</h5>
<input type="text" id="painting_remarks" class="form-control" name="painting_remarks" autocomplete="off">


<h3>Components - ModelDesks</h3>
  <h5>Start date</h5>
 <input type="text" id="datepicker23m" class="form-control" name="modelDesks_sdate" autocomplete="off">

  <h5>End Date</h5>
<input type="text" id="datepicker24m" class="form-control" name="modelDesks_edate" autocomplete="off">

  <h5>Progress</h5>
<input type="text" id="modelDesks_progress" class="form-control" name="modelDesks_progress"  autocomplete="off">

  <h5>Units</h5>
  <th><input type="text" id="modelDesks_units" class="form-control" name="modelDesks_units" autocomplete="off">

 <h5>Before</h5>
<input type="file" id="modelDesks_brefore" class="form-control" name="modelDesks_brefore[]" autocomplete="off" multiple/>

  <h5>WIP</h5>
<input type="file" id="modelDesks_wip" class="form-control" name="modelDesks_wip[]" autocomplete="off" multiple/>

  <h5>After</h5>
<input type="file" id="modelDesks_after" class="form-control" name="modelDesks_after[]"  autocomplete="off" multiple/>

  <h5>Issues/Changes</h5>
<input type="text" id="modelDesks_issues" class="form-control" name="modelDesks_issues" autocomplete="off">

  <h5>Remarks</h5>
<input type="text" id="modelDesks_remarks" class="form-control" name="modelDesks_remarks" autocomplete="off">


<h3>Components - Cupboard</h3>
  <h5>Start date</h5>
 <input type="text" id="datepicker25m" class="form-control" name="cupboard_sdate" autocomplete="off">

  <h5>End Date</h5>
<input type="text" id="datepicker26m" class="form-control" name="cupboard_edate" autocomplete="off">

  <h5>Progress</h5>
<input type="text" id="cupboard_progress" class="form-control" name="cupboard_progress" autocomplete="off">

  <h5>Units</h5>
  <input type="text" id="cupboard_units" class="form-control" name="cupboard_units" autocomplete="off">

<h5>Before</h5>
<input type="file" id="cupboard_brefore" class="form-control" name="cupboard_brefore[]" autocomplete="off" multiple/>

  <h5>WIP</h5>
<input type="file" id="cupboard_wip" class="form-control" name="cupboard_wip[]" autocomplete="off" multiple/>

  <h5>After</h5>
 <input type="file" id="cupboard_after" class="form-control" name="cupboard_after[]" autocomplete="off" multiple/>

  <h5>Issues/Changes</h5>
<input type="text" id="cupboard_issues" class="form-control" name="cupboard_issues" autocomplete="off">

  <h5>Remarks</h5>
<input type="text" id="cupboard_remarks" class="form-control" name="cupboard_remarks" autocomplete="off">


<h3>Components - Flooring</h3>
  <h5>Start date</h5>
 <input type="text" id="datepicker27m" class="form-control" name="flooring_sdate" autocomplete="off">

  <h5>End Date</h5>
<input type="text" id="datepicker28m" class="form-control" name="flooring_edate" autocomplete="off">

  <h5>Progress</h5>
<input type="text" id="flooring_progress" class="form-control" name="flooring_progress" autocomplete="off">

  <h5>Units</h5>
  <input type="text" id="flooring_units" class="form-control" name="flooring_units"  autocomplete="off">

<h5>Before</h5>
<input type="file" id="flooring_brefore" class="form-control" name="flooring_brefore[]" autocomplete="off" multiple/>

  <h5>WIP</h5>
<input type="file" id="flooring_wip" class="form-control" name="flooring_wip[]" autocomplete="off" multiple/>

  <h5>After</h5>
 <input type="file" id="flooring_after" class="form-control" name="flooring_after[]" autocomplete="off" multiple/>

  <h5>Issues/Changes</h5>
<input type="text" id="flooring_issues" class="form-control" name="flooring_issues" autocomplete="off">

  <h5>Remarks</h5>
<input type="text" id="flooring_remarks" class="form-control" name="flooring_remarks" autocomplete="off">




<input type="hidden" name="action" value="add" class="tableres">
 <input type="hidden" name="schoolid" class="schoolid">
 <input type="hidden" name="projectid" class="projectid">
  <input type="hidden" name="table" value="stem_lab_infra_data" class="tableres">
<button type="button" class="btn btn-success" id="stem_lab_infra_datam" style="float: right;">Save</button>
</div>
<div class="col-sm-2"></div>
  </form>';
    }
   $msg .= '</div>';
  
 $msg .= " <div class='d-none d-sm-block'>";
      $res_stem_lab_infra_data = $con -> query('SELECT * from stem_lab_infra_data where schoolid="'.$_POST["schoolid"].'" and user_id="'.$_SESSION["exp_dash_id"].'"');

 $rows_stem_lab_infra_data = mysqli_num_rows($res_stem_lab_infra_data);

 if($rows_stem_lab_infra_data>0){
foreach($res_stem_lab_infra_data as $lang){

  $msg .= '<form method="post" action="addstemdata.php" id="add_stem_lab_infra_data_update" enctype="multipart/form-data">
 <table class="table table-bordered" style="margin-left: -10%;">
    <thead>
      <tr>  
<th></th>
<th></th>
<th colspan="3"><span style="text-align: center;"></span></th>
<th></th>
<th colspan="3" style="text-align: center;">Pic/Video</th>
<th></th>
      </tr>
  <tr>

    <th >Modules</th>
    <th>Components</th>
    <th>Start date</th>
    <th>End Date</th>
    <th>Progress</th>
    <th>Units</th>
    <th>Before</th>
    <th>WIP</th>
    <th>After</th>
    <th>Issues/Changes</th>
    <th>Remarks</th>
  </tr>
  <tr>
    <th rowspan="5"><p style="margin-bottom: 100%;">STEM Lab Infra</p></th>
    <th>Electric Work</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker19"  class="tableres" name="EWork_sdate" value="'.date('d/m/Y',strtotime($lang['EWork_sdate'])).'" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker20" class="tableres" name="EWork_edate" value="'.date('d/m/Y',strtotime($lang['EWork_edate'])).'" autocomplete="off"></div></th>
    <th><input type="text" id="progress" class="tableres" name="EWork_progress" value="'.$lang['EWork_progress'].'" autocomplete="off"></th>
     <th><input type="text" id="units" class="tableres" name="EWork_units" value="'.$lang['EWork_units'].'" autocomplete="off"></th>
      <th><input type="file" id="EWork_brefore" class="tableres" name="EWork_brefore[]" value="'.$lang['EWork_brefore'].'" autocomplete="off" multiple/></th>
     <th><input type="file" id="wip" class="tableres" name="EWork_wip[]" value="'.$lang['EWork_wip'].'" autocomplete="off" multiple/></th>
     <th><input type="file" id="after" class="tableres" name="EWork_after[]" value="'.$lang['EWork_after'].'" autocomplete="off" multiple/></th>
    <th><input type="text" id="issues" class="tableres" name="EWork_issues" value="'.$lang['EWork_issues'].'" autocomplete="off"></th>
    <th><input type="text" id="remarks" class="tableres" name="EWork_remarks" value="'.$lang['EWork_remarks'].'" autocomplete="off"></th>
  </tr>

  <tr>
    <th>Painting</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker21" class="tableres" name="painting_sdate" value="'.date('d/m/Y',strtotime($lang['painting_sdate'])).'" autocomplete="off"></siv></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker22" class="tableres" name="painting_edate" value="'.date('d/m/Y',strtotime($lang['painting_edate'])).'" autocomplete="off"></div></th>
    <th><input type="text" id="progress" class="tableres" name="painting_progress" value="'.$lang['painting_progress'].'" autocomplete="off"></th>
     <th><input type="text" id="units" class="tableres" name="painting_units" value="'.$lang['painting_units'].'" autocomplete="off"></th>
     <th><input type="file" id="painting_brefore" class="tableres" name="painting_brefore[]" value="'.$lang['painting_brefore'].'" autocomplete="off" multiple/></th>
     <th><input type="file" id="wip" class="tableres" name="painting_wip[]" value="'.$lang['painting_wip'].'" autocomplete="off" multiple/></th>
     <th><input type="file" id="after" class="tableres" name="painting_after[]" value="'.$lang['painting_after'].'" autocomplete="off" multiple/></th>
    <th><input type="text" id="issues" class="tableres" name="painting_issues" value="'.$lang['painting_issues'].'" autocomplete="off"></th>
    <th><input type="text" id="remarks" class="tableres" name="painting_remarks" value="'.$lang['painting_remarks'].'" autocomplete="off"></th>
  </tr>

  <tr>
    <th>ModelDesks</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker23" class="tableres" name="modelDesks_sdate" value="'.date('d/m/Y',strtotime($lang['modelDesks_sdate'])).'" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker24" class="tableres" name="modelDesks_edate" value="'.date('d/m/Y',strtotime($lang['modelDesks_edate'])).'" autocomplete="off"></div></th>
    <th><input type="text" id="progress" class="tableres" name="modelDesks_progress" value="'.$lang['modelDesks_progress'].'" autocomplete="off"></th>
     <th><input type="text" id="units" class="tableres" name="modelDesks_units" value="'.$lang['modelDesks_units'].'" autocomplete="off"></th>
     <th><input type="file" id="modelDesks_brefore" class="tableres" name="modelDesks_brefore[]" value="'.$lang['modelDesks_brefore'].'" autocomplete="off" multiple/></th>
     <th><input type="file" id="wip" class="tableres" name="modelDesks_wip[]" value="'.$lang['modelDesks_wip'].'" autocomplete="off" multiple/></th>
     <th><input type="file" id="after" class="tableres" name="modelDesks_after[]" value="'.$lang['modelDesks_after'].'" autocomplete="off" multiple/></th>
    <th><input type="text" id="issues" class="tableres" name="modelDesks_issues" value="'.$lang['modelDesks_issues'].'" autocomplete="off"></th>
    <th><input type="text" id="remarks" class="tableres" name="modelDesks_remarks" value="'.$lang['modelDesks_remarks'].'" autocomplete="off"></th>
  </tr>

  <tr>
    <th>Cupboard</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker25" class="tableres" name="cupboard_sdate" value="'.date('d/m/Y',strtotime($lang['cupboard_sdate'])).'" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker26" class="tableres" name="cupboard_edate" value="'.date('d/m/Y',strtotime($lang['cupboard_edate'])).'" autocomplete="off"></div></th>
    <th><input type="text" id="progress" class="tableres" name="cupboard_progress" value="'.$lang['cupboard_progress'].'" autocomplete="off"></th>
     <th><input type="text" id="units" class="tableres" name="cupboard_units" value="'.$lang['cupboard_units'].'" autocomplete="off"></th>
     <th><input type="file" id="cupboard_brefore" class="tableres" name="cupboard_brefore[]" value="'.$lang['cupboard_brefore'].'" autocomplete="off" multiple/></th>
     <th><input type="file" id="wip" class="tableres" name="cupboard_wip[]" value="'.$lang['cupboard_wip'].'" autocomplete="off" multiple/></th>
     <th><input type="file" id="after" class="tableres" name="cupboard_after[]" value="'.$lang['cupboard_after'].'" autocomplete="off" multiple/></th>
    <th><input type="text" id="issues" class="tableres" name="cupboard_issues" value="'.$lang['cupboard_issues'].'" autocomplete="off"></th>
    <th><input type="text" id="remarks" class="tableres" name="cupboard_remarks" value="'.$lang['cupboard_remarks'].'" autocomplete="off"></th>
  </tr>

  <tr>
    <th>Flooring</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker27" class="tableres" name="flooring_sdate" value="'.date('d/m/Y',strtotime($lang['flooring_sdate'])).'" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker28" class="tableres" name="flooring_edate" value="'.date('d/m/Y',strtotime($lang['flooring_edate'])).'" autocomplete="off"></div></th>
    <th><input type="text" id="progress" class="tableres" name="flooring_progress" value="'.$lang['flooring_progress'].'" autocomplete="off"></th>
     <th><input type="text" id="units" class="tableres" name="flooring_units" value="'.$lang['flooring_units'].'" autocomplete="off"></th>
      <th><input type="file" id="flooring_brefore" class="tableres" name="flooring_brefore[]" value="'.$lang['flooring_brefore'].'" autocomplete="off" multiple/></th>
     <th><input type="file" id="wip" class="tableres" name="flooring_wip[]" value="'.$lang['flooring_wip'].'" autocomplete="off" multiple/></th>
     <th><input type="file" id="after" class="tableres" name="flooring_after[]" value="'.$lang['flooring_after'].'" autocomplete="off" multiple/></th>
    <th><input type="text" id="issues" class="tableres" name="flooring_issues" value="'.$lang['flooring_issues'].'" autocomplete="off"></th>
    <th><input type="text" id="remarks" class="tableres" name="flooring_remarks" value="'.$lang['flooring_remarks'].'" autocomplete="off"></th>
  </tr>
  <input type="hidden" name="action" value="update" class="tableres">
   <input type="hidden" name="schoolid" class="schoolid">
   <input type="hidden" name="projectid" class="projectid">
<input type="hidden" name="EWork_wip" value="'.$lang['EWork_wip'].'" class="tableres">
<input type="hidden" name="EWork_after" value="'.$lang['EWork_after'].'" class="tableres">
<input type="hidden" name="painting_wip" value="'.$lang['painting_wip'].'" class="tableres">
<input type="hidden" name="painting_after" value="'.$lang['painting_after'].'" class="tableres">
<input type="hidden" name="modelDesks_wip" value="'.$lang['modelDesks_wip'].'" class="tableres">
<input type="hidden" name="modelDesks_after" value="'.$lang['modelDesks_after'].'" class="tableres">
<input type="hidden" name="cupboard_wip" value="'.$lang['cupboard_wip'].'" class="tableres">
<input type="hidden" name="cupboard_after" value="'.$lang['cupboard_after'].'" class="tableres">

<input type="hidden" name="flooring_wip" value="'.$lang['flooring_wip'].'" class="tableres">
<input type="hidden" name="flooring_after" value="'.$lang['flooring_after'].'" class="tableres">

<input type="hidden" name="EWork_brefore" value="'.$lang['EWork_brefore'].'" class="tableres">
<input type="hidden" name="painting_brefore" value="'.$lang['painting_brefore'].'" class="tableres">
<input type="hidden" name="modelDesks_brefore" value="'.$lang['modelDesks_brefore'].'" class="tableres">
<input type="hidden" name="cupboard_brefore" value="'.$lang['cupboard_brefore'].'" class="tableres">
<input type="hidden" name="flooring_brefore" value="'.$lang['flooring_brefore'].'" class="tableres">
</thead>
     
    </tbody>
  </table>
  <button type="button" id="stem_lab_infra_data_update" name="stem_lab_infra_data" class="btn btn-success" style="float: right;">Update</button>
   
</form>';

  } }else{

$msg .='<form method="post" action="addstemdata.php" id="add_stem_lab_infra_data" enctype="multipart/form-data">


 <table class="table table-bordered" style="margin-left: -10%;">
    <thead>
      <tr>  
<th></th>
<th></th>
<th colspan="3"><span style="text-align: center;"></span></th>
<th></th>
<th colspan="3" style="text-align: center;">Pic/Video</th>
<th></th>
      </tr>
  <tr>

    <th>Modules</th>
    <th>Components</th>
    <th>Start date</th>
    <th>End Date</th>
    <th>Progress</th>
    <th>Units</th>
    <th>Before</th>
    <th>WIP</th>
    <th>After</th>
    <th>Issues/Changes</th>
    <th>Remarks</th>
  </tr>
  <tr>
    <th rowspan="5"><p style="margin-bottom: 100%;">STEM Lab Infra</p></th>
    <th>Electric Work</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker19"  class="tableres" name="EWork_sdate" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker20" class="tableres" name="EWork_edate" autocomplete="off"></div></th>
    <th><input type="text" id="progress" class="tableres" name="EWork_progress" autocomplete="off"></th>
     <th><input type="text" id="units" class="tableres" name="EWork_units" autocomplete="off"></th>
     <th><input type="file" id="EWork_brefore" class="tableres" name="EWork_brefore[]" autocomplete="off" multiple/></th>
     <th><input type="file" id="wip" class="tableres" name="EWork_wip[]" autocomplete="off" multiple/></th>
     <th><input type="file" id="after" class="tableres" name="EWork_after[]" autocomplete="off" multiple/></th>
    <th><input type="text" id="issues" class="tableres" name="EWork_issues" autocomplete="off"></th>
    <th><input type="text" id="remarks" class="tableres" name="EWork_remarks" autocomplete="off"></th>
  </tr>

  <tr>
    <th>Painting</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker21" class="tableres" name="painting_sdate" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker22" class="tableres" name="painting_edate" autocomplete="off"></div></th>
    <th><input type="text" id="progress" class="tableres" name="painting_progress" autocomplete="off"></th>
     <th><input type="text" id="units" class="tableres" name="painting_units" autocomplete="off"></th>
      <th><input type="file" id="painting_brefore" class="tableres" name="painting_brefore[]" autocomplete="off" multiple/></th>
     <th><input type="file" id="wip" class="tableres" name="painting_wip[]" autocomplete="off" multiple/></th>
     <th><input type="file" id="after" class="tableres" name="painting_after[]" autocomplete="off" multiple/></th>
    <th><input type="text" id="issues" class="tableres" name="painting_issues" autocomplete="off"></th>
    <th><input type="text" id="remarks" class="tableres" name="painting_remarks" autocomplete="off"></th>
  </tr>

  <tr>
    <th>ModelDesks</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker23" class="tableres" name="modelDesks_sdate" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker24" class="tableres" name="modelDesks_edate" autocomplete="off"></div></th>
    <th><input type="text" id="progress" class="tableres" name="modelDesks_progress" autocomplete="off"></th>
     <th><input type="text" id="units" class="tableres" name="modelDesks_units" autocomplete="off"></th>
      <th><input type="file" id="modelDesks_brefore" class="tableres" name="modelDesks_brefore[]" autocomplete="off" multiple/></th>
     <th><input type="file" id="wip" class="tableres" name="modelDesks_wip[]" autocomplete="off" multiple/></th>
     <th><input type="file" id="after" class="tableres" name="modelDesks_after[]" autocomplete="off" multiple/></th>
    <th><input type="text" id="issues" class="tableres" name="modelDesks_issues" autocomplete="off"></th>
    <th><input type="text" id="remarks" class="tableres" name="modelDesks_remarks" autocomplete="off"></th>
  </tr>

  <tr>
    <th>Cupboard</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker25" class="tableres" name="cupboard_sdate" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker26" class="tableres" name="cupboard_edate" autocomplete="off"></div></th>
    <th><input type="text" id="progress" class="tableres" name="cupboard_progress" autocomplete="off"></th>
     <th><input type="text" id="units" class="tableres" name="cupboard_units" autocomplete="off"></th>
      <th><input type="file" id="cupboard_brefore" class="tableres" name="cupboard_brefore[]" autocomplete="off" multiple/></th>
     <th><input type="file" id="wip" class="tableres" name="cupboard_wip[]" autocomplete="off" multiple/></th>
     <th><input type="file" id="after" class="tableres" name="cupboard_after[]" autocomplete="off" multiple/></th>
    <th><input type="text" id="issues" class="tableres" name="cupboard_issues" autocomplete="off"></th>
    <th><input type="text" id="remarks" class="tableres" name="cupboard_remarks" autocomplete="off"></th>
  </tr>

  <tr>
    <th>Flooring</th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker27" class="tableres" name="flooring_sdate" autocomplete="off"></div></th>
    <th><div id="calender" style="display: flex;"> <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
  <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"></path>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"></path></svg> </span><input type="text" id="datepicker28" class="tableres" name="flooring_edate" autocomplete="off"></div></th>
    <th><input type="text" id="progress" class="tableres" name="flooring_progress" autocomplete="off"></th>
     <th><input type="text" id="units" class="tableres" name="flooring_units" autocomplete="off"></th>
      <th><input type="file" id="flooring_brefore" class="tableres" name="flooring_brefore[]" autocomplete="off" multiple/></th>
     <th><input type="file" id="wip" class="tableres" name="flooring_wip[]" autocomplete="off" multiple/></th>
     <th><input type="file" id="after" class="tableres" name="flooring_after[]" autocomplete="off" multiple/></th>
    <th><input type="text" id="issues" class="tableres" name="flooring_issues" autocomplete="off"></th>
    <th><input type="text" id="remarks" class="tableres" name="flooring_remarks" autocomplete="off"></th>
  </tr>
  <input type="hidden" name="action" value="add" class="tableres">
   <input type="hidden" name="schoolid" class="schoolid">
   <input type="hidden" name="projectid" class="projectid">
  <input type="hidden" name="table" value="stem_lab_infra_data" class="tableres">
</thead>
     
    </tbody>
  </table>
  <button type="button" id="stem_lab_infra_data" name="stem_lab_infra_data" class="btn btn-success" style="float: right;">Save</button>
   
</form>';
  }
$msg .='</div>
  <style>
 span#basic-addon1 {
    padding: 4px 2px 4px 4px;
}
    </style>
<script>
 $(document).ready(function(){
    $("#stem_lab_infra_data").click(function(){        
        $("#add_stem_lab_infra_data").submit(); // Submit the form
    });

    $("#stem_lab_infra_datam").click(function(){        
        $("#add_stem_lab_infra_datam").submit(); // Submit the form
    });

  $("#stem_lab_infra_data_update").click(function(){    
        $("#add_stem_lab_infra_data_update").submit(); 
    });
$(".schoolid").val($("#school_drop").val());
$(".projectid").val($("#project_drop").val());
    

});
</script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker2" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker3" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker4" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker5" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker6" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker7" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker8" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker9" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker10" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker11" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker12" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker13" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker14" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker15" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker16" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker17" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker18" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker19" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker20" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker21" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker22" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker23" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker24" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker25" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker26" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker27" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker28" ).datepicker({ dateFormat: "dd/mm/yy" });

    $( "#datepickerm" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker2m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker3m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker4m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker5m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker6m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker7m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker8m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker9m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker10m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker11m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker12m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker13m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker14m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker15m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker16m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker17m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker18m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker19m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker20m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker21m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker22m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker23m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker24m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker25m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker26m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker27m" ).datepicker({ dateFormat: "dd/mm/yy" });
    $( "#datepicker28m" ).datepicker({ dateFormat: "dd/mm/yy" });
  } );
  </script>
  ';
  echo $msg;


     }

    //board and language names in session variables

    // $lang_query = "SELECT languages.language_id,languages.language from languages where languages.language_id in (SELECT project_school.language_id from project_school where
    // project_id='".$_POST['project']."'
    // and school_id='".$_POST['school']."')";
    // $res = mysqli_query($con,$lang_query) or die(mysqli_error($con));
    // $board = "";
    // $language= "";
    // while($lang = mysqli_fetch_assoc($res)){
    //   $language.="<option value='".$lang['language_id']."' >".$lang['language']."</option> ";
    // }

    // $board_query = "SELECT boards.board_id,boards.board_name from boards where boards.board_id in (SELECT project_school.school_board from project_school where
    // project_id='".$_POST['project']."'
    // and school_id='".$_POST['school']."')";
    // $b_res = mysqli_query($con,$board_query) or die(mysqli_error($con));
    // while($brd = mysqli_fetch_assoc($b_res)){
    //   $board.="<option value='".$brd['board_id']."' >".$brd['board_name']."</option> ";
    // }
    // $arr = array(
    //   'board' => $board,
    //   'language' => $language
    // );
    // echo json_encode($arr);
  }
 ?>
