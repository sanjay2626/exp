<?php 
    require("connection.php");
    require("check_login.php");
    require("head.php");
    if(!empty($_POST['submit'])){
        if(!empty($_POST['new_p'])){
            $query = "Select password from user where user_id='".$_SESSION['exp_dash_id']."'";
            $row = mysqli_fetch_row(mysqli_query($con,$query))[0] or die(mysqli_error($con));
            if(password_verify($_POST['old_p'],$row)==1 || ($row=="experifun" && $_POST['old_p']=="experifun")){
                if($_POST['new_p']==$_POST['c_p']){
                mysqli_query($con,"UPDATE user set password='".password_hash($_POST['new_p'],PASSWORD_BCRYPT)."' where user_id='".$_SESSION['exp_dash_id']."'") or die(mysqli_error($con));
                session_destroy();
                ?> 
                    <script>
                        alert("Password Successfully Changed");
                        window.open("https://" . $_SERVER['SERVER_NAME'].'/index.php' ,"_self");
                    </script>
                <?php
                
            }
        }
        }
    }
?>  
    <style>
        #wrap{
        display:flex;
        align-items:center;
        justify-content: center;
        padding-top:3%
        
        }
        h4{
            font-weight:lighter
        }
        input[type=password]{
            margin-bottom:20px
        }
        body,html{
            height:100%;
            overflow:hidden
        }
        form{
            height:100%
        }
    </style>
    <h2 style="background-color:#880E4F;padding:10px;color:white;text-align:center" class="light">Change Password</h2>
    <form action="" method="post">
    <div id="wrap">
        <div class="container-fluid">
            <div style="width:100%" class="row justify-content-center">
               
                <div class="col-sm-6">
                    <h4>Old Password</h4>
                    <input class="form-control" type="password" name="old_p" required/>
                    <h4>New Password</h4>
                    <input class="form-control" type="password" name="new_p" required/>
                    <h4>Confirm New Password</h4>
                    <input class="form-control" type="password" name="c_p" required/>
                    <input type="submit" name="submit" class="btn btn-success btn-lg" value="Submit"/>
                </div>
               
            </div>
        </div>
    </div>
    </form>
    </body>
</html>