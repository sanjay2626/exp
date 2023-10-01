<?php
if(!isset($_GET['delivery_id'])){
  header("location:../dashboard.php");
}else{
  function x($data){
    global $con;
    return mysqli_real_escape_string($con,(trim($data)));
  }
  require '../check_login.php';
  $del_id = x($_GET['delivery_id']);
  $plan_sub_id = x($_GET['plan_sub_id']);
  $query = "SELECT school.*, module_id,school_id,session from delivery_plan as D
  INNER JOIN school on school.id = D.school_id
  where D.sub_id='{$plan_sub_id}' LIMIT 1";
  $res = mysqli_query($con,$query) or die(mysqli_error($con));
  $row = mysqli_fetch_assoc($res);

  $prod_name_query = "SELECT id,name from product where id in
  (SELECT product_id from delivery_plan where sub_id='{$plan_sub_id}')";
  $prod_res = mysqli_query($con,$prod_name_query) or die(mysqli_error($con));
  while($prod = mysqli_fetch_assoc($prod_res)){
    $p_name[$prod['id']] = $prod['name'];
  }

  $del_query = "SELECT NULL as product,";
  for ($i=1; $i < 11; $i++) {
    $del_query.="SUM(grade_{$i}) as grade_{$i},";
  }
  $del_query.="SUM(school_specific) as school_specific,NULL as initiation_date from delivery_data where delivery_id='{$del_id}' UNION SELECT P.product_id,";
  for ($i=1; $i < 11; $i++) {
    $del_query.="D.grade_{$i},";
  }

  $del_query.="D.school_specific,delivery_status.initiation_date from delivery_data as D
  INNER JOIN delivery_plan as P on
  P.id = D.plan_id
  INNER JOIN delivery_status on delivery_status.delivery_id=D.delivery_id
  where D.delivery_id='{$del_id}'

  ";
  //die($del_query);

  $del_res = mysqli_query($con,$del_query) or die(mysqli_error($con));
  $del = mysqli_fetch_assoc($del_res);
  $grades = [];
  foreach ($del as $key => $value) {
    if($value==0 || is_null($value)){
      continue;
    }else{
      array_push($grades,$key);
    }
  }


  $del = mysqli_fetch_assoc($del_res);
  $initiation = date("d-M-Y",strtotime($del['initiation_date']));
}

require('fpdf/write_html.php');
$pdf=new PDF();
$pdf->AddPage();
$pdf->Image('../logo.jpg',10,6,30);
$pdf->Ln(10);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(190,10,"Delivery - {$_SESSION['module_name'][$row['module_id']]}",0,0,'C');

$pdf->Ln(20);
$pdf->SetFont('Arial','',12);
$pdf->Cell(80,10,"School Address",0,0);
$pdf->Cell(50,10,"",0,0);
$pdf->Cell(80,10,"Date: {$initiation}",0,1);
$pdf->Cell(80,10,"{$row['name']}",0,0);
$pdf->Cell(50,10,"",0,0);
$pdf->Cell(80,10,"Invoice No: ____________ ",0,1);
$pdf->Cell(80,10,"{$row['address_line_1']}",0,0);
$pdf->Cell(50,10,"",0,0);
$pdf->Cell(80,10,"Reference No: ___________ ",0,1);
$pdf->Cell(80,10,"{$row['address_line_2']}",0,1);
$pdf->Ln(20);
$table = '<table border="1"><tr><td>Product</td>';
for ($i=1; $i <11 ; $i++) {
  if(in_array("grade_{$i}",$grades))
  $table.="<td width='72'>Grade {$i}</td>";
}
if(in_array("school_specific",$grades))
  $table.="<td width='72'>Quantity</td>";
$table.="</tr>";
  do{
    $table.="<tr><td >{$p_name[$del['product']]}</td>";
    for ($i=1; $i <11 ; $i++) {
      if(in_array("grade_{$i}",$grades))
      $table.="<td width='72'>{$del['grade_'.$i]}</td>";
    }

    if(in_array("school_specific",$grades))
      $table.="<td width='72'>{$del['school_specific']}</td>";
    $table.="</tr>";
  }while($del = mysqli_fetch_assoc($del_res));
$table.="</table>";

// $pdf->SetFont('Arial','',12);
 $pdf->WriteHTML($table);
 $pdf -> Ln(30);
 $pdf-> Cell(80,10,"From");
 $pdf-> Cell(50,10,"");
 $pdf-> Cell(80,10,"Received and checked by:");
 $pdf -> Ln(15);
 $pdf-> Cell(80,10,"Experifun Educational Solutions Pvt Ltd");
 $pdf-> Cell(50,10,"");
 $pdf-> Cell(80,10,"Name");

 $pdf -> Ln(80);
 $pdf-> Cell(80,10,"Authorized Signatory");
 $pdf-> Cell(50,10,"");
 $pdf-> Cell(80,10,"Signature");
$pdf->Output();

?>
