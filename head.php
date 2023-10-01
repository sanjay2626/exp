<?php
global $basepath;
$basepath ="http://localhost/exp";
  function x($data){

    global $con;
    
    return mysqli_real_escape_string($con,(trim($data)));

  }

  ?>

<html>

  <head>

  <title>Experifun Dashboard</title>

  <link rel="icon" href="favicon.png" />

  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">

  <style>

    nav{

      box-shadow: 0 1px 2px 1px rgba(0, 0, 0, 0.5);

      min-height:80px;

    }

    .navbar-brand{

      margin-left:20px;

    }



    .nav-item{

      margin-right:10px;

      font-size: 1.1em;

      

    }

    .light{

      font-weight: lighter !important;

    }

    .shadow{

      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

    }

    .card-row{

      margin-bottom:30px;



    }

    .padded{

      padding:0px 5px 0px 5px;

      cursor:pointer;

    }

    .blue{

    	color:#0074D9 !important; 

    }

    @media only screen and (max-width: 575px){

    .nav-item{

     margin-left:20px;

     }

    }

  </style>

  </head>

  <nav class="navbar navbar-light navbar-expand-sm ">

  <a class="navbar-brand" href="<?php echo $basepath ?>/dashboard.php?pid=<?php echo $_SESSION['projectid']; ?>"><img src="<?php echo $basepath ?>/logo.jpg" alt="Logo" style="width:150px;"></a>

    <button id="ham" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">

    <span class="navbar-toggler-icon"></span></button>

    <div class="navbar-collapse collapse justify-content-center" id="collapsibleNavbar">

    <ul class="navbar-nav" id="list">

      <li class="nav-item">

        <a class="nav-link blue" href="<?php echo $basepath ?>/dashboard.php?pid=<?php echo $_SESSION['projectid']; ?>">Home</a>

      </li>

       <?php if(in_array("1",$_SESSION['permissions']) || in_array("2",$_SESSION['permissions']) || in_array("3",$_SESSION['permissions']) || in_array("4",$_SESSION['permissions']) || in_array("5",$_SESSION['permissions']) || in_array("9",$_SESSION['permissions'])){ ?>



      <li class="nav-item dropdown">

      <a class="nav-link blue dropdown-toggle" data-toggle="dropdown" href="#">Sessions</a>

      <div class="dropdown-menu">

        <a class="dropdown-item" href="<?php echo $basepath ?>/add_session.php">Add Session</a>

        <?php if(in_array("1",$_SESSION['permissions']) || in_array("2",$_SESSION['permissions']) || in_array("3",$_SESSION['permissions']) || in_array("4",$_SESSION['permissions']) || in_array("5",$_SESSION['permissions'])){ ?>

          <a class="dropdown-item" href="<?php echo $basepath ?>/your_sessions.php">Your Sessions</a>

        <?php } ?>

        <?php if(in_array("1",$_SESSION['permissions']) || in_array("9",$_SESSION['permissions'])){ ?>



          <a class="dropdown-item" href="<?php echo $basepath ?>/Plan/add_plan.php">Plan Sessions</a>

          <a class="dropdown-item" href="<?php echo $basepath ?>/Plan/view_plan.php">View Plans</a>

        <?php } ?>

         <?php if(in_array("12",$_SESSION['permissions'])){ ?>

             <a class="dropdown-item" href="teacher_analysis">Teacher Performance</a>

         <?php } ?>

      </div>

      </li>

    <?php } ?>

      <?php if($_SESSION['exp_dash_id']=="Rakesh"){ ?>

      <li class="nav-item">

        <a class="nav-link blue" href="<?php echo $basepath ?>/print_excel_report.php">Excel Report</a>

      </li>

     <?php } if(in_array("7",$_SESSION['permissions'])){ ?>

      <li class="nav-item">

        <a class="nav-link blue" href="<?php echo $basepath ?>/custom_report.php">Custom Report</a>

      </li>

    <?php } ?>

    

        <?php  if(in_array("11",$_SESSION['permissions'])){ ?>

      <li class="nav-item dropdown">

      <a class="nav-link blue dropdown-toggle" data-toggle="dropdown" href="#">Delivery</a>

      <div class="dropdown-menu">

        <a class="dropdown-item" href="<?php echo $basepath ?>/Delivery/">Plan Delivery</a>

        <a class="dropdown-item" href="<?php echo $basepath ?>/Delivery/view_index.php">View Delivery Plans</a>

        <a class="dropdown-item" href="<?php echo $basepath ?>/Delivery/delivery.php">Initiate Delivery</a>

        <a class="dropdown-item" href="<?php echo $basepath ?>/Delivery/view_deliveries.php">View Deliveries</a></div>

      </li>

    <?php } ?>

      

      <li class="nav-item">

        <a class="nav-link blue" href=<?php $basepath."<?php echo $basepath ?>/change_password.php" ?>>Change Password</a>

      </li>

      <li class="nav-item">

       <a style="color:red !important" class="nav-link" href= "<?php echo $basepath ?>/logout.php"  >Log Out  </a> 

      </li>

      

    </ul>

  </nav>

<body id="wrapper">