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
                  $projectName =$row['0'];
                  $schoolName = $row['1'];
                  $Language = $row['2'];
                  $school_board = $row['3'];
                  $student_count = $row['4'];
                  $school_type = $row['5'];
                  
                  $project_query = "SELECT id from project where name ='$projectName'";
                  $result = $conn->query($project_query);
                  $row = $result->fetch_assoc();
                  $project_id = $row[id];
                  
                  $school_query = "SELECT id from school where name ='$schoolName'";
                  $school_result = $conn->query($school_query);
                  $school_row = $school_result->fetch_assoc();
                  $school_id = $school_row[id];
                  
                  $Language_query = "SELECT language_id from languages where language ='$Language'";
                  $Language_result = $conn->query($Language_query);
                  $Language_row = $Language_result->fetch_assoc();
                  $language_id = $Language_row[language_id];
                  
                  $school_board_query = "SELECT board_id from boards where board_name ='$school_board'";
                  $school_board_result = $conn->query($school_board_query);
                  $school_board_row = $school_board_result->fetch_assoc();
                  $school_board = $school_board_row[board_id];
                  
                
                  
    
                    $studentQuery = "insert into project_school(project_id,school_id,language_id,school_board) values('".$project_id."','".$school_id."','".$language_id."','".$school_board."')";
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
                header('Location: https://dashboard.experifun.com/');
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