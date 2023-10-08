<center>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark" style="background-color: #ffffff!important;">



  <div class="container-fluid">

    <ul class="nav justify-content-end">



       <li class="nav-item">

        <a class="nav-link" href="school_report.php?pid=<?php echo $_GET['pid']; ?>">School Profile Report</a>

      </li>



      

      <?php if($_SESSION['user_role']!='17'){ ?>

       <li class="nav-item">

        <a class="nav-link" href="academic.php?pid=<?php echo $_GET['pid']; ?>">Academic Report</a>

      </li> <?php } ?>

      <li class="nav-item">

        <a class="nav-link" href="custom_report.php">Custom Report</a>

      </li>



      <li class="nav-item">

        <a class="nav-link" href="dashboard.php?pid=<?php echo $_GET['pid']; ?>">Stem Infra</a>

      </li>



      <li class="nav-item">

        <a class="nav-link text-right" href="#">Photo Album</a>

      </li>

      

      <li class="nav-item">

        <a class="nav-link text-right" href="impact_assessment.php?pid=<?php echo $_GET['pid']; ?>">Impact Assessment</a>

      </li>

    </ul>

  </div>



</nav>

  </center>