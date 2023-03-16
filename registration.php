<?php include "admin/functions.php"; ?>
<?php  include "includes/header.php"; ?>


<!-- Navigation -->

<?php  include "includes/navigation.php"; ?>

<?php
global $message;
if(isset($_POST['submit'])){   
$username=trim($_POST['username']);
$firstname=trim($_POST['firstname']);
$lastname=trim($_POST['lastname']);    
$email=trim($_POST['email']);
$password=trim($_POST['password']);
$error = [
'username'=>'',
'email'=> '',
'password'=> ''
];

if(strlen($username) == ''){

$error['username']='Username should not be empty';

                            }
if(username_exists($username)){

$error['username']='Username already exists <a href="index.php">Log in</a>'; 
                            }
if(strlen($email) == ''){

$error['email']='Email should not be empty';

                            }
if(email_exists($username)){

$error['email']='Email already exists <a href="index.php">Log in</a>'; 
                            }
if(strlen($password) == ''){

$error['password']='Password should not be empty';
                            }       
foreach($error as $key =>$value){

if(empty($value)) {

                }

if(empty($error)){
register_user($username,$firstname,$lastname,$email,$password);
                }
}
}
?>

<!-- Page Content -->
<div class="container">
<section id="login">
<div class="container">
<div class="row">
<div class="col-xs-6 col-xs-offset-3">
<div class="form-wrap">
<h1>Register</h1>
<form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
<div class="form-group">
<label for="username" class="sr-only">username</label>
<input type="text" name="username" id="username" class="form-control" placeholder="Enter Username"
autocomplete=on value="<?php echo isset($username) ? $username : '' ?>">
<p><?php echo isset($error['username']) ? $error['username'] : '' ?></p>
</div>
<div class="form-group">
<label for="firstname" class="sr-only">Firstname</label>
<input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter Firstname"
value="<?php echo isset($firstname) ? $firstname : '' ?>">
</div>
<div class="form-group">
<label for="lastname" class="sr-only">Lastname</label>
<input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter Lastname"
value="<?php echo isset($lastname) ? $lastname : '' ?>">
</div>
<div class="form-group">
<label for="email" class="sr-only">Email</label>
<input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com"
value="<?php echo isset($email) ? $email : '' ?>">
<p><?php echo isset($error['email']) ? $error['email'] : '' ?></p>
</div>
<div class="form-group">
<label for="password" class="sr-only">Password</label>
<input type="password" name="password" id="key" class="form-control" placeholder="Password">
<p><?php echo isset($error['password']) ? $error['password'] : '' ?></p>
</div>

<input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
</form>

</div>
</div> <!-- /.col-xs-12 -->
</div> <!-- /.row -->
</div> <!-- /.container -->
</section> 
<!--END OF SECTION-->

<hr>



<?php include "includes/footer.php";?>
