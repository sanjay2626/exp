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
                  $name =$row['0'];
                  $address_line_1 = $row['1'];
                  $address_line_2 = $row['2'];
                  $address_line_3 = $row['3'];
                  $pincode = $row['4'];
                  $state = $row['5'];
                  $city = $row['6'];
                  $language_list = $row['7'];
                  $school_board = $row['8'];
                  $school_type = $row['9'];
                  $start_grade = $row['10'];
                  $end_grade = $row['11'];
                  $principal_name = $row['12'];
                  $principal_email = $row['13'];
                  $principal_mobile = $row['14'];
                  $science_teacher = $row['15'];
                  $science_teacher_number = $row['16'];
                  $maths_teacher = $row['17'];
                  $maths_teacher_number = $row['18'];
                  $gMapLink = $row['19'];
                  $remarks = $row['20'];
                  
    
                    $studentQuery = "insert into school(name,address_line_1,address_line_2,pincode,state,city,language_list,school_board,school_type,start_grade,end_grade,principal_name,principal_email,principal_mobile,science_teacher,
                    science_teacher_number,maths_teacher,maths_teacher_number,gMapLink,remarks) values('".$name."','".$address_line_1."','".$address_line_2."','".$pincode."','".$state."','".$city."','".$language_list."','".$school_board."',
                    '".$school_type."','".$start_grade."','".$end_grade."','".$principal_name."','".$principal_email."','".$principal_mobile."','".$science_teacher."',
                    '".$science_teacher_number."','".$maths_teacher."','".$maths_teacher_number."','".$gMapLink."','".$remarks."')";
                    
                
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