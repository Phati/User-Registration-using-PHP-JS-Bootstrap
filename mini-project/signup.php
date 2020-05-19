<?php
include("includes/header.php");
include_once("includes/config.php");
$msg1=''; $regmsg='';
if(isset($_REQUEST["signup"]))
{
$firstname=htmlspecialchars($_REQUEST["fname"]);
$lastname=htmlspecialchars($_REQUEST["lname"]);
$email=htmlspecialchars($_REQUEST["email"]);
$date=$_REQUEST["dob"];
$password=$_REQUEST["password1"];
$password=md5($password);
$image=$_FILES['image']['name'];
$image=rand(1,1000).rand(1,1000).time().$image;
$tmp_image=$_FILES['image']['tmp_name'];
$allowedfiles=array("image/jpg","image/png","image/jpeg");
$filetype=$_FILES['image']['type'];
$filesize=$_FILES['image']['size'];
$uploadedimage="upload/".$image;
if($image=='')
{
    $msg1="<small><label style='color:red;'>Please Choose a profile picture</label></small>";
}
else if(!in_array($filetype,$allowedfiles))
{
    $msg1="<small><label style='color:red;'>Please upload a jpg or png file</label></small>";
}

else if($filesize>200000)
{
    $msg1="<small><label style='color:red;'>File size exceeds 2 Mb</label></small>";
}


else
{
    $sql = "INSERT INTO users (first_name, last_name, email,dob,`password`,`image`)
    VALUES ('$firstname', '$lastname', '$email', '$date','$password','$uploadedimage')";
    
    if ($conn->query($sql) === TRUE) {
        $regmsg="<div><p class='text-success'>Registered Successfully</p></div>";
        move_uploaded_file($_FILES["image"]["tmp_name"],$uploadedimage);


    } else {
        $regmsg="<div class='alert-warning'><p class='text-danger text-center'>Email Id already registered </p></div>";
    }
    
    $conn->close();

}

}
?>


<title>Sign Up Page</title>
</head>
    
<body class="signupBody">
<?php
        include("includes/nav.php");
    ?>
<div class="container ">
    <div class="col-md-4 offset-md-4 col-lg-6 offset-lg-3">
        <div class="jumbotron transparent" style="margin-top: 50px; padding-top: 10px;" >
            <h4 class="text-center text-danger" style="margin-bottom:10px;">Sign Up</h4>
            <hr class="bg-warning">
            <form name="myForm" class="form" action="signup.php" method="POST" onsubmit="return validateForm()" enctype="multipart/form-data" novalidate>
                <?php echo $regmsg;?>
                <div class="form-group">
                    <label for="fname">First Name*:</label>
                    <input type="text" name="fname" id="fname" class="form-control" placeholder="Please enter your firstname">
                    <small><label id="invalidFName"></label></small>
                </div>

                <div class="form-group">
                        <label for="lname">Last Name*:</label>
                        <input type="text" name="lname"   id="lname" class="form-control" placeholder="Please enter your lastname">
                        <small><label id="invalidLName"></label></small>
                </div>

                <div class="form-group">
                        <label for="email">Email*:</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Please enter your email">
                        <small><label id="invalidEmail"></label></small>
                </div>

                <div class="form-group">
                        <label for="dob">Date of Birth*:</label>
                        <input type="date" name="dob" id="dob" class="form-control" min="1990-01-01" max="2010-01-01">
                        <small><label id="invalidDob"></label></small>
                </div>

                <div class="form-group">
                        <label for="password">Password*:</label>
                        <input type="password" name="password1" id="password1" class="form-control" placeholder="Please enter a strong Password">
                        <small><label id="invalidPassword1"></label></small>
                </div>

                <div class="form-group">
                        <label for="password">Re-enter Password*:</label>
                        <input type="password" name="password2" id="password2" class="form-control" placeholder="Please re-enter the Password">
                        <small><label id="invalidPassword2"></label></small>
                </div>

                <div class="form-group">
                    <label for="image">Profile Photo*:</label><br>
                    <input type="file" name="image" id="image">
                    <small><label class="text-info">Please select a jpg/png file less than 2 Mb</label></small>
                    <?php echo $msg1; ?>
                </div>

                <div class="form-group">
                        <span><input type="checkbox" name="terms" id="terms">
                        I Agree to the terms and conditions.</span><br>
                        <small><label id="invalidTerms"></label></small>
                </div>
      
                <button type="submit"  name="signup" class="btn btn-success col-md-12">Sign Up</button><hr class="bg-warning">
                <div class="text-center"><label class="text-info">Already registered? <a class="text-danger" href="login.php">Login here</a></label></div>
            </form>
        </div>
    </div>
