<!-- PHP Starts Here -->
<?php 
session_start();
    require_once "../connection/connection.php";
    $message  = ''; 
  
    
   
    if(isset($_POST["btnlogin"]))
    {
        $username=$_POST["email"];
        $password=$_POST["password"];

        $query="select * from login where user_id='$username' and Password='$password' ";
        $result=mysqli_query($con,$query);
        if (mysqli_num_rows($result)>0) {
           
            while ($row=mysqli_fetch_array($result)) {
                if ($row["Role"]=="Admin")
                {
                    $_SESSION['LoginAdmin']=$row["user_id"];
                    header('Location: ../admin/admin-index.php');
                }
                else if ($row["Role"]=="Teacher" and $row["account"]=="Activate")
                {
                    $_SESSION['LoginTeacher']=$row["user_id"];
                    header('Location: ../teacher/teacher-index.php');
                }
                else if ($row["Role"]=="Student" and $row["account"]=="Activate")
                {
                    $_SESSION['LoginStudent']=$row['user_id'];
                    header('Location: ../student/student-index.php');
                }
            }
        }
        else
        {    $message="User Id Or Password Does Not Match";
            // header("Location: login.php");
        }
    }
?>

		<?php include('../common/common-header.php') ?>



        <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="row" id="login" style=" display:block;">

        <div class="login-div mt-3 rounded">
            <div class="logo-div text-center">
                <img src="../admin/images/mjk_logo.jpeg" alt="" class="align-items-center" width="100" height="100">
            </div>
            <div class="login-padding">
                <h2 class="text-center text-white">Login</h2>
                <form class="p-1" action="login.php" method="POST">
                   
                    <div class="form-group">
                        <label><h6>Enter Your ID/Email:</h6></label>
                        <input type="text" name="email" placeholder="Enter ID" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label><h6>Enter Password:</h6></label>
                        <input type="Password" name="password" placeholder="Enter Password" class="form-control border-bottom" required>
                        <p class="mt-2 text-danger"><?php echo $message; ?></p>  
                    </div>
                    <div class="form-group text-center mb-3 mt-4">
                        <input type="submit" name="btnlogin" value="LOGIN" class="btn btn-primary" >
                    </div>
                    <div class="form-group text-center mb-3 mt-4">
                        <input type="button" name="createaccount" value="Create Account"  onclick="loginShowHide('signup','login')" class="btn btn-primary" >
                    </div>
                </form>
            </div>
        </div>
         
        </div>



        <div class="row" id="signup" style="display: none;">

        <div class="login-div mt-3 rounded">
            <div class="logo-div text-center">
                <img src="../admin/images/mjk_logo.jpeg" alt="" class="align-items-center" width="100" height="100">
            </div>
            <div class="login-padding">
                <h2 class="text-center text-white">Create Account</h2>
                <form  id="signupdata" class="p-1" action="" method="POST">
               
                <div class="form-group">

                        <label><h6>Name:</h6></label>
                        <input type="text" name="apname" placeholder="Enter Name" class="form-control" value="" required>
                    </div>
                    <div class="form-group">
                        <label><h6>Enter Your Email:</h6></label>
                        <input type="text" id="signupemail" name="email" placeholder="Enter Email Id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label><h6>Enter Mobile No:</h6></label>
                        <input type="number" id='mobno' name="mobno" placeholder="Enter Mobile No" class="form-control border-bottom" required>
                      
                    </div>
                    <div id="errormsg"> </div>
                    <div class="form-group text-center mb-3 mt-4">
                        <input type="submit" name="btnlogin" value="Create Account" class="btn btn-primary" onclick="formdatasubmit()" >
                    </div>
                    <div class="form-group text-center mb-3 mt-4">
                        <input type="button" name="loginbtn" value="Login"  onclick="loginShowHide('login','signup')" class="btn btn-primary" >
                    </div>


                </form>

                <form  id="otpdata" class="p-1" action="" method="POST" style="display: none;">
                <div id="otperrormsg"> </div>
                    <div class="form-group">
                        <label><h6> OTP:</h6></label>
                        <input type="text" name="otpval" placeholder="Enter OTP" class="form-control" required>
                    </div>
                    <div class="form-group text-center mb-3 mt-4">
                        <input type="button" name="otpbtn" value="Verify"  onclick="submitotp()" class="btn btn-primary" >
                    </div>


                </form>


               
            </div>
        </div>
         
        </div>

      </div>
    </section>
    <?php include('../common/common-footer.php') ?>
    

    <script src="../node_modules/jquery/dist/jquery-3.6.0.min.js"></script>
    <script src="../node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    </body>

    
    <script>
        function loginShowHide(enable,disable){
           document.getElementById(`${enable}`).style.display='block';    
           document.getElementById(`${disable}`).style.display='none';       

        }


        function formdatasubmit(){
            event.preventDefault();
            $('#errormsg').text('Please Wait....!');
            $('#errormsg').css('color','blue');
            let emailId = $('#signupemail').val();
            let phno = $('#mobno').val();
            let formData = {
                'email':emailId,
                'mobno':phno,
                'username': $('input[name = apname]').val()
            }

            if(formData.username.length == 0){
                $('#errormsg').text('Please Enter Full Name');
                $('#errormsg').css('color','red');
                return;
            }
            if(emailId.length == ''){
                $('#errormsg').text('Please Enter Valid Email Id');
                $('#errormsg').css('color','red');
                return;
            }
            if(phno.length !== 10){
                $('#errormsg').text('Please Enter Valid 10 digit Mobile Number');
                $('#errormsg').css('color','red');
                return;
            }
   

            $.ajax({
                url : "../asyncreponse.php",
                type: "POST",
                data : formData,
            success: function(data, textStatus, jqXHR)
            {   if(data.code == 1){
                document.getElementById('otpdata').style.display='block';    
                document.getElementById('signupdata').style.display='none';  
                $('#otperrormsg').text(data.message);
                $('#otperrormsg').css('color','blue');
            }
            else if(data.code == 0){
                $('#errormsg').text(data.message);
                $('#errormsg').css('color','red');
            }

            },
            error: function(jqXHR, textStatus, errorThrown)
                {
                    console.log(textStatus);
                }

        });

        }


        function submitotp(){
            let emailId = $('#signupemail').val();
            let phno = $('#mobno').val();
            let formData = {
                'email':emailId,
                'mobno':phno,
                'username': $('input[name = apname]').val(),
                'otp':  $('input[name = otpval]').val()
            }
            $.ajax({
                url : "../validateotp.php",
                type: "POST",
                data : formData,
            success: function(data, textStatus, jqXHR)
            {   if(data.code == 1){
              
                window.location.href = '../admission.php';

            }
            else if(data.code == 0){
                $('#otperrormsg').text(data.message);
                $('#otperrormsg').css('color','red');
            }

            },
            error: function(jqXHR, textStatus, errorThrown)
                {
                    console.log(textStatus);
                }

        });


        }
    </script>
</html>



