<?php
session_start();
include_once("includes/config.php");
$error='';
if(isset($_REQUEST["login"]))
{
    $email=htmlspecialchars($_REQUEST['email']);
    $password=trim($_REQUEST['password']);
    $password=md5($password);
    $checkbox=isset($_REQUEST["check"]);
    $sql="SELECT `password` FROM users WHERE email='".$email."'";
    $result = $conn->query($sql);

    if($result->num_rows==1)
    {
        $row=$result->fetch_assoc();
        if($row["password"]==$password)
        {
            $_SESSION["loggedin"]=true;
            $_SESSION["email"]=$email;
            if($checkbox=='on')
            {
                setcookie('email',$email,time()+ (60));
            }
            header("location:profile.php");
            exit;
        }

        else $error="<div class='alert-danger'><h6 class='text-warning'>Invalid Password</h6></div>";
    }

    else $error="<div class='alert-danger'><h6 class='text-warning'>Invalid User</h6></div>";
}
?>
<?php include("includes/header.php"); ?>
<title>Login Page</title>
    </head>
    <body class="signinBody">
    <?php
        include("includes/nav.php");
    ?>
        <div class="container">
            <div class="col-md-4 offset-md-4 col-lg-6 offset-lg-3">
                <div class="jumbotron" style="margin-top:50px; padding-top:10px;">
                    <h4 class="text-danger text-center" style="margin-bottom:5px;" >Login</h4>
                    <hr class="bg-warning">
                    <form name="loginform" class="form" action="login.php" onsubmit="return validateForm()"
                    method="POST" novalidate>
                    <?php echo $error; ?>
                    <div class="form-group">
                      <label for="email">Email*:</label>
                      <input type="email" name="email" id="email" 
                      class="form-control" placeholder="Please enter your email">
                      <small><label id="invalidEmail"></label></small>
                    </div>

                    <div class="form-group">
                        <label for="password">Password*:</label>
                        <input type="password" name="password" id="password" 
                        class="form-control" placeholder="Please enter your password">
                        <small><label id="invalidPassword"></label></small>
                      </div>

                      <div class="form-group">
                        <span><input type="checkbox" name="check" id="check">
                        Keep me logged in.</span>
                      </div>

                      <button type="submit" name="login" class="btn btn-success col-md-12">Login</button> <hr class="bg-warning">
                     <div class="text-center"><label class="text-info">Do not have an account?<a class="text-danger" href="signup.php"> Register here</a></label></div>
                     <div class="text-center"><a class="text-warning" href="forgot.php.php">Forgot Password</a></div>
                   </form>
                </div>

            </div>
        </div>

        <script>
            function validateForm()
            {
                var returnValue;

                var email=document.forms["loginform"]["email"].value;
                var e_email=document.getElementById("invalidEmail");

                if(email == "")
                {
                    e_email.innerHTML="Email cannot be empty";
                    e_email.style="color: red;"
                    returnValue=false;
                }

                else if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.forms["loginform"]["email"].value))
                {
                    e_email.innerHTML="Please enter a valid email address";
                    e_email.style="color: red;"
                    returnValue=false;
                }

                else
                {   
                    e_email.innerHTML="Looks Good";
                    e_email.style="color: green;"
                }


                var pass=document.forms["loginform"]["password"].value;
                var e_pass=document.getElementById("invalidPassword");

                if(pass == "")
                {
                    e_pass.innerHTML="Password cannot be empty";
                    e_pass.style="color: red;"
                    returnValue=false;
                }

                else
                {
                    e_pass.innerHTML="Looks Good";
                    e_pass.style="color: Green;"
                }


                return returnValue;
            }
        </script>
    </body>

</html>