<?php
session_start();
//echo $_SESSION['exp_dash_name'];
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: http://devdb.experifun.com/admin");
    exit();
}

if (isset($_SESSION['exp_dash_name'])) {
    //header("Location: dashboard.php");
    //exit();
}

ob_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Experifun</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index_css.css">
</head>

<body>
    <div class="container login-form">
        <div class="row" style="height:100%">
            <!--For Logo-->
            <div class="col-sm-6" id="logo_border" align="center" style="border-right:1px solid gray; display:flex; justify-content:center;align-items:center">
                <div class="logo"></div>
            </div>
            <!--For form-->
            <div class="col-sm-6 form">
                <form method="post" autofill="off">
                    <h2 class="heading">Login</h2>
                    <div class="container" style="max-width:300px;">
                        <input placeholder="User ID" type="text" name="user_id" class="form-control gray" />
                        <input placeholder="Password" type="password" name="pass" class="form-control gray" />
                        <input type="submit" name="submit" value="Login" class="form-control btn-success" />
                        <!--a href="#">Forgot Password?</a-->
                    </div>
                </form>
            </div>
        </div>
    </div>
	
</body>

</html>

<?php

if (!empty($_POST['submit'])) {
	echo "inside submit";
    $con = mysqli_connect("localhost", "root", '', 'devdb') or exit("Error");

    function test_input($data)
    {
        global $con;
        return mysqli_real_escape_string($con, (trim($data)));
    }

    $user = test_input($_POST['user_id']);
    $pass = test_input($_POST['pass']);

    $stmt = mysqli_stmt_init($con);

    if (mysqli_stmt_prepare($stmt, 'SELECT * FROM user WHERE user_id=? and delete_flag=0')) {
        /* bind parameters for markers */
        mysqli_stmt_bind_param($stmt, "s", $user);

        /* execute query */
        mysqli_stmt_execute($stmt);

        /* bind result variables */
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        /* fetch value */
        mysqli_stmt_close($stmt);
    } else {
        echo "<script> alert('Error Occured!'); </script>";
        exit();
    }

    if (($row['password'] == "experifun" && $pass == "experifun") || (password_verify($pass, $row['password']) == 1)) {
        $permissions_query = "SELECT permissions from role where id='" . $row['role'] . "'";
        $permissions_query_res = mysqli_query($con, $permissions_query) or die(mysqli_error($con));

        $row_perm = mysqli_fetch_row($permissions_query_res);

        $_SESSION["permissions"] = explode(",", $row_perm[0]);

        if (in_array("10", $_SESSION["permissions"])) {
            $_SESSION['exp_dellivery_user_id'] = $row['user_id'];
            $_SESSION['exp_dellivery_name'] = $row['name'];
            $_SESSION['school_id'] = $row['school_id'];
            header("Location: Delivery/confirm-delivery.php");
            exit();
        }

        $_SESSION['exp_dash_id'] = $row['user_id'];
        $_SESSION['exp_dash_name'] = $row['name'];
        $_SESSION['user_role'] = $row['role'];

        if (in_array("6", $_SESSION["permissions"])) {
            mysqli_query($con, "SET SESSION group_concat_max_len = 1000000");
            $project_query = "SELECT group_concat(id) as list from project where delete_flag=0";
            $project_query_res = mysqli_query($con, $project_query) or die(mysqli_error($con));
            $_SESSION['projects'] = mysqli_fetch_row($project_query_res)[0];
            $school_query = "SELECT group_concat(id) as list from school where delete_flag=0";
            $school_query_res = mysqli_query($con, $school_query) or die(mysqli_error($con));
            $_SESSION['school_id'] = mysqli_fetch_row($school_query_res)[0];
        } elseif (in_array("5", $_SESSION["permissions"])) {
            mysqli_query($con, "SET SESSION group_concat_max_len = 1000000");
            $_SESSION['projects'] = $row["project_list"];
            $school_query = "SELECT group_concat(id) as list from school where delete_flag=0";
            $school_query_res = mysqli_query($con, $school_query) or die(mysqli_error($con));
            $_SESSION['school_id'] = mysqli_fetch_row($school_query_res)[0];
        } elseif (in_array("4", $_SESSION["permissions"])) {
            mysqli_query($con, "SET SESSION group_concat_max_len = 1000000");
            $_SESSION['school_id'] = $row["school_id"];
            $school_query = "SELECT group_concat(id) as list from project where delete_flag=0";
            $school_query_res = mysqli_query($con, $school_query) or die(mysqli_error($con));
            $_SESSION['projects'] = mysqli_fetch_row($school_query_res)[0];
        } elseif (in_array("16", $_SESSION["permissions"])) {
            mysqli_query($con, "SET SESSION group_concat_max_len = 1000000");
            $_SESSION['school_id'] = $row["school_id"];
            $school_query = "SELECT group_concat(id) as list from project where delete_flag=0";
            $school_query_res = mysqli_query($con, $school_query) or die(mysqli_error($con));
            $_SESSION['projects'] = mysqli_fetch_row($school_query_res)[0];
        } elseif (in_array("14", $_SESSION["permissions"])) {
            mysqli_query($con, "SET SESSION group_concat_max_len = 1000000");
            $_SESSION['school_id'] = $row["school_id"];
            $school_query = "SELECT group_concat(id) as list from project where delete_flag=0";
            $school_query_res = mysqli_query($con, $school_query) or die(mysqli_error($con));
            $_SESSION['projects'] = mysqli_fetch_row($school_query_res)[0];
        } elseif (in_array("15", $_SESSION["permissions"])) {
            mysqli_query($con, "SET SESSION group_concat_max_len = 1000000");
            $_SESSION['projects'] = $row["project_list"];
            $school_query = "SELECT group_concat(id) as list from school where delete_flag=0";
            $school_query_res = mysqli_query($con, $school_query) or die(mysqli_error($con));
            $_SESSION['school_id'] = mysqli_fetch_row($school_query_res)[0];
            $projectid2 = '5718';
        } else {
            $_SESSION['projects'] = $row["project_list"];
            $_SESSION['school_id'] = $row['school_id'];
        }

        $proj_query = "SELECT Distinct school_id,project_id from project_school where school_id in(" . $_SESSION['school_id'] . ") and project_id in ({$_SESSION['projects']})";
        $proj_query_res = mysqli_query($con, $proj_query) or die(mysqli_error($con));
        $_SESSION['exp_dash_project'] = [];
        while ($proj_query_row = mysqli_fetch_assoc($proj_query_res)) {
           //array_push($_SESSION['exp_dash_project'][$proj_query_row['school_id']], $proj_query_row['project_id']) or $_SESSION['exp_dash_project'][$proj_query_row['school_id']] = [$proj_query_row['project_id']];
            //change start
            $school_id = $proj_query_row['school_id'];
    		$project_id = $proj_query_row['project_id'];

    		// Check if the school_id key exists, if not, initialize it as an empty array
    		if (!isset($_SESSION['exp_dash_project'][$school_id])) {
        	$_SESSION['exp_dash_project'][$school_id] = [];
    					}

    				// Push the project_id into the corresponding school_id array
    		$_SESSION['exp_dash_project'][$school_id][] = $project_id;
			//change end
			$projectid2 = $proj_query_row['project_id'];
			if (!empty($projectid2)) {
                $_SESSION['projectid'] = $projectid2;
            } else {
                $_SESSION['projectid'] = '5718';
            }
        }

        $module_name_query = 'select id,name from module';
        $module_name_result = mysqli_query($con, $module_name_query) or die(mysqli_error($con));
        $_SESSION['module_name'] = array();
        while ($module_row = mysqli_fetch_row($module_name_result)) {
            $_SESSION['module_name'][trim($module_row[0])] = trim($module_row[1]);
        }

        if (!empty($_SESSION['school_id'])) {
            $school_name = "SELECT id,name from school where id in(" . $_SESSION['school_id'] . ")";
            $sc_res = mysqli_query($con, $school_name) or die(mysqli_error($con));
            while ($sc_row = mysqli_fetch_assoc($sc_res)) {
                $_SESSION['exp_dash_schools'][$sc_row['id']] = $sc_row['name'];
            }
        }
		//echo $pass."password";
        if ($pass == "experifun") {
			echo $pass;
			echo $projectid2;
            header("Location: dashboard.php?pid=" . $projectid2);
            exit();
        } else {
             header("Location: dashboard.php");
            exit();
        }
    } else {
        echo "<h5 style='color:red; text-align:center'>No user Found! </h5>";
    }
}

// for recovery mail
if (!empty($_GET['mail'])) {
    echo "<h5 style='color:green; text-align:center'>A mail has been sent for recovery of password!</h5>";
}

if (!empty($_GET['reason'])) {
    echo "<h5 style='color:green; text-align:center'>Password has been changed successfully. Please login again</h5>";
}
?>
