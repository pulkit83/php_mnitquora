<?php
	include 'database.php';
	if(!empty($_POST))
	{
		$usrname=$_POST["username"];
		$psw=$_POST["password"];
		$email=$_POST["email"];
		$hash = md5( rand(0,1000) );
		$sql= "INSERT INTO accounts (username, password, email, hash) VALUES ('$usrname', '$psw', '$email', '$hash' )";
		$qstat =mysqli_query($connection, $sql);
		if(!$qstat)
		{
						die(" nhi chali" . mysqli_error($connection));
		}
		else
		{
	    $sql="SELECT userid FROM accounts WHERE accounts.username = '$usrname' ";
		$qstat = mysqli_query($connection, $sql);
    	if(!$qstat)
    	{
      		die(" nhi chali" . mysqli_error($connection));
    	}
    	else
    	{
        	$pass=mysqli_fetch_assoc($qstat);
            
/*			$to      = $email; // Send email to our user
$subject = 'Signup | Verification'; // Give the email a subject 
$message = '
 
Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
 
------------------------
Username: '.$usrname.'
Password: '.$psw.'
------------------------
 
Please click this link to activate your account:
https://mnitquora.000webhostapp.com/verify.php?email='.$email.'&hash='.$hash.'
 
'; // Our message above including the link
                     
$headers = 'From:noreply@mnitquora.com' . "\r\n"; // Set from headers
$retval=mail($to, $subject, $message, $headers); // Send our email
*/
		}
	}
}
?>

<html>
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="mystyle.css">
  <script type="text/javascript" src="functions.js"></script>
  <title>MnitQuora</title>
  </head>
  <body>
<header class="container-fluid text-center" style="background-color: #002147;color: #ffffff">
  <ul style="list-style: none;" >
    <li><h1>Mnit Quora</h1></li>
</li>
</ul>

</header>
<br>
<br>
<br>
<br>

<h3>Your Account has been created. To activate please go check your mail. Thanks. </h3>
<br>
<br>
<br>
<br>

<footer class="container-fluid text-center">
  <h4><font color="#ffffff    ">This Website is developed by <font style="font-weight: bold">Manish Bhagwani</font> and <font style="font-weight: bold">Pulkit Garg</font></font></h4>  
</footer>
</body>
</html>


