<?php

$host = "localhost";
    $username = "newdashusr";
    $password = "xUW15GMEEuvBx!Tp#R4O";
    $database = "newdashboard";

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
                  $userid =$row['0'];
                  $centerName = $row['2'];
                  $centerId = $row['3'];
                  $childName = $row['4'];
                  $postCode = $row['11'];
                  $mobile = $row['34'];
                  $email = $row['35'];
                 
                 
                
                  
    
                    $studentQuery = "insert into sonas_orientation_data(userid,centerName,centerId,childName,postCode,mobile,email) 
                    values('".$userid."','".$centerName."','".$centerId."','".$childName."','".$postCode."','".$mobile."','".$email."')";
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