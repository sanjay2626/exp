<?php
  require '../connection.php';
  require '../check_login.php';
  require '../head.php';
?>
  <style>
    #wrap{
      padding-top: 15vh;

    }
    .col-sm-3{

      min-height: 150px;
      padding:20px;
      display: flex
    }
    .square{
      display: flex;
      align-items: center;
      justify-content: center;
      flex-wrap: wrap;
      background: white;
      width: 100%;
      height: 100%;
      padding:20px;
      border: 1px solid #0074D9;
      border-radius: 10px
    }
    .square:hover{
      background:  #0074D9;
      color: white
    }
    .basis{
      flex-basis: 100%;
      text-align: center;
      margin-bottom: 20px;
    }
    h4{
      font-weight: 400;
    }
  </style>
  <div id="wrap"  class="container">
    <div class="row justify-content-center">
      <div class="col-sm-3">
        <div data-t="add_plan.php" class="square">
          <div class="basis"><i class="fas fa-plus fa-3x"></i></div>
          <h4>Add Plan</h4>
        </div>
      </div>
      <div class="col-sm-3">
        <div data-t="view_plan.php" class="square">
          <div class="basis"><i class="fas fa-search fa-3x"></i></div>
          <h4>View Plans</h4>
        </div>
      </div>
      
    </div>
  </div>
  <script>
    $(".square").on('click',function(){
      var link = $(this).data('t');
      window.open(link,"_self");
    })
  </script>
<?php
  require '../footer.php';
?>
