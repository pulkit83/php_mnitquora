<?php
  include 'database.php';
 
  $msgs=array("", "Wrong Password", "This Email is not registered", "Account not activated yet");
    $err=0;
   $msgsu=""; 
    if(!empty($_GET))
    {
      $msgsu="This Email already registered";
    }
  if(!empty($_POST))
  {
    $email=$_POST["email"];
    $psw=$_POST["password"];
    $sql="SELECT username, userid, password, active FROM accounts WHERE accounts.email = '$email' ";
    $qstat = mysqli_query($connection, $sql);
    if(!$qstat)
    {
      die(" nhi chali" . mysqli_error($connection));
    }
    else
    {
      if(mysqli_num_rows($qstat)>0)
      {
        $pass=mysqli_fetch_assoc($qstat);
        if($pass['password']==md5($psw))
          {
            if($pass["active"]==1)
            {
            session_start();
            $_SESSION['username'] = $pass['username'];
            $_SESSION['userid']=$pass['userid'];
            header("location: main.php");
            exit();
            }
            else
              $err=3;
          }
        else
          $err=1;
      }
      else
        $err=2 ;
   /*
echo "<script>$('#myModal').modal('show')</script>";*/
    }

  }
  ?>

  <!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="mystyle.css">

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <title>MnitQuora</title>
</head>
<body>

<header class="container-fluid text-center" style="background-color: #002147;color: #ffffff">
  <ul style="list-style: none;" >
    <li><h1>Mnit Quora</h1></li>
</li>
</ul>

</header>
 <center><div style="margin-top: 4%">
  <button type="button" class="btn btn-primary btn-lg" id="myBtn">Login</button>
  <button type="button" class="btn btn-primary btn-lg" id="myBtn2">SignUp</button>
</div>
</center>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-lock"></span> Login</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form role="form" action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post">
            <?php if (isset($msgs[$err]) && !empty($msgs[$err])) { ?>
              <script>
                $("#myModal").modal();
              </script>
            <div class="alert alert-warning">
            <?php echo $msgs[$err] ?>
            </div>
            <?php } ?>
            
            <div class="form-group">
              <label for="email"><span class="glyphicon glyphicon-user"></span> Email</label>
              <input type="text" class="form-control" id="email" placeholder="Enter email" name="email" required>
            </div>
            <div class="form-group">
              <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
              <input type="password" class="form-control" id="psw" placeholder="Enter password" name="password" required>
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="" checked>Remember me</label>
            </div>
              <button type="submit" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-off"></span> Login</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
          <p>Not a member? <a href="javascript:signup();"> Sign Up</a></p>
          <p>Forgot <a href="#">Password?</a></p>
        </div>
      </div>
      
    </div>
  </div> 

  <!-- Modal -->
  <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-registration-mark"></span> SignUp</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form role="form" action="welcome2.php" method="post" onsubmit="return myfunction()">
            <?php if (isset($msgsu) && !empty($msgsu)) { ?>
              <script>
                $("#myModal2").modal();
              </script>
            <div class="alert alert-warning">
            <?php echo $msgsu ?>
            </div>
            <?php } ?>
            <div class="form-group">
              <label for="usrname"><span class="glyphicon glyphicon-user"></span>Enter your Name</label>
              <input type="text" class="form-control" id="usrname" placeholder="Enter Username" name="username" required>
            </div>
            <div class="form-group">
              <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
              <input type="password" class="form-control" id="psw" placeholder="Enter password" name="password" required>
              <p id="demo1"></p>
            </div>
<div class="form-group">
              <label for="email2"><span class="glyphicon glyphicon-pencil"></span> E-mail</label>
              <input type="text" class="form-control" id="email2" placeholder="Enter E-mail Id" name="email2" required>
               <p id="demo2"></p>
            </div>

            <!-- 
            <div class="form-group">
              <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Confirm Password</label>
              <input type="password" class="form-control" id="psw" placeholder="Enter password" name="password">
            </div> -->
              <button type="submit" class="btn btn-primary btn-block" ><span class="glyphicon glyphicon-off"></span> SignUp</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
           <p>Already a member? <a href="javascript:login();">Login</a></p>
          <p>Forgot <a href="#">Password?</a></p>
        </div>
      </div>
      
    </div>
  </div> 
 <p id="demo"></p>
<script>
$(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myModal").modal();
    });
});

$(document).ready(function(){
    $("#myBtn2").click(function(){
        $("#myModal2").modal();
    });
});
function signup()
{
  $("#myModal").modal("hide");
  $("#myModal2").modal();
}
function login()
{
  $("#myModal2").modal("hide");
  $("#myModal").modal();
}
function myfunction()
{
 var y=document.getElementById("email2").value;

 var x=document.getElementById("psw").value.length;
  var p=validateEmail(y);
  if(p==0)
  {
   document.getElementById("demo2").innerHTML="Email is not valid";
   return false; 
  }
else if(p==1)
  {
   document.getElementById("demo2").innerHTML="Access through College Id Only (@mnit.ac.in)";
   return false; 
  }
  else
 return true;
}
function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(!re.test(email))
      return 0;
    else 
    {
      if(email.endsWith("@mnit.ac.in"))
        return 2;
      else
        return 1;
    }  

}
  
</script>
<footer class="container-fluid text-center">
  <h4><font color="#ffffff    ">This Website is being developed by <font style="font-weight: bold">Pulkit Garg</font></font></h4>  
</footer>

</body>
</html>
