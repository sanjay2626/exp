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
                  $EWork_sdate1 = $row['4'];
                  $date_es = str_replace('/', '-', $EWork_sdate1);
                  $EWork_sdate = date('Y-m-d', strtotime($date_es));
                  $EWork_edate2 = $row['5'];
                  $date_es2 = str_replace('/', '-', $EWork_edate2);
                  $EWork_edate = date('Y-m-d', strtotime($date_es2));
                  $EWork_progress = $row['6'];
                  $EWork_units = $row['7'];
                  $painting_sdate1 = $row['8'];
                  $date_es3 = str_replace('/', '-', $painting_sdate1);
                  $painting_sdate = date('Y-m-d', strtotime($date_es3));
                  $painting_edate2 = $row['9'];
                  $date_es4 = str_replace('/', '-', $painting_edate2);
                  $painting_edate = date('Y-m-d', strtotime($date_es4));
                  $painting_progress = $row['10'];
                  $painting_units = $row['11'];
                  $modelDesks_sdate1 = $row['12'];
                  $date_es5 = str_replace('/', '-', $modelDesks_sdate1);
                  $modelDesks_sdate = date('Y-m-d', strtotime($date_es5));
                  $modelDesks_edate2 = $row['13'];
                  $date_es6 = str_replace('/', '-', $modelDesks_edate2);
                  $modelDesks_edate = date('Y-m-d', strtotime($date_es6));
                  $modelDesks_progress = $row['14'];
                  $modelDesks_units = $row['15'];
                  $cupboard_sdate2 = $row['16'];
                  $date_es7 = str_replace('/', '-', $cupboard_sdate2);
                  $cupboard_sdate = date('Y-m-d', strtotime($date_es7));
                  $cupboard_edate2 = $row['17'];
                  $date_es8 = str_replace('/', '-', $cupboard_edate2);
                  $cupboard_edate = date('Y-m-d',strtotime($date_es8));
                  $cupboard_progress = $row['18'];
                  $cupboard_units = $row['19'];
                  $flooring_sdate2 = $row['20'];
                  $date_es9 = str_replace('/', '-', $flooring_sdate2);
                  $flooring_sdate = date('Y-m-d',strtotime($date_es9));
                  $flooring_edate2 = $row['21'];
                  $date_es10 = str_replace('/', '-', $flooring_edate2);
                  $flooring_edate = date('Y-m-d',strtotime($date_es10));
                  $flooring_progress = $row['22'];
                  $flooring_units = $row['23'];
                 
                  
                  $project_query = "SELECT id from project where name ='$projectName'";
                  $result = $conn->query($project_query);
                  $row = $result->fetch_assoc();
                  $project_id = $row[id];
                  
                  $school_query = "SELECT id from school where name ='$schoolName'";
                  $school_result = $conn->query($school_query);
                  $school_row = $school_result->fetch_assoc();
                  $school_id = $school_row[id];
                  
                   $user_id = "payal";
                  
                
                
    
                    $studentQuery = "insert into stem_lab_infra_data(user_id,projectid,schoolid,EWork_sdate,EWork_edate,EWork_progress,EWork_units,painting_sdate,painting_edate,painting_progress,painting_units,modelDesks_sdate,modelDesks_edate,modelDesks_progress,modelDesks_units,cupboard_sdate,cupboard_edate,cupboard_progress,cupboard_units,flooring_sdate,flooring_edate,flooring_progress,flooring_units) 
                    values('".$user_id."','".$project_id."','".$school_id."','".$EWork_sdate."','".$EWork_edate."','".$EWork_progress."','".$EWork_units."','".$painting_sdate."','".$painting_edate."','".$painting_progress."','".$painting_units."','".$modelDesks_sdate."','".$modelDesks_edate."','".$modelDesks_progress."','".$modelDesks_units."','".$cupboard_sdate."','".$cupboard_edate."','".$cupboard_progress."','".$cupboard_units."','".$flooring_sdate."','".$flooring_edate."','".$flooring_progress."','".$flooring_units."')";
                //  print_r($studentQuery); exit;
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