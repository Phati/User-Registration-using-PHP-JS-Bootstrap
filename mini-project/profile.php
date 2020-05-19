<?php
session_start();
include("includes/functions.php");
$email='';
$display='';
if(logged_out())
{
    header("location:login.php");
}

else if(isset($_COOKIE['email']))
{
    $email=$_COOKIE["email"];
    $display='logged in through cookie';
}

else 
{
    $email=$_SESSION["email"];
    $display='logged in through session';
}

include_once("includes/config.php");
$sql="SELECT * FROM `users` WHERE `email`='".$email."'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
$id=$row["id"];
$fname=$row["first_name"];
$lname=$row["last_name"];
$dob=$row["dob"];
$image=$row["image"];
?>
<?php include("includes/header.php"); ?>
<title>Sign Up Page</title>
</head>
<body class="profileBody">
    <?php echo $display; ?>
    <div class="container-fluid">
        <a href="logout.php"><button type="button" name="logout" class="btn btn-lg btn-outline-primary" 
        style="float:right;">
        Logout</button>
        </a>
    </div>
<div class="container" style="margin-top: 50px;">
    <div class="jumbotron" style="padding-top: 10px;">
    <center>
        <h1>Welcome <?php echo ucfirst($fname)." ".ucfirst($lname)?></h1>
        <img src="<?php echo $image?>" class="img-fluid img-thumbnail" style="width: 300px;"><br/>
        <p>Registration ID: <?php echo $id?></p>
        <p>Date of Birth: <?php echo $dob?></p>
    </center>
    </div>
</div>

</body>
</html>