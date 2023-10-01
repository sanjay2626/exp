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
                  $science_sdate1 = $row['4'];
                  $date_es = str_replace('/', '-', $science_sdate1);
                  $science_sdate = date('Y-m-d', strtotime($date_es));
                  $science_edate2 = $row['5'];
                  $date_es2 = str_replace('/', '-', $science_edate2);
                  $science_edate = date('Y-m-d', strtotime($date_es2));
                  $science_progress = $row['6'];
                  $science_units = $row['7'];
                  $math_sdate1 = $row['8'];
                  $date_es3 = str_replace('/', '-', $math_sdate1);
                  $math_sdate = date('Y-m-d', strtotime($date_es3));
                  $math_edate2 = $row['9'];
                  $date_es4 = str_replace('/', '-', $math_edate2);
                  $math_edate = date('Y-m-d', strtotime($date_es4));
                  $math_progress = $row['10'];
                  $math_units = $row['11'];
                  $robotics_sdate1 = $row['12'];
                  $date_es5 = str_replace('/', '-', $robotics_sdate1);
                  $robotics_sdate = date('Y-m-d', strtotime($date_es5));
                  $robotics_edate2 = $row['13'];
                  $date_es6 = str_replace('/', '-', $robotics_edate2);
                  $robotics_edate = date('Y-m-d', strtotime($date_es6));
                  $robotics_progress = $row['14'];
                  $robotics_units = $row['15'];
                  $computer_sdate2 = $row['16'];
                  $date_es7 = str_replace('/', '-', $computer_sdate2);
                  $computer_sdate = date('Y-m-d', strtotime($date_es7));
                  $computer_edate2 = $row['17'];
                  $date_es8 = str_replace('/', '-', $computer_edate2);
                  $computer_edate = date('Y-m-d',strtotime($date_es8));
                  $computer_progress = $row['18'];
                  $computer_units = $row['19'];
                  
                 
                  
                  $project_query = "SELECT id from project where name ='$projectName'";
                  $result = $conn->query($project_query);
                  $row = $result->fetch_assoc();
                  $project_id = $row[id];
                  
                  $school_query = "SELECT id from school where name ='$schoolName'";
                  $school_result = $conn->query($school_query);
                  $school_row = $school_result->fetch_assoc();
                  $school_id = $school_row[id];
                  
                   $user_id = "payal";
                  
                
                
    
                    $studentQuery = "insert into stem_models_data(user_id,projectid,schoolid,science_sdate,science_edate,science_progress,science_units,math_sdate,math_edate,math_progress,math_units,robotics_sdate,robotics_edate,robotics_progress,robotics_units,computer_sdate,computer_edate,computer_progress,computer_units) 
                    values('".$user_id."','".$project_id."','".$school_id."','".$science_sdate."','".$science_edate."','".$science_progress."','".$science_units."','".$math_sdate."','".$math_edate."','".$math_progress."','".$math_units."','".$robotics_sdate."','".$robotics_edate."','".$robotics_progress."','".$robotics_units."','".$computer_sdate."','".$computer_edate."','".$computer_progress."','".$computer_units."')";
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