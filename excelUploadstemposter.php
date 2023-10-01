<?php

$host = "localhost";
    $username = "gratiantechno_test";
    $password = "3a@qvb)H;Bb@";
    $database = "gratiantechno_dashboard";

    // Create DB Connection
    $conn = mysqli_connect($host, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
   

    require 'vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
    if(isset($_POST['Submit'])){

        $fileName = $_FILES['import_file']['name'];
        $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);
      
    
        $allowed_ext = ['xls','csv','xlsx'];
    
        if(in_array($file_ext, $allowed_ext))
        {
            $inputFileNamePath = $_FILES['import_file']['tmp_name'];
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
            $data = $spreadsheet->getActiveSheet()->toArray();
           
            $count = "0";
            foreach($data as $row)
            {
                if($count > 0)
                {
                  $projectName =$row['1'];
                  $schoolName = $row['2'];
                  $bWall_sdate1 = $row['4'];
                  $date_es = str_replace('/', '-', $bWall_sdate1);
                  $bWall_sdate = date('Y-m-d', strtotime($date_es));
                  $bWall_edate2 = $row['5'];
                  $date_es2 = str_replace('/', '-', $bWall_edate2);
                  $bWall_edate = date('Y-m-d', strtotime($date_es2));
                  $bWall_progress = $row['6'];
                  $bWall_units = $row['7'];
                  $concepts_sdate1 = $row['8'];
                  $date_es3 = str_replace('/', '-', $concepts_sdate1);
                  $concepts_sdate = date('Y-m-d', strtotime($date_es3));
                  $concepts_edate2 = $row['9'];
                  $date_es4 = str_replace('/', '-', $concepts_edate2);
                  $concepts_edate = date('Y-m-d', strtotime($date_es4));
                  $concepts_progress = $row['10'];
                  $concepts_units = $row['11'];
                  $sSystem_sdate1 = $row['12'];
                  $date_es5 = str_replace('/', '-', $sSystem_sdate1);
                  $sSystem_sdate = date('Y-m-d', strtotime($date_es5));
                  $sSystem_edate2 = $row['13'];
                  $date_es6 = str_replace('/', '-', $sSystem_edate2);
                  $sSystem_edate = date('Y-m-d', strtotime($date_es6));
                  $sSystem_progress = $row['14'];
                  $sSystem_units = $row['15'];
                  $inCorner_sdate2 = $row['16'];
                  $date_es7 = str_replace('/', '-', $inCorner_sdate2);
                  $inCorner_sdate = date('Y-m-d', strtotime($date_es7));
                  $inCorner_edate2 = $row['17'];
                  $date_es8 = str_replace('/', '-', $inCorner_edate2);
                  $inCorner_edate = date('Y-m-d',strtotime($date_es8));
                  $inCorner_progress = $row['18'];
                  $inCorner_units = $row['19'];
                  $cutouts_sdate2 = $row['20'];
                  $date_es9 = str_replace('/', '-', $cutouts_sdate2);
                  $cutouts_sdate = date('Y-m-d',strtotime($date_es9));
                  $cutouts_edate2 = $row['21'];
                  $date_es10 = str_replace('/', '-', $cutouts_edate2);
                  $cutouts_edate = date('Y-m-d',strtotime($date_es10));
                  $cutouts_progress = $row['22'];
                  $cutouts_units = $row['23'];
                 
                  
                  $project_query = "SELECT id from project where name ='$projectName'";
                  $result = $conn->query($project_query);
                  $row = $result->fetch_assoc();
                  $project_id = $row[id];
                  
                  $school_query = "SELECT id from school where name ='$schoolName'";
                  $school_result = $conn->query($school_query);
                  $school_row = $school_result->fetch_assoc();
                  $school_id = $school_row[id];
                  
                   $user_id = "payal";
                  
                
                
    
                    $studentQuery = "insert into stempostersdata(user_id,projectid,schoolid,bWall_sdate,bWall_edate,bWall_progress,bWall_units,concepts_sdate,concepts_edate,concepts_progress,concepts_units,sSystem_sdate,sSystem_edate,sSystem_progress,sSystem_units,inCorner_sdate,inCorner_edate,inCorner_progress,inCorner_units,cutouts_sdate,cutouts_edate,cutouts_progress,cutouts_units) 
                    values('".$user_id."','".$project_id."','".$school_id."','".$bWall_sdate."','".$bWall_edate."','".$bWall_progress."','".$bWall_units."','".$concepts_sdate."','".$concepts_edate."','".$concepts_progress."','".$concepts_units."','".$sSystem_sdate."','".$sSystem_edate."','".$sSystem_progress."','".$sSystem_units."','".$inCorner_sdate."','".$inCorner_edate."','".$inCorner_progress."','".$inCorner_units."','".$cutouts_sdate."','".$cutouts_edate."','".$cutouts_progress."','".$cutouts_units."')";
                  //print_r($studentQuery); exit;
                    $result = mysqli_query($conn, $studentQuery);
                    $msg = true;
                }
                else
                {
                    $count = "1";
                }
            }
    
            if(isset($msg))
            {
                $_SESSION['message'] = "Successfully Imported";
                header('Location: https://devdashboard.experifun.com/');
                exit(0);
            }
            else
            {
                $_SESSION['message'] = "Not Imported";
                header('Location: excelup.php');
                exit(0);
            }
        }
        else
        {
            $_SESSION['message'] = "Invalid File";
            header('Location: excelup.php');
            exit(0);
        }
    }



?>