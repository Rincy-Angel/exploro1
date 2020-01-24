<?php
$servername ="localhost";
$name = "root";

$password="";
$dbname="login";

try{
	$conn= new PDO("mysql:host = $servername;
	dbname=$dbname", $name,$password);

$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$name = $password = $nameErr = $passwordErr = $error ="";
if($_SERVER["REQUEST_METHOD"]=="POST"){
	if(empty(test_input($_POST["name"]))){
		$nameErr="Enter USername";

	}else{
		$name=test_input($_POST["name"]);
	}
	if(empty(test_input($_POST["password"]))){
		$passwordErr="Enter Password";
	}else{
		$password =test_input($_POST["password"]);
	}
}
if(empty($nameErr)&&empty($password)){
	$stmt= $conn->query("SELECT id FROM 'users' WHERE name='$name'and password='$password'");
		if($stmt->execute())
		{
			if($stmt->rowcount()==1){
				session_start();
				$_SESSION["name"]=$name;
				header("location: pro.html");
			}else{
				$error="username or password didnt macth";
			}
		}
}
}

catch(PDOException $e){
	echo "ERROR :".$e->getMessage();
}
function test_input($data){
	$data = trim($data);
	$data=stripcslashes($data);
	$data=htmlspecialchars($data);
	return $data;
}

 ?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta name="keywords" content="simple jquery validation html form" />
<script src="jquery.min.js"></script>
<script type="text/javascript" src="jquery.validate.min.js"></script>

<title>Help Page</title>
<style>
*{
	margin:0px;
	padding:0px;
}
body {
	background: url(css.jpg);
  background-size:cover;
  background-position: center;
  font-family: sans-serif;
/*  background-color: #f9f9f9;*/

}
#content {
	box-sizing: border-box;
background: transparent;
	   }
h1 {
   font-family:"Palatino Linotype", "Book Antiqua", Palatino, serif;
}

#header {
	margin-top: 80px;
	height:50px;
	text-align:center;
}
#header a
{
	color:#fff;
	text-decoration:none;
	font-size:35px;

	font-family:Tahoma, Geneva, sans-serif;
	position:relative;
}

#register-form {
	background-image:linear-gradient(rgba(0,0,0,0.8)rgba(0,0,0,0.8)),url(css.jpg);
    border-radius: 15px 15px 15px 15px;
    display: inline-block;
    margin-bottom: 30px;
    margin-left: 20px;
    margin-top: 10px;
    padding: 25px 50px 10px;
    width: 350px;
	font-family:Tahoma, Geneva, sans-serif;
}

#register-form .fieldgroup {
    display: inline-block;
    padding: 8px 10px;
    width: 340px;
}
fieldset{	border:none; }

#register-form .fieldgroup input{
    margin: 10px 0;
    height: 40px;
	width:100%;

	border:solid #cdcdcd 1px;
	border-radius:3px;
	padding-left:10px;
}


#register-form .submit {
    padding: 10px;
    height: 40px !important;
	background:#000;
	color:#fff;
	font-weight:bolder;
	border:solid #cdcdcd 1px;
	border-radius:3px;
}

#register-form .fieldgroup label.error {
    color: #FB3A3A;
    display: inline-block;
    font-weight:500;
    padding: 0;
    text-align: left;
}
</style>
<!--<script type="text/javascript">

       $('document').ready(function()
	   {
            $("#register-form").validate({
                rules: {
                    firstname: "required",
                    lastname: "required",
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                },
                messages: {
                    firstname: "Please enter your firstname",
                    lastname: "Please enter the subject",
                    password: {
                        required: "Please provide a password",
                        minlength: "Password at least have 8 characters"
                    },
                    email: "Please enter a valid email address"
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });

});
</script>-->

</head>
<body>
	<section>
<center>
<div id="page-wrap">

        <div id="header">
      	<h2>Login</h2>
        </div>

<div id="content">

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post" id="register-form">
    <div id="form-content">
        <fieldset>

            <div class="fieldgroup">
                <input type="text" name="firstname" placeholder="First Name" />
            </div>

            <div class="fieldgroup">
                <input type="text" name="lastname" placeholder="Subject" />
            </div>

            <div class="fieldgroup">
 				<input type="text" name="email" placeholder="Your E-mail ID" />
            </div>

            <div class="fieldgroup">
               <input type="password" name="password" placeholder="Your Password" />
            </div>

            <div class="fieldgroup">
                <input type="submit" value="Sign UP" class="submit">
            </div>
						<div class="fieldgroup">
							<input type="button" value="Back" onclick="window.location='pro.html'">
						</div>

        </fieldset>
    </div>
</form>

</div>


</div>

</center>
</body>
</html>