</div>


<script>
    function validateForm()

    
    {
        var returnValue;
        
        var x = document.forms["myForm"]["fname"].value;
        var e1=document.getElementById("invalidFName");
        if (x == "")
        {
            e1.innerHTML="First name cannot be empty";
            e1.style="color :red;"
            returnValue= false;
        }

        else if (x.length < 3 || x.length >20 )
        {
            e1.innerHTML="First name should be minimum 3 or maximum 20 characters long";
            e1.style="color :red;"
            returnValue= false;
        }

        else if(!/^[A-Za-z]+$/.test(document.forms["myForm"]["fname"].value))
        {
            e1.innerHTML="First name can contain only alphabets";
            e1.style="color :red;"
            returnValue= false;
        }
        
        else {e1.innerHTML="Looks good"; e1.style="color :green;" }



        var y = document.forms["myForm"]["lname"].value;
        var e2=document.getElementById("invalidLName");
        if (y == "")
        {
            e2.innerHTML="Last name cannot be empty";
            e2.style="color :red;"
            returnValue= false;
        }

        else if (y.length < 3 || y.length >20 )
        {
            e2.innerHTML="Last name should be minimum 3 or maximum 20 characters long";
            e2.style="color :red;"
            returnValue= false;
        }

        else if(!/^[A-Za-z]+$/.test(document.forms["myForm"]["lname"].value))
        {
            e2.innerHTML="Last name can contain only alphabets";
            e2.style="color :red;"
            returnValue= false;
        }

        else {e2.innerHTML="Looks good"; e2.style="color :green;" }


        var z = document.forms["myForm"]["email"].value;
        var e3=document.getElementById("invalidEmail");

        if (z == "")
        {
            e3.innerHTML="Email cannot be empty";
            e3.style="color :red;"
            returnValue= false;
        }

        else if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.forms["myForm"]["email"].value))
        {
            e3.innerHTML="email should be like: example@mymail.com";
            e3.style="color :red;"
            returnValue= false;
        }

        else {e3.innerHTML="Looks good"; e3.style="color :green;" }



        var dob = document.forms["myForm"]["dob"].value;
        var ed=document.getElementById("invalidDob");

        if (dob == "")
        {
            ed.innerHTML="Please select the date of birth";
            ed.style="color :red;"
            returnValue= false;
        }   

        else {ed.innerHTML="Looks good"; ed.style="color :green;" }

        var p1 = document.forms["myForm"]["password1"].value;
        var e4=document.getElementById("invalidPassword1");

        if (p1 == "")
        {
            e4.innerHTML="Password cannot be empty";
            e4.style="color :red;"
            returnValue= false;
        }


        else if(!/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}/.test(document.forms["myForm"]["password1"].value))
        {
            e4.innerHTML="Password should contain at least one number, one lowercase and one uppercase letter and should be more than 7 and less than 17 character long";
            e4.style="color :red;"
            returnValue= false;
        }

        else {e4.innerHTML="Looks good"; e4.style="color :green;" }


        var p2 = document.forms["myForm"]["password2"].value;
        var e5=document.getElementById("invalidPassword2");
        if (p2 == "")
        {
            e5.innerHTML="Password cannot be empty";
            e5.style="color :red;"
            returnValue= false;
        }

        else if (p1 != p2)
        {
            e5.innerHTML="Passwords do not match";
            e5.style="color :red;"
            returnValue= false;
        }
        
        else {e5.innerHTML="Looks good"; e5.style="color :green;" }


        var terms = document.forms["myForm"]["terms"].checked;
        var e6=document.getElementById("invalidTerms");

        if(terms == false)
        {
            e6.innerHTML="Please agree to the terms and conditions";
            e6.style="color :red;"
            returnValue= false;
        }

        else {e6.innerHTML="Looks good"; e6.style="color :green;" }


        return returnValue;
    
    }
</script>

</body>
</html>